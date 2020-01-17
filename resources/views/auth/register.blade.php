@extends('landing.layout')

@section('body')

<header class="masthead" style="background-image: url('{{ url('img/login/registro.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-10 mx-auto ">
          <div class="site-heading">
            <section>
              <div class="container register-back">
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2>Registrate <small>Crea tu cuenta gratuita.</small></h2>
                    <hr class="colorgraph"><div class="form-group">
                        <div class="form-group">
                            <input 
                                id="name" 
                                type="text" 
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} input-lg" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus
                                placeholder="Nombre completo"
                                />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
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
                        @if( empty($reference) === false )
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" value="{{ 'Referido de ' . $reference->name }}" disabled />
                                <input type="hidden" name="reference_id" value="{{ $reference->id }}">
                            </div>
                        @endif
                        @if( empty($akademy) === false)
                            <input type="hidden" name="akademy_id" value="{{ $akademy->id }}">
                        @endif
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input 
                                        id="password" 
                                        type="password" 
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-lg" 
                                        name="password" 
                                        required
                                        placeholder="Contrase&ntilde;a"
                                        />
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input 
                                        id="password-confirm" 
                                        type="password" 
                                        class="form-control input-lg" 
                                        name="password_confirmation" 
                                        required
                                        placeholder="Confirmar Contrase&ntilde;a"
                                        />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <strong class="label label-primary">Al registrarse</strong>, estas deacuerdo con los <a href="{{ url('terminos')}}" target="_blank">Terminos y Condiciones</a> establecidos por el sitio.
                            </div>
                        </div>

                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-12 col-md-6"><input type="submit" value="Registrarse" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                            <div class="col-xs-12 col-md-6"><a href="{{ url('login' )}}" class="btn btn-success btn-block btn-lg">Iniciar Sesion</a></div>
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