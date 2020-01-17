@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="ibox-content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="post" action="{{ url('/admin/course') }}">
             {{ csrf_field() }}
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" placeholder="Nombre" class="form-control" name="name">
            </div>
            <label>Ganancia de referido</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Precio" class="form-control" name="price" min='0'  step="0.01">
            </div>
            <div class="div-btn">
                <a href="{{ url('admin/course') }}" class="btn m-t-n-xs"><strong>Cancelar</strong></a>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection