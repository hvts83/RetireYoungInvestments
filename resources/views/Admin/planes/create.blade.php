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
        <form role="form" method="post" action="{{ url('/admin/planes') }}">
             {{ csrf_field() }}
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" placeholder="Nombre" class="form-control" name="name">
            </div>

            <label>Porcentaje de interes mínimo</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Minimo" class="form-control" name="minimum_percentage" min='0' max='100'>
                <span class="input-group-addon">%</span>
            </div>

            <label>Porcentaje de interes máximo</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Maximo" class="form-control" name="maximum_percentage" min='0' max='100'>
                <span class="input-group-addon">%</span>
            </div>
            <div class="form-group">
                <label>Duración en Días</label>
                <input type="number" placeholder="Dias" class="form-control" name="days" min='1'>
            </div>
            <label>Ganancia de referido</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Ganancia" class="form-control" name="referal_earning" min='0'  step="0.01">
            </div>
            <div class="div-btn">
                <a href="{{ url('admin/planes') }}" class="btn m-t-n-xs"><strong>Cancelar</strong></a>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection