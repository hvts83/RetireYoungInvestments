<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\User;
use App\Models\User_transaction;
use App\Models\User_plan;
use App\Helpers\Redes;
use App\Models\User_akademy;


class SociosController extends Controller
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
        $data['page_title'] = "Ver Socios";
        $data['socios'] = User::get();
        return view('Admin.socios.index')->with($data);
    }

    public function create(){
        $data['page_title'] = "Nuevo socio";
        $data['socios'] = User::get();
        return view('Admin.socios.create')->with($data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);
      
        DB::beginTransaction();
        try {
                $user = new User();
                $user->name= $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->reference = $request->reference;
                $user->code =  hash('md5', $request->email);
                $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/socios');
    }

    public function edit($id){
        $data['page_title'] = "Nuevo socio";
        $data['socio'] = User::find($id);
        return view('Admin.socios.edit')->with($data);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'password' => 'confirmed',
        ]);
      
        $user = User::find($id);

        DB::beginTransaction();
            try {
                $user->name= $request->name;
                $user->btc = $request->btc;
                if($request->has('password')){
                    $user->password = Hash::make($request->password);
                }
                $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/admin/socios/view/' . $user->id);
    }

    public function view($id){
        $data['page_title'] = "Ver Socio";
        
        $data['socio'] = User::find($id);
        $data['reference'] = User::find($data['socio']->reference);
        $data['comision'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('reference_id', '=', $id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $data['retirado_comision'] = User_transaction::where('user', '=', $id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision_actual'] = $data['comision'] - $data['retirado_comision'];
        $data['rentabilidad'] = User_plan::join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', $id)
        ->where('end_at', '>=', Carbon::now())
        ->sum('rentability');
        $data['ganado'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', $id)
        ->whereIn('transaction_id', [2, 5 ])
        ->sum('amount');
        $data['retirado'] = User_transaction::join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', $id)
        ->where('transaction_id', '=', 1)
        ->sum('amount');
        $data['dinero_actual'] = $data['ganado'] - $data['retirado'];
        $data['invertido'] = User_Plan::where('user_id', '=', $id)->sum('charge');
        

        $data['planes_activos'] = User_plan::select('user_plans.*', 'plans.name as plan', 'plans.days')
        ->join('plans', 'plans.id', 'plan_id')
        ->where('user_id', '=', $id)
        ->where('status', '=', 1)
        ->get();
        $data['referidos'] = User::selectRaw('users.*, bonus')
            ->join('user_plans', 'user_id', 'users.id')
            ->where('first','=', 1)
            ->where('reference', '=', $id)
            ->get();
        $data['planes'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name')
            ->join('user_plans', 'user_plans.id', 'user_plan_id')
            ->join('plans', 'plans.id', 'plan_id')
            ->where('user_id', '=', $id)
            ->where('plans.special', '=', '0')
            ->get();
        $data['especiales'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name, transaction.name as transactionName')
        ->join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->join('transaction', 'transaction.id', 'transaction_id')
        ->where('user_id', '=', $id)
        ->where('plans.special', '!=', '0')
        ->where('transaction_id', '=', '5')
        ->get();
        $data['comisiones'] = User_transaction::selectRaw('user_transaction.*, end_at, charge, status, plans.name, transaction.name as transactionName')
        ->join('user_plans', 'user_plans.id', 'user_plan_id')
        ->join('plans', 'plans.id', 'plan_id')
        ->join('transaction', 'transaction.id', 'transaction_id')
        ->where('user_id', '=', $id)
        ->where('transaction_id', '=', '4')
        ->get();

        $data['niveles'] = Redes::getComisionSocio($id);
        $data['cursos_niveles'] = Redes::getCursosSocio($id);

        $comision_ak = User_akademy::where('user_id', '=', $id)
        ->where('transaction_id', '=', 4)
        ->sum('amount');
        $retirado_comision_ak = User_akademy::where('user_id', '=', $id)
        ->where('transaction_id', '=', 3)
        ->sum('amount');
        $data['comision_akademy'] = $comision_ak - $retirado_comision_ak;

        return view('Admin.socios.view')->with($data);
    }
}
