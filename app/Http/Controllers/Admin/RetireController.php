<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\User_transaction;
use App\Models\Retire;
use App\Models\User_plan;

class RetireController extends Controller
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
        $data['page_title'] = "Ver Solicitudes";
        $data['retire'] = Retire::select('users.name', 'plans.name as plan', 'retire.*', 'start_at', 'end_at', 
            'charge', 'status',	'first', 'bonus')
            ->join('user_plans', 'user_plans.id', 'user_plan_id')
            ->join('users', 'users.id', 'user_id')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('comision', '=', 0)
            ->get();
        $data['comision'] = Retire::select('users.name', 'retire.*')
            ->join('users', 'users.id', 'user')
            ->where('comision', '=', 1)
            ->get();
        return view('Admin.retire.index')->with($data);
    }

    public function view($id){
        $data['page_title'] = "Solicitud de retiro de plan";
        $data['retire'] = Retire::find($id);
        $data['plan'] = User_plan::select('name as plan', 'user_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_plans.id', '=', $data['retire']->user_plan_id )
        ->first();
        $data['usuario'] = User::find( $data['plan']->user_id );
        return view('Admin.retire.view')->with($data);
    }

    public function submit(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire::find($id);
            $retire->done = 1;
            $retire->save();

            $new_t = new User_transaction();
            $new_t->user_plan_id = $retire->user_plan_id;
            $new_t->transaction_id = 1;
            $new_t->amount = $retire->amount;
            $new_t->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }

    public function cancel(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire::find($id);
            $retire->done = 2;
            $retire->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }

    public function comision($id){
        $data['page_title'] = "Solicitud de retiro de comision";
        $data['retire'] = Retire::find($id);
        $data['user'] = User::find( $data['retire']->user );
        return view('Admin.retire.comision')->with($data);
    }

    public function submit_comision(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire::find($id);
            $retire->done = 1;
            $retire->save();

            $new_t = new User_transaction();
            $new_t->user_plan_id = 0;
            $new_t->transaction_id = 3;
            $new_t->amount = $retire->amount;
            $new_t->user = $retire->user;
            $new_t->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }

    public function cancel_comision(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire::find($id);
            $retire->done = 2;
            $retire->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }
}