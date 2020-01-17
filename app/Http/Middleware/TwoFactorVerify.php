<?php
    namespace App\Http\Middleware;
    use Closure;
    use Auth;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\verify2fa;

    class TwoFactorVerify
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {   
            $user = Auth::user();
            if($user->token_2fa_expiry > \Carbon\Carbon::now()){
                return $next($request);
            } 
            
            $user->token_2fa = mt_rand(10000,99999);
            $user->save();
            
            $composeMail = [];
            $composeMail['name'] = $user->name;
            $composeMail['email'] = $user->email;
            $composeMail['codigo'] = $user->token_2fa;
            $composeMail['subject'] = "Código de verificación de acceso.";

            Mail::to($user->email)
                ->send(new verify2fa($composeMail));

            return redirect()->route('verify_code', ['uri' => $request->route()->uri] );  
        }
    }
