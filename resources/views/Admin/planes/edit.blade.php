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
        <form role="form" method="post" action="{{ url('/admin/planes/'. $plan->id) }}">
             {{ csrf_field() }}
             <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" placeholder="Nombre" class="form-control" name="name" value="{{ $plan->name }}">
            </div>

            <label>Porcentaje de interes minimo</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Minimo" class="form-control" name="minimum_percentage" min='0' max='100' value="{{ $plan->minimum_percentage }}">
                <span class="input-group-addon">%</span>
            </div>

            <label>Porcentaje de interes maximo</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Maximo" class="form-control" name="maximum_percentage" min='0' max='100' value="{{ $plan->maximum_percentage }}">
                <span class="input-group-addon">%</span>
            </div>
            <div class="form-group">
                <label>Duración en Dias</label>
                <input type="number" placeholder="Dias" class="form-control" name="days" min='1' value="{{ $plan->days }}">
            </div>
            <label>Ganancia de referido</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Ganancia" class="form-control" name="referal_earning" min='0' value="{{ $plan->referal_earning }}"  step="0.01">
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