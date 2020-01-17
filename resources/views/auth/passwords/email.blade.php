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
                  <form method="POST" action="{{ route('password.email') }}" class="smart-form client-form">
                      @csrf  
                    <h2>Reiniciar clave</h2>
                    <hr class="colorgraph">
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
            <hr class="colorgraph">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <input type="submit" value="Enviar cambio de clave" class="btn btn-primary btn-block btn-lg" tabindex="7">
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
