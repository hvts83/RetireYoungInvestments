<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use App\Helpers\Redes;
use App\Mail\alert;
use App\Mail\invitation;

use App\User;
use App\Models\User_course;
use App\Models\User_akademy;
use App\Models\Retire_akademy;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    /**
     * Muestra los cursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Referidos";
        $data['comision'] = 0;
        $data['cursos'] = User_course::select('name', 'price', 'status')
            ->join('courses', 'courses.id', 'user_courses.course_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $comision = User_akademy::where('user_id', '=', Auth::user()->id)
            ->where('transaction_id', '=', 4)
            ->sum('amount');
        $retirado_comision = User_akademy::where('user_id', '=', Auth::user()->id)
            ->where('transaction_id', '=', 3)
            ->sum('amount');
        $data['comision_actual'] = $comision - $retirado_comision;

        return view('Main.course.index')->with($data);
    }

    public function tools(){
        $data['page_title'] = "Herramientas";
        $data['code'] = Auth::user()->code;
        return view('Main.course.tools')->with($data);
    }

    public function sendRequest(Request $request){	
        $this->validate($request, [	
            'email' => 'required',	
        ]);	
        $composeMail = [];	
        $composeMail['name'] = Auth::user()->name;	
        $composeMail['email'] = $request->email;	
        $composeMail['code'] = Auth::user()->code;
    	
        Mail::to($composeMail['email'])	
            ->send(new invitation($composeMail));	
        	
        Mail::to('contact@retireyoung.co')	
            ->send(new alert($composeMail));	
         DB::commit();	
        return redirect('/course/tools');	
    }

    public function referal(){
        $data = Redes::getRedSocio( Auth::user()->id );
        $data['page_title'] = "Referidos";

        $comision = User_akademy::where('user_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $retirado_comision = User_akademy::where('user_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision_akademy'] = $comision - $retirado_comision;

        $data['niveles'] = Redes::getComisionSocio(Auth::user()->id);
        $data['cursos_niveles'] = Redes::getCursosSocio(Auth::user()->id);

        return view('Main.course.referal')->with($data);
    }

    public function retire(){
        $data['page_title'] = "Retirar comisiones";
        //Minipaneles
        $comision = User_akademy::where('user_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $retirado_comision = User_akademy::where('user_id', '=', Auth::user()->id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision_actual'] = $comision - $retirado_comision;

        $data['comision'] = Retire_akademy::where('user_id', '=', Auth::user()->id)
            ->get();

        return view('Main.course.retire')->with($data);
    }

    public function postRetire(Request $request){
        $this->validate($request, [
            'amount' => 'required',
            ]);
        DB::beginTransaction();
            try {
            $req = new Retire_akademy();
            $req->amount = $request->amount;
            $req->user_id = Auth::user()->id;
            $req->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('course/retire')->with('success', 'Solicitud enviada');
    }

    public function pay()
    {
        return view('Main.course.pay');
    }
}
