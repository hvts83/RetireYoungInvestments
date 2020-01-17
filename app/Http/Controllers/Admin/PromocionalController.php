<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Plan;

class PromocionalController extends Controller
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
        $data['page_title'] = "Ver planes regulares";
        $data['planes'] = Plan::where('special', '!=', '0')->get();
        return view('Admin.promocional.index')->with($data);   
    }

    public function create(){
        $data['page_title'] = "Nuevo plan";
        return view('Admin.promocional.create', $data);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'daily' => 'required',
        'total' => 'required',
        'days' => 'required',
        'rentability' => 'required',
        'total_plans' => 'required',
        'referal_earning' => 'required',
        'fundador' => 'required'
        ]);

        DB::beginTransaction();
            try {
            $plan = new Plan();
            $plan->name = $request->name;
            $plan->daily = $request->daily;
            $plan->total = $request->total;
            $plan->days = $request->days;
            $plan->rentability = $request->rentability;
            $plan->total_plans = $request->total_plans;
            $plan->referal_earning = $request->referal_earning;
            $plan->special = $request->fundador;
            $plan->activado = 0;
            $plan->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/promocional');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title']  = "Editar plan";
        $data['plan'] =  Plan::find($id);
        if ($data['plan']  == null) { return redirect('admin/promocional'); } //Verificación para evitar errores
        return view('Admin.promocional.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'daily' => 'required',
            'total' => 'required',
            'days' => 'required',
            'rentability' => 'required',
            'total_plans' => 'required',
            'referal_earning' => 'required'
            ]);
        $plan = Plan::find($id);

        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
        try {
            $plan->name = $request->name;
            $plan->daily = $request->daily;
            $plan->total = $request->total;
            $plan->days = $request->days;
            $plan->rentability = $request->rentability;
            $plan->total_plans = $request->total_plans;
            $plan->referal_earning = $request->referal_earning;
            $plan->save();
        } catch (\Exception $e) {
        DB::rollback();
        throw $e;
        }
    DB::commit();
        return redirect('admin/promocional/'. $id . "/edit");
    }

    public function activar(Request $request, $id){
        $plan = Plan::find($id);
        if($plan->activado == 0){
            $plan->activado = 1;
        }else{
            $plan->activado = 0;
        }
        $plan->save();
        return redirect('/admin/promocional');
    }
}
