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
        <form role="form" method="post" action="{{ url('/admin/promocional/'. $plan->id) }}">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" placeholder="Nombre" class="form-control" name="name" value="{{ $plan->name }}">
            </div>
            <label>Pago diario</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Diario" class="form-control" name="daily" min="0"  step="0.01" value="{{ $plan->daily }}">
            </div>
            <label>Total</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Total" class="form-control" name="total" min='0'  step="0.01" value="{{ $plan->total }}">
            </div>
            <label>Duración en Dias</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Dias" class="form-control" name="days" min='1' value="{{ $plan->days }}">
                <span class="input-group-addon">Días</span>
            </div>
            <label>Rentabilidad</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Ganancia" class="form-control" name="rentability" min='0'  step="0.01" value="{{ $plan->rentability }}">
            </div>
            
            <div class="form-group">
                <label>Total de promociones</label>
                <input type="number" placeholder="Ganancia" class="form-control" name="total_plans" min='0' value="{{ $plan->total_plans }}">
            </div>
            <label>Ganancia de referido</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Ganancia" class="form-control" name="referal_earning" min='0' step="1" max="100" value="{{ $plan->referal_earning }}">
                <span class="input-group-addon">%</span>
            </div>
            <div class="div-btn">
                <a href="{{ url('admin/promocional') }}" class="btn m-t-n-xs"><strong>Cancelar</strong></a>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection