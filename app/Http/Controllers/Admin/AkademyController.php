<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Redes;

use App\User;
use App\Models\User_akademy;
use App\Models\Retire_akademy;
use App\Models\User_course;
use App\Models\Course;
use App\Models\Red;

class AkademyController extends Controller
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
    public function getReferal()
    {
        $data['page_title'] = "Realizar referencia";
        $data['users'] = User::get();
        return view('Admin.akademy.referal')->with($data);
    }

    public function postReferal(Request $request){
        $this->validate($request, [
            'parent' => 'required',
            'user_id' => 'required',
        ]);
    
        DB::beginTransaction();
                try {
                $red = new Red();
                $red->user_id = $request->user_id;
                $red->parent = $request->parent;
                $red->status = 0;
                $red->level = 1;
                $red->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/akademy/referal');
    }

    public function getActive(){
        $data['page_title'] = "Cursos activos";
        $data['courses'] = User_course::select('user_courses.id', 'users.name as user', 'courses.name as course', 'status', 'user_courses.updated_at', 'date_activation', 'activation')
            ->join('users', 'users.id', 'user_id')
            ->join('courses', 'courses.id', 'course_id')
            ->get();
        return view('Admin.akademy.index')->with($data);
    }

    public function make(){
        $data['page_title'] = "Asignacion de curso a usuarios";
        $data['users'] = User::get();
        $data['courses'] = Course::get();
        return view('Admin.akademy.make')->with($data);
    }

    public function send(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'course_id' => 'required',
        ]);
    
        DB::beginTransaction();
            try {
                $user_course = new User_course();
                $user_course->user_id = $request->user_id;
                $user_course->course_id = $request->course_id;
                $user_course->status = 0;
                $user_course->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/akademy/index');
    }

    public function postActive(Request $request, $id){
        $ucourse = User_course::find($id);
            if($ucourse->status == 0){
                $ucourse->status = 1;
                $ucourse->activation = 1;
                $ucourse->date_activation = Carbon::now();
            }else{
                $ucourse->status = 0;
                $ucourse->activation = 0;
            }
        $ucourse->save();
        //Verificacion de usuario
        if($ucourse->status == 1){
            $red = Red::where('user_id', '=', $ucourse->user_id)->first();
            $red->status = 1;
            $red->save();
        }else{
            $courses = User_course::where('user_id', '=', $ucourse->user_id)
                ->where('status', '=', 1)
                ->count('user_id');
            if($courses == 0){
                $red = Red::where('user_id', '=', $ucourse->user_id)->first();
                $red->status = 0;
                $red->save();
            }
        }
        return redirect('/admin/akademy/index');
    }

    public function verify(Request $request, $id){
        $ucourse = User_course::find($id);
        $ucourse->activation = 1;
        $ucourse->date_activation = Carbon::now();
        $ucourse->save();
        return redirect('/admin/akademy/index');
    }

    public function getTransaction(){
        $data['page_title'] = "Realizar transacciones";
        return view('Admin.akademy.transaction')->with($data);
    }

    public function postTransaction(Request $request){
        $this->validate($request, [
            'date' => 'required',
        ]);

        $date =  Carbon::createFromFormat('Y-m-d', $request->date);
        $cutDay = $date->day;
        $daysOfMonth = $date->daysInMonth;
        
        $users = User::get();
        
        DB::beginTransaction();
        try{
            //Verificador de usuarios
            foreach($users as $user){
                $niveles = Redes::getComisionSocio($user->id);

                //Sumando ganancia
                $ganancia = $niveles[1] * 0.30;
                //$ganancia = $ganancia + ($niveles[2] * 0.1);
                //$ganancia = $ganancia + ($niveles[3] * 0.05);
                //$ganancia = $ganancia + ($niveles[4] * 0.05);
                
                if($ganancia > 0){
                    $user_akademy = new User_akademy();
                    $user_akademy->user_id = $user->id;
                    $user_akademy->transaction_id = 4;
                    $user_akademy->amount = $ganancia;
                    $user_akademy->save();                   
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/akademy/transaction');
    }

    public function retire(){
        $data['page_title'] = "Ver Solicitudes";
        $data['retire'] = Retire_akademy::select('users.name', 'retire_akademy.*')
            ->join('users', 'users.id', 'user_id')
            ->get();
        return view('Admin.akademy.retire')->with($data);
    }
    
    public function viewRetire($id){
        $data['page_title'] = "Solicitud de retiro";
        $data['retire'] = Retire_akademy::find($id);
        $data['usuario'] = User::find( $data['retire']->user_id );
        return view('Admin.akademy.retireview')->with($data);
    }

    public function submitRetire(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire_akademy::find($id);
            $retire->done = 1;
            $retire->save();

            $user_akademy = new User_akademy();
            $user_akademy->user_id = $retire->user_id;
            $user_akademy->transaction_id = 3;
            $user_akademy->amount = $retire->amount;
            $user_akademy->save();   
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/retire');
    }

    public function cancelRetire(Request $request, $id){
        DB::beginTransaction();
        try {
            $retire = Retire_akademy::find($id);
            $retire->done = 2;
            $retire->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/akademy/retire');
    }
    
}
