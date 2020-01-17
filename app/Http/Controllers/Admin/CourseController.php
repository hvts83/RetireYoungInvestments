<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Course;

class CourseController extends Controller
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
        $data['page_title'] = "Ver cursos";
        $data['courses'] = Course::get();
        return view('Admin.courses.index')->with($data);   
    }

    public function create(){
        $data['page_title'] = "Nuevo Curso";
        return view('Admin.courses.create', $data);
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
        'price' => 'required',
        ]);
        DB::beginTransaction();
            try {
            $course = new Course();
            $course->name = $request->name;
            $course->price = $request->price;
            $course->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/course');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title']  = "Editar curso";
        $data['course'] =  Course::find($id);
        if ($data['course']  == null) { return redirect('admin/course'); } //Verificación para evitar errores
        return view('Admin.courses.edit', $data);
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
            'price' => 'required',
            ]);
        $course = Course::find($id);

        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
        try {
            $course->name = $request->name;
            $course->price = $request->price;
            $course->save();
        } catch (\Exception $e) {
        DB::rollback();
        throw $e;
        }
    DB::commit();
        return redirect('admin/course/'. $id . "/edit");
    }

    public function show($id){

    }

    
}
