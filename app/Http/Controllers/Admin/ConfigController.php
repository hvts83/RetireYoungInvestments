<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Config;

class ConfigController extends Controller
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
        $data['page_title'] = "Configuración";
        $data['config'] = Config::find(1);
        return view('Admin.config')->with($data);
    }

    public function update(Request $request){
        $this->validate($request, [
            'qr' => 'required',
        ]);
      
        DB::beginTransaction();
        try {
                $config = Config::find(1);
                $config->qr= $request->qr;
                $config->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/config');
    }
}
