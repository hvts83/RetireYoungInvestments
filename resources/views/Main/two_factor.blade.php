@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="middle-box text-center animated fadeInDown">
    <div>
        <div class="m-b-md">
            <img alt="image" width="250px" class="img-circle circle-border" src="{{ asset(Auth::user()->image->url) }}">
        </div>
        <h3>{{ Auth::user()->name }}</h3>
        <p>Esta área es restringida, para accesar debes usar el código que se te envió a tu correo.</p>
        <form role="form" method="POST" action="{{ url('verify_code') }}">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $uri }}" name='uri'>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <input id="2fa" type="password" class="form-control" name="2fa" placeholder="Colocar el código recibido." required autofocus>
                @if ($errors->has('2fa'))
                    <span class="help-block">
                    <strong>{{ $errors->first('2fa') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</div>

@endsection