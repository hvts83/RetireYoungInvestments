<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use DB;
use Auth;
use App\Admin;
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
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['page_title'] = "Perfil";
        $data['image'] = Image::find( Auth::user()->image_id );

        return view('Admin.profile')->with($data);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
      
        $user = Admin::find(Auth::user()->id);

        DB::beginTransaction();
            try {
                $user->name= $request->name;
                $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/profile')->with('success', 'Datos actualizados');
    }

    public function password(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
      
        $user = Admin::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            DB::beginTransaction();
            try {
                $user->password = Hash::make($request->password);
                $user->save();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();
        }else{
            return redirect('/admin/profile')->with('error', 'Clave invalida');
        }
        return redirect('/admin/profile')->with('success', 'Cambio de clave exitoso');
    }

    public function upload(Request $request){
        $this->validate($request, [
            'imagen' => 'image|required',
          ]);
      
        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
        try {
            $url = 'img/admins/';
            $imageName = Auth::user()->id. 'img' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move( '/home2/owtfnqmy/public_html/' . $url , $imageName );
            $imagen = new image();
            $imagen->url = $url . '/' . $imageName;
            $imagen->save();
        
            $user = Admin::find(Auth::user()->id);
            $user->image_id = $imagen->id;
            $user->save();
    
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/profile')->with('success', 'Foto actualizada');
    }
}
