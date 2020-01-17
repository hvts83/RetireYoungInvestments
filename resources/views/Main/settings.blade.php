@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Exito</strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error</strong> {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <fieldset class="form-horizontal">
                        <form role="form" method="post" action="{{ url('/settings/password') }}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <legend>Cambio de clave </legend>
                            <div class="form-group">
                                <label>Antigua clave</label>
                                <input type="password" placeholder="Clave" class="form-control" name="old_password">
                            </div>
                            <div class="form-group">
                                <label>Nueva clave</label>
                                <input type="password" placeholder="Clave" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Repetir clave</label>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <fieldset class="form-horizontal">
                        <form role="form" method="post" action="{{ url('/settings/btc') }}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <legend>Metodo de pago</legend>
                            <div class="form-group">
                                <label>BTC Wallet</label>
                                <input type="text" placeholder="BTC" class="form-control" name="btc" value="{{ Auth::user()->btc }}">
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

@section('scripts')
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
@endsection