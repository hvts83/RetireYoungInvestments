@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <h2>Nuevo mensaje</h2>
            </div>
            
            <div class="mail-box">
                <form class="form-horizontal" role="form" method="post" action="{{ url('/mailbox/compose') }}">
                    {{ csrf_field() }}
                    <div class="mail-body">
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Motivo">
                        </div>
                    </div>  
                    <div class="mail-text h-200">
                        <textarea name="body" class="summernote form-control" rows="10"></textarea>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-reply"></i> Enviar</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@endSection