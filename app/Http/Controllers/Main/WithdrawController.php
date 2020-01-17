<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\User;
use App\Models\Plan;
use App\Models\User_transaction;
use App\Models\User_plan;
use App\Models\Retire;

class WithdrawController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('verify2fa')->only('index');
    }

    public function index(){
        $data['page_title'] = "Solicitar Retiro";

        //Retiros actuales
        $data['retire'] = Retire::select('retire.*', 'plans.name as plan')
            ->join('user_plans', 'user_plan_id', 'user_plans.id')
            ->join('plans', 'plans.id', 'user_plans.plan_id')
            ->where('user_plans.user_id', '=', Auth::user()->id)
            ->get();
        $data['comision'] = Retire::select('retire.*')
            ->where('retire.user', '=', Auth::user()->id)
            ->get();

        //planes
        $data['plans'] = User_plan::select('user_plans.id', 'plans.name', 'charge', 'monto_disponible', 'monto_retirado')
            ->join('plans', 'plans.id', 'plan_id')
            ->leftJoin(DB::raw('(SELECT user_plan_id, SUM(amount) AS monto_disponible FROM user_plans
                INNER JOIN user_transaction ON user_transaction.user_plan_id = user_plans.id
                WHERE user_id = ' . Auth::user()->id . ' AND transaction_id IN (2,5)
                GROUP BY user_plan_id ) transacciones'), 
            function($join){
                $join->on('user_plans.id', '=', 'transacciones.user_plan_id');
            })
            ->leftJoin(DB::raw('(SELECT user_plan_id, SUM(amount) AS monto_retirado FROM user_plans
                INNER JOIN user_transaction ON user_transaction.user_plan_id = user_plans.id
                WHERE user_id = ' . Auth::user()->id . ' AND transaction_id = 1
                GROUP BY user_plan_id ) retiros'), 
            function($join){
                $join->on('user_plans.id', '=', 'retiros.user_plan_id');
            })
            ->where('user_id', '=', Auth::user()->id)
            ->where('status', '=', '1')
            ->get();

        $comision = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('reference_id', '=', Auth::user()->id)
            ->where('transaction_id', '=', 4)
            ->sum('amount');
        $retirado_comision = User_transaction::where('user', '=', Auth::user()->id)
            ->where('transaction_id', '=', 3)
            ->sum('amount');
        $data['comision_actual'] = $comision - $retirado_comision;
        
        return view('Main.withdraw.index')->with($data);
    }


    public function plan(Request $request){
        $this->validate($request, [
            'plan' => 'required',
            'amount' => 'required'
        ]);
        
        $plan = User_plan::select('user_plans.id', 'plans.name', 'charge', 'monto_disponible', 'monto_retirado')
        ->join('plans', 'plans.id', 'plan_id')
        ->leftJoin(DB::raw('(SELECT user_plan_id, SUM(amount) AS monto_disponible FROM user_plans
            INNER JOIN user_transaction ON user_transaction.user_plan_id = user_plans.id
            WHERE user_plans.id = ' . $request->plan . ' AND transaction_id IN (2,5)
            GROUP BY user_plan_id ) transacciones'), 
        function($join){
            $join->on('user_plans.id', '=', 'transacciones.user_plan_id');
        })
        ->leftJoin(DB::raw('(SELECT user_plan_id, SUM(amount) AS monto_retirado FROM user_plans
            INNER JOIN user_transaction ON user_transaction.user_plan_id = user_plans.id
            WHERE user_plans.id = ' . $request->plan . ' AND transaction_id = 1
            GROUP BY user_plan_id ) retiros'), 
        function($join){
            $join->on('user_plans.id', '=', 'retiros.user_plan_id');
        })
        ->where('user_plans.id', '=', $request->plan)
        ->where('status', '=', '1')
        ->first();

        $monto_disponible = $plan->monto_disponible - $plan->monto_retirado;

        if($monto_disponible > 0){
            if($monto_disponible >= $request->amount){
                DB::beginTransaction();
                    try {
                    $req = new Retire();
                    $req->user_plan_id = $request->plan;
                    $req->amount = $request->amount;
                    $req->save();
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                DB::commit();
                return redirect('withdraw')->with('success', 'Solicitud enviada');
            }else{
                return redirect('withdraw')->with('error', 'Saldo insuficiente');    
            }
        }else{
            return redirect('withdraw')->with('error', 'Saldo insuficiente');
        }

    }

    public function comision(Request $request){
        $this->validate($request, [
            'amount' => 'required',
            ]);
        DB::beginTransaction();
            try {
            $req = new Retire();
            $req->amount = $request->amount;
            $req->comision = 1;
            $req->user = Auth::user()->id;
            $req->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('withdraw')->with('success', 'Solicitud enviada');
    }

    public function cancel(Request $request){
        $ret = Retire::find($request->retire);
        DB::beginTransaction();
            try {
                $ret->done = 2;
                $ret->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('withdraw')->with('success', 'Solicitud cancelada');
    }
}
