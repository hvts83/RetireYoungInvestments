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
use App\Models\Plan;
use App\Models\User_transaction;
use App\Models\Retire;

class UserPlansController extends Controller
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

    public function index(){

        $data['page_title'] = "Planes de usuarios";
        $data['planes'] = User_plan::select('user_plans.*', 'email', 'users.name as user', 'plans.name as plan', 'plans.days')
            ->join('plans', 'plans.id', 'plan_id')
            ->join('users', 'users.id', 'user_id')
            ->get();
        return view('Admin.user_plans.index')->with($data);
    }

    public function getActivate(){
        $data['page_title'] = "Activar plan";
        $data['users'] = User::get();
        $data['plans'] = Plan::get();

        return view('Admin.user_plans.activate')->with($data);        
    }

    public function postActivate(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'plan_id' => 'required',
            'start_at' => 'required',
            'charge' => 'required',
            ]);
            
            $plan = Plan::find($request->plan_id);
            $user = User::find($request->user_id);
            $firtsPlan = User_plan::where('user_id', '=', $request->user_id)->count();
            $gananciaReferido = ($plan->referal_earning * $request->charge) / 100;
            DB::beginTransaction();
                try {
                $user_plan = new User_plan();
                $user_plan->user_id = $request->user_id;
                $user_plan->plan_id = $request->plan_id;
                $user_plan->start_at = $request->start_at;
                $user_plan->end_at = Carbon::createFromFormat('Y-m-d', $request->start_at)->addDays($plan->days);
                $user_plan->charge = $request->charge;
                $user_plan->status = 1;
                if( $firtsPlan > 0){
                    $user_plan->first = 0;
                    $user_plan->bonus = 0;
                }else{
                    $user_plan->first = 1;
                    $user_plan->bonus = $gananciaReferido;
                }
                $user_plan->save();

                if( $firtsPlan === 0 && $user->reference !== null ){
                    $user_transaction = new User_transaction();
                    $user_transaction->user_plan_id = $user_plan->id;
                    $user_transaction->transaction_id = 4;
                    $user_transaction->amount = $user_plan->bonus;
                    $user_transaction->reference_id = $user->reference;
                    $user_transaction->save();
                }
                if($plan->special !== 0){
                    if($plan->special === 1){
                        $plan->used_plans += 1;
                        $plan->save();
                    }
                    
                    //Revisar si son anteriores
                    $today = Carbon::now();
                    $start_at = Carbon::createFromFormat('Y-m-d', $request->start_at);
                    $diference = $today->diffInDays($start_at, false);
                    $start_at->subDay();
                    if( $diference < 0 ){
                        for($diference; $diference < 0; $diference++ ){
                            $old_t = new User_transaction();
                            $old_t->user_plan_id = $user_plan->id;
                            $old_t->transaction_id = 5;
                            $old_t->amount = $plan->daily;
                            $old_t->created_at = $start_at->addDay();
                            $old_t->save();
                        }
                    }  
                }
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();
            return redirect('/admin/user-plans/index');
    }

    public function view($id){
        $data['page_title'] = "Ver plan";
        $user_plan = User_plan::find($id);
        $data['user_plan'] = $user_plan;
        $data['user'] = User::find($user_plan->user_id);
        $data['plan'] = Plan::find($user_plan->plan_id);
        $data['transactions'] = User_transaction::select('user_transaction.*', 'transaction.name')
            ->join('transaction', 'transaction.id', 'user_transaction.transaction_id')
            ->where('user_plan_id', '=', $user_plan->id)
            ->get();
        return view('Admin.user_plans.view')->with($data);        
    }

    public function request($id){
        $data['page_title'] = "Ver plan";
        $user_plan = User_plan::find($id);
        $data['user_plan'] = $user_plan;
        $data['plan'] = Plan::find($user_plan->plan_id);
        $data['user'] = User::find($user_plan->user_id);
        return view('Admin.user_plans.request')->with($data);
    }

    public function postRequest(Request $request){
        $this->validate($request, [
            'plan' => 'required',
            'amount' => 'required',
            'btc' => 'required',
            ]);
        DB::beginTransaction();
            try {
            $req = new Retire();
            $req->user_plan_id = $request->plan;
            $req->amount = $request->amount;
            $req->btc = $request->btc;
            $req->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }
}
