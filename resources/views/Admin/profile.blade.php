@extends('Admin.layouts.app')

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
        <div class="col-lg-3">
            <img src="{{ asset($image->url)}}" class="img-responsive">
        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <fieldset>
                        <legend>Imagen</legend>
                        <form action="{{ url('admin/profile/upload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label>Imagen</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="imagen"/>
                                </span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
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
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <fieldset class="form-horizontal">
                    <form role="form" method="post" action="{{ url('admin/profile/update' ) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <legend>Datos generales</legend>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" placeholder="Nombre" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <br><br>
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
                    <form role="form" method="post" action="{{ url('admin/profile/password' ) }}">
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
</div>
@endsection


@section('css')
    <link href="{{ asset('backoffice/css/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('backoffice/js/jasny/jasny-bootstrap.min.js')}}"></script>
@endsection