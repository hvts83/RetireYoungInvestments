@extends('landing.layout')

@section('body')
    <!--==========================
    Intro Section
  ============================--> 

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ url('img/login/registro.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-10 mx-auto ">
          <div class="site-heading">
            <section>
              <div class="container register-back">
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf  
                    <h2>Reiniciar clave</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-lg"
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            placeholder="Correo"
                            />
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-lg" placeholder="Contraseña" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} input-lg"  placeholder="Confirmar contraseña" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <hr class="colorgraph">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary btn-block btn-lg" tabindex="7">
                </div>
            </div>
        </form>
      </div>
    </section>
  </div>
</div>
</div>
</div>
</header>
<!-- #intro -->

@endsection