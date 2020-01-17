@extends('landing.layout')

@section('body')
    <!--==========================
    Intro Section
  ============================--> 

<!-- Page Header -->
<header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-10 mx-auto ">
          <div class="site-heading">
            <section>
              <div class="container register-back">
                <form role="form" method="POST" action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}
                    <h2>Iniciar sesión</h2>
                    <hr class="colorgraph">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" class="form-control input-lg" placeholder="Correo" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control input-lg" placeholder="Contraseña" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-block btn-lg" tabindex="7">
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
