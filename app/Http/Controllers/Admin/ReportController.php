<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Plan;
use App\User;

class ReportController extends Controller
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
        $data['page_title'] = "Reportes del sistema";

        $data['planes'] = Plan::get();
        return view('Admin.report.index')->with($data);   
    }

    public function activos(Request $request){
        $data['page_title'] = "Planes activos";

        $query = Plan::select('user_plans.id', 'plans.name as plan', 'special', 'charge', 'users.name as usuario', 'email', 'start_at')
        ->join('user_plans', 'plans.id', '=', 'user_plans.plan_id')
        ->join('users', 'users.id', '=', 'user_id');
        
        if($request->has('plan')){
            $query->where('plan_id', '=',  $request->plan);
        }
        if($request->inicio != '' and $request->fin != '' ){
            $query->whereBetween('start_at', 
            [ 
                Carbon::createFromFormat('d-m-Y', $request->inicio), 
                Carbon::createFromFormat('d-m-Y', $request->fin) 
            ]);
        }elseif($request->mes != ''){
            $query->whereRaw('MONTH(?) = MONTH(start_at) AND YEAR(?) = YEAR(start_at)',
            [
                Carbon::createFromFormat('d-m-Y', $request->mes),
                Carbon::createFromFormat('d-m-Y', $request->mes)
            ]);
        }
        $data['activos'] = $query->get();
        return view('Admin.report.activo')->with($data);   
    }

    public function retiro(Request $request){
        $data['page_title'] = "Retiros";

        $query = Plan::select('retire.id', 'plans.name as plan', 'special', 'retire.amount', 'users.name as usuario', 'email', 'retire.updated_at')
        ->join('user_plans', 'plans.id', '=', 'user_plans.plan_id')
        ->join('users', 'users.id', '=', 'user_id')
        ->join('retire', 'retire.user_plan_id', '=', 'user_plans.id');

        if($request->has('plan')){
            $query->where('plan_id', '=',  $request->plan);
        }
        if($request->inicio != '' and $request->fin != '' ){
            $query->whereBetween('retire.updated_at', 
            [ 
                Carbon::createFromFormat('d-m-Y', $request->inicio), 
                Carbon::createFromFormat('d-m-Y', $request->fin) 
            ]);
        }elseif($request->mes != ''){
            $query->whereRaw('MONTH(?) = MONTH(retire.updated_at) AND YEAR(?) = YEAR(retire.updated_at)',
            [
                Carbon::createFromFormat('d-m-Y', $request->mes),
                Carbon::createFromFormat('d-m-Y', $request->mes)
            ]);
        }
        $data['retiros'] = $query->get();
        return view('Admin.report.withdraw')->with($data);   
    }

    public function comision(Request $request){
        $data['page_title'] = "Comisiones";

        $query = User::select('retire.id', 'retire.amount', 'users.name as usuario', 'retire.updated_at')
        ->join('retire', 'retire.user', '=', 'users.id')
        ->where('comision', '=', '1');
        
        if($request->inicio != '' and $request->fin != '' ){
            $query->whereBetween('retire.updated_at', 
            [ 
                Carbon::createFromFormat('d-m-Y', $request->inicio), 
                Carbon::createFromFormat('d-m-Y', $request->fin) 
            ]);
        }elseif($request->mes != ''){
            $query->whereRaw('MONTH(?) = MONTH(retire.updated_at) AND YEAR(?) = YEAR(retire.updated_at)',
            [
                Carbon::createFromFormat('d-m-Y', $request->mes),
                Carbon::createFromFormat('d-m-Y', $request->mes)
            ]);
        }
        $data['comisiones'] = $query->get();
        return view('Admin.report.comision')->with($data); 
    }

}
