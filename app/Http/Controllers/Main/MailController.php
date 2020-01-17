<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;

use App\Models\Message;

class MailController extends Controller
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
    
    public function index()
    {
        $data['page_title'] = "Mensajes";
        $mails = Message::where('user_id', '=', Auth::user()->id);
        $data['mails'] = $mails->get();
        $data['new'] = $mails->where('read', '=', '0')->sum('id');
        return view('Main.mail.index')->with($data);
    }

    public function view($id){
        $data['page_title'] = "Mensajes";
        return view('Main.mail.view')->with($data);
    }

    public function getCompose()
    {
        $data['page_title'] = "Nuevo Mensaje";
        return view('Main.mail.compose')->with($data);
    }

    public function postCompose(Request $request){
        $this->validate($request, [
            'subject' => 'required',
            'body' => 'required',
            ]);

        $composeMail = [];
        $composeMail['name'] = Auth::user()->name;
        $composeMail['email'] = Auth::user()->email;
        $composeMail['subject'] = $request->subject;
        $composeMail['body'] = $request->body;

        Mail::to('contact@retireyoung.co')
            ->cc($composeMail['email'])
            ->send(new contact($composeMail));

        DB::commit();
        return redirect('/mailbox/compose');
    }
}
