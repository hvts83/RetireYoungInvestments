<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use DB;
use Auth;
use App\User;
use App\Models\Image;

class ProfileController extends Controller
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

    public function index(){
        $data['page_title'] = "Mi perfil";
        $data['image'] = Image::find( Auth::user()->image_id );

        return view('Main.profile')->with($data);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
      
        $user = User::find(Auth::user()->id);

        DB::beginTransaction();
            try {
                $user->name= $request->name;
                $user->birthday = $request->birthday;
                $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/profile')->with('status', 'Datos actualizados.');
    }

    public function upload(Request $request){
        $this->validate($request, [
            'imagen' => 'image|required',
          ]);
      
        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
        try {
            $url = 'img/avatars/';
            $imageName = Auth::user()->id. 'img' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move( '/home2/owtfnqmy/public_html/' . $url , $imageName );
            $imagen = new image();
            $imagen->url = $url . '/' . $imageName;
            $imagen->save();
        
            $user = User::find(Auth::user()->id);
            $user->image_id = $imagen->id;
            $user->save();
    
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('profile')->with('status', 'Foto de perfil actualizada.');
    }
}
