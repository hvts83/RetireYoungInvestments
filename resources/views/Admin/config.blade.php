@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <p class="text-center"> Codigo actual </p>     
                    <img src={{"https://qrcode.online/img/?type=text&size=8&data=" . $config->qr  }} width="240px" higth="" />
                    <p class="text-center">{{ $config->qr }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <fieldset>
                    <legend>Configuración</legend>
                    <form action="{{ url('admin/config') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Codigo QR</label>
                            <input type="text" placeholder="QR" class="form-control" name="qr" value="{{ $config->qr }}">
                        </div>
                        <div>
                            <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                        </div>
                    </form>
                </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
    <link href="{{ asset('backoffice/css/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('backoffice/js/jasny/jasny-bootstrap.min.js')}}"></script>
@endsection