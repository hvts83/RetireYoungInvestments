<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Models\User_plan;
use App\Models\User_transaction;
use App\Models\User_course;

use Illuminate\Support\Facades\Mail;
use App\Mail\akademyActivation;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Dashboard";
        $data['registrados'] = User::count();
        $data['activos'] = User_plan::where('status', '=', 1)->count();
        $data['invertido'] = User_plan::sum('charge');
        $data['retirado'] = $data['retirado'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('transaction_id', '=', 1)
        ->sum('amount');
        $data['usuarios'] = User::select('users.*', 'referencer.name as reference_name')
            ->leftJoin('users as referencer', 'users.id', 'users.reference')
            ->get();
        $data['referidos'] = User::select('users.*')
            ->where('reference', '!=', '')
            ->get();
        $data['planes'] = User_plan::select('user_plans.*', 'email', 'users.name as user', 'plans.name as plan', 'plans.days')
            ->join('plans', 'plans.id', 'plan_id')
            ->join('users', 'users.id', 'user_id')
            ->get();
            
        $courses = User_course::select('user_courses.id', 'users.name as user', 'users.email', 'courses.name as course', 'status', 'date_activation', 'activation')
            ->join('users', 'users.id', 'user_id')
            ->join('courses', 'courses.id', 'course_id')
            ->get();
        $today = Carbon::now();

        $listMail = [];
        foreach( $courses as $course ){
            $diference = $today->diffInDays( $course->date_activation);
            if( $diference > 30 && $course->status ){ 
                if( $course->activation == 1 ){
                    $course->activation = 0;
                    $course->save();
                }
                $listMail[] = $course;
            }
        }

        if(count($listMail) > 0){
            $composeMail = [];
            $composeMail['subject'] = "Verificación de curso activo";
            $composeMail['list'] = $listMail;

            Mail::to('contact@retireyoung.co')
                ->send(new akademyActivation($composeMail));
        }            
            
        return view('Admin.dashboard')->with($data);
    }

}
