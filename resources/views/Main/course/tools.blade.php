@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Código de referencia</h5></div>
                <div class="ibox-content">
                    Tu link de Referido es : <a href="{{ url('register/akademy/' . $code) }}">{{ url('register/akademy/' . $code) }}</a>
                    <br>
                    <input type="text" class="form-control" readonly placeholder="{{ url('register/akademy/' . $code) }}"> 
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Invitar</h5></div>
                <div class="ibox-content">
                    <form role="form" method="post" action="{{ url('/course/send') }}">	                    
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Correo">
                            {{ csrf_field() }}
                        </div>  	
                        <div class="mail-body text-right tooltip-demo">	
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-reply"></i> Enviar</button>	
                        </div>	
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <h5>Condiciones</h5>
            </div>
            <div class="ibox-content">
              Por cada referido que tengas más ganas. <br>
              Al tener referidos directos (primer nivel) por cada curso activo recibes 20% del curso que paga.
              En el segundo nivel tus ganas 10% de los cursos que pagan.
              En el tercer y cuarto nivel ganas 5%. 
              </div>
          </div>
        </div>
    </div>
</div>
@endSection