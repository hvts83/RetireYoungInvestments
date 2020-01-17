@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <fieldset class="form-horizontal">
                    <form role="form" method="post" action="{{ url('admin/socios/store' ) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" placeholder="Nombre" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="Email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Referido *(opcional)</label>
                            <select class="form-control m-b" name="reference">
                                <option selected>*opcional</option>
                                @foreach($socios as $socio)
                                    <option value="{{ $socio->id }}"> {{ $socio->name  }} </option>
                                @endForeach
                            </select>
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