<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Red;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcome;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function referenceRegister($code){
        $data['reference'] = User::where('code', '=', $code)->first();
        return view('auth.register')->with($data);
    }

    public function AkademyRegister($code){
        $data['reference'] = User::where('code', '=', $code)->first();
        $data['akademy'] = User::where('code', '=', $code)->first();
        return view('auth.register')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $composeMail = [];
        $composeMail['name'] = $data['name'];
        $composeMail['email'] = $data['email'];
        $composeMail['subject'] = "Bienvenido a Retire Young";

        Mail::to($data['email'])
            ->send(new welcome($composeMail));

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'code' => hash('md5', $data['email']),
            'reference' => isset( $data['reference_id'] ) ? $data['reference_id'] : null
        ]);

        if(isset( $data['akademy_id'])){
            $red = new Red();
            $red->user_id = $user->id;
            $red->parent = $data['akademy_id'];
            $red->status = 0;
            $red->level = 1;
            $red->save();
        }

        return $user;
    }
}
