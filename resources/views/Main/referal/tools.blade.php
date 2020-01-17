@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Compra de Planes BTC</h5></div>
                <div class="ibox-content">
                    Tu link de Referido es : <a href="{{ url('register/' . $code) }}">{{ url('register/' . $code) }}</a>
                    <div class="input-group">
                        <input type="text" class="form-control" disabled placeholder="{{ url('register/' . $code) }}"> 
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary">Go!</button> 
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <h5>Condiciones</h5>
            </div>
            <div class="ibox-content">
              Por referidos recibes 5% de comisi&oacute;n en la compra del primer plan. 
              </div>
          </div>
        </div>
    </div>
</div>
@endSection