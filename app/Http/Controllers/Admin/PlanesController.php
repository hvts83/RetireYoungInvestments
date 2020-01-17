<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Plan;

class PlanesController extends Controller
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
        $data['planes'] = Plan::where('special', '=', '0')->get();
        return view('Admin.planes.index')->with($data);   
    }

    public function create(){
        $data['page_title'] = "Nuevo plan";
        return view('Admin.planes.create', $data);
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
        'minimum_percentage' => 'required',
        'maximum_percentage' => 'required',
        'days' => 'required',
        'referal_earning' => 'required'
        ]);

        DB::beginTransaction();
            try {
            $plan = new Plan();
            $plan->name = $request->name;
            $plan->minimum_percentage = $request->minimum_percentage;
            $plan->maximum_percentage = $request->maximum_percentage;
            $plan->days = $request->days;
            $plan->referal_earning = $request->referal_earning;
            $plan->special = 0;
            $plan->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/planes');
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
        if ($data['plan']  == null) { return redirect('admin/planes'); } //Verificación para evitar errores
        return view('Admin.planes.edit', $data);
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
            'minimum_percentage' => 'required',
            'maximum_percentage' => 'required',
            'days' => 'required',
            'referal_earning' => 'required'
            ]);
        $plan = Plan::find($id);

        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
        try {
            $plan->name = $request->name;
            $plan->minimum_percentage = $request->minimum_percentage;
            $plan->maximum_percentage = $request->maximum_percentage;
            $plan->days = $request->days;
            $plan->referal_earning = $request->referal_earning;
            $plan->save();
        } catch (\Exception $e) {
        DB::rollback();
        throw $e;
        }
    DB::commit();
        return redirect('admin/planes/'. $id . "/edit");
    }
}
