<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landing.index');
    }

    public function akademy()
    {
        return view('landing.akademy');
    }
    public function contacto()
    {
        return view('landing.contacto');
    }
    public function equipo()
    {
        return view('landing.equipo');
    }
    public function inversion()
    {
        return view('landing.inversion');
    }
	 public function privacidad()
    {
        return view('landing.privacidad');
    }
	 public function terminos()
    {
        return view('landing.terminos');
    }
    public function mail(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required'
            ]);

        $composeMail = [];
        $composeMail['name'] = $request->name;
        $composeMail['email'] = $request->email;
        $composeMail['subject'] = $request->subject;
        $composeMail['body'] = $request->body;
        
        Mail::to('contact@retireyoung.co')
            ->send(new contact($composeMail));
        return redirect('contacto');
    }
}
