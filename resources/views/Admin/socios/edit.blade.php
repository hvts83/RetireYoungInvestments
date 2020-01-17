@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <fieldset class="form-horizontal">
                    <form role="form" method="post" action="{{ url('admin/socios/' . $socio->id ) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" placeholder="Nombre" class="form-control" name="name" value="{{ $socio->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Email" class="form-control" name="email" value="{{ $socio->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>BTC Wallet</label>
                            <input type="text" placeholder="BTC" class="form-control" name="btc" value="{{ $socio->btc }}">
                        </div>
                        <div class="form-group">
                            <label>Codigo de Referencia</label>
                            <input type="text" class="form-control" name="code_user" value="{{ $socio->code }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Clave</label>
                            <input type="password" placeholder="Clave" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>Repetir Clave</label>
                            <input type="password" placeholder="Clave" class="form-control" name="password_confirmation">
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