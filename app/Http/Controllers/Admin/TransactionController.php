<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\User_plan;
use App\Models\User_transaction;
use App\Models\Plan;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Realizar transacciones";
        $data['plans'] = Plan::where('special','=', 0)->get();
        return view('Admin.transaccion.index')->with($data);
    }

    public function daily(Request $request){
        $this->validate($request, [
            'date' => 'required',
            ]);
        $plans = User_Plan::select('user_plans.id', 'daily')
            ->where('end_at', '>=', Carbon::createFromFormat('Y-m-d', $request->date))
            ->where('start_at', '<=', Carbon::createFromFormat('Y-m-d', $request->date))
            ->where('special', '!=', '0')
            ->where('status', '=', '1')
            ->join('plans', 'plans.id', 'plan_id')
            ->get();
        
        DB::beginTransaction();
        try{
            foreach($plans as $plan){
                $new_t = new User_transaction();
                $new_t->user_plan_id = $plan->id;
                $new_t->transaction_id = 5;
                $new_t->amount = $plan->daily;
                $new_t->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/transaction');
    }

    public function monthly(Request $request){
        $this->validate($request, [
            'plan' => 'required',
            'porcentaje' => 'required',
            'date' => 'required',
            ]);

        $date =  Carbon::createFromFormat('Y-m-d', $request->date);
        $cutDay = $date->day;
        $daysOfMonth = $date->daysInMonth;
        
        $plans = User_Plan::select('user_plans.id', 'charge', 'start_at')
            ->where('end_at', '>=', $date )
            ->where('start_at', '<=', $date )
            ->where('special', '=', '0')
            ->where('status', '=', 1)
            ->where('plan_id', '=', $request->plan)
            ->join('plans', 'plans.id', 'plan_id')
            ->get();
        

        DB::beginTransaction();
        try{
            foreach($plans as $plan){
                if( $date->diffInMonths($plan->start_at) == 0 ){
                    $dias_pagar = $date->diffInDays($plan->start_at);
                }else{
                    $dias_pagar = $cutDay;
                }

                $pagarPorcentaje = ($plan->charge * $request->porcentaje)/100;

                $new_t = new User_transaction();
                $new_t->user_plan_id = $plan->id;
                $new_t->transaction_id = 2;
                $new_t->amount = ($dias_pagar*$pagarPorcentaje)/$daysOfMonth ;
                $new_t->percentage = $request->porcentaje;
                $new_t->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/transaction');
    }
}
