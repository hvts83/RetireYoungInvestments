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
        <form role="form" method="post" action="{{ url('/admin/promocional') }}">
             {{ csrf_field() }}
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" placeholder="Nombre" class="form-control" name="name">
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Plan Fundador</label>
                <div class="col-sm-10">
                    <div><label> <input type="radio" name="fundador" value=2 > Si</label></div>
                    <div><label><input type="radio" name="fundador" value=1 checked> No</label></div>
                </div>
            </div>

            <label>Pago diario</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Diario" class="form-control" name="daily" min="0"  step="0.01">
            </div>
            <label>Total</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Total" class="form-control" name="total" min='0'  step="0.01">
            </div>
            <label>Duración en Dias</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Dias" class="form-control" name="days" min='1'>
                <span class="input-group-addon">Días</span>
            </div>
            <label>Rentabilidad</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Ganancia" class="form-control" name="rentability" min='0'  step="0.01">
            </div>
            <label>Total de promociones</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Ganancia" class="form-control" name="total_plans" min='0'>
            </div>
            <label>Ganancia de referido</label>
            <div class="input-group m-b">
                <input type="number" placeholder="Ganancia" class="form-control" name="referal_earning" min='0' step="1" max="100">
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