@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <fieldset class="form-horizontal">
                        <form role="form" method="post" action="{{ url('admin/transaction/daily' ) }}">
                            {{ csrf_field() }}
                            <legend>Generar Transacciones diarias</legend>
                            <div class="form-group">
                                <label>Fecha de generacion</label>
                                <input type="date" class="form-control" name="date" value="{{ date("Y-m-d") }}">
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
                    <form role="form" method="post" action="{{ url('admin/transaction/monthly' ) }}">
                        {{ csrf_field() }}   
                        <legend>Generacion de cortes de Mes</legend>
                        <div class="form-group">	
                            <label>Fecha de generación</label>	
                            <input type="date" class="form-control" name="date" value="{{ date("Y-m-d") }}">	
                        </div>
                        <div class="form-group">
                            <label class="control-label">Plan</label>
                            <select class="form-control m-b" name="plan">
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}"> {{ $plan->name  }}</option>
                                @endForeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Interes</label>
                            <input type="number" placeholder="5" class="form-control" name="porcentaje" step="1" min="0" max="100">
                        </div>
                        <div>
                            <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                        </div>
                    </form>
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
