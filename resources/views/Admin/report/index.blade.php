@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="ibox-content">
        <div class="panel-body">
            <fieldset class="form-horizontal">
                <form role="form" method="get" action="{{ url('admin/report/activos' ) }}">
                    {{ csrf_field() }}
                    <legend>Planes activos</legend>
                    <div class="row">
                        <div class="col-md-6 form-group data_3">
                            <label class="font-normal">Rango:</label>
                            <div class="input-daterange input-group">
                                <span class="input-group-addon">Desde</span>
                                <input type="text" name="inicio" class="input-sm form-control">
                                <span class="input-group-addon">Hasta</span>
                                <input type="text" name="fin" class="input-sm form-control">
                            </div>
                        </div>
                        <div class=" col-md-6 form-group data_2">
                            <label class="font-normal">Mes:</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="mes">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">Plan</label>
                            <select class="chosen-select"  name="plan">
                                <option selected disabled>Seleccione plan</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id }}"> {{  $plan->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"><button class="btn btn-primary m-t-n-xs" type="submit">Generar</button></div>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="panel-body">
            <fieldset class="form-horizontal">
                <form role="form" method="get" action="{{ url('admin/report/retiro' ) }}">
                    {{ csrf_field() }}
                    <legend>Retiro</legend>
                    <div class="row">
                        <div class="col-md-6 form-group data_3">
                            <label class="font-normal">Rango:</label>
                            <div class="input-daterange input-group">
                                <span class="input-group-addon">Desde</span>
                                <input type="text" name="inicio" class="input-sm form-control">
                                <span class="input-group-addon">Hasta</span>
                                <input type="text" name="fin" class="input-sm form-control">
                            </div>
                        </div>
                        <div class=" col-md-6 form-group data_2">
                            <label class="font-normal">Mes:</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="mes">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">Plan</label>
                            <select class="chosen-select"  name="plan">
                                <option selected disabled>Seleccione plan</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id }}"> {{  $plan->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"><button class="btn btn-primary m-t-n-xs" type="submit">Generar</button></div>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="panel-body">
            <fieldset class="form-horizontal">
                <form role="form" method="get" action="{{ url('admin/report/comision' ) }}">
                    {{ csrf_field() }}
                    <legend>Comisiones</legend>
                    <div class="row">
                        <div class="col-md-6 form-group data_3">
                            <label class="font-normal">Rango:</label>
                            <div class="input-daterange input-group">
                                <span class="input-group-addon">Desde</span>
                                <input type="text" name="inicio" class="input-sm form-control">
                                <span class="input-group-addon">Hasta</span>
                                <input type="text" name="fin" class="input-sm form-control">
                            </div>
                        </div>
                        <div class=" col-md-6 form-group data_2">
                            <label class="font-normal">Mes:</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="mes">
                            </div>
                        </div>
                        <div class="col-md-12"><button class="btn btn-primary m-t-n-xs" type="submit">Generar</button></div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
  </div>
</div>
@endsection

@section('css')
    <link href="{{ asset('css/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dataTables/buttons.dataTables.min.css')}}">
    <link href="{{ asset('css/datepicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.js')}}"></script>
	<script>
    //Datatable
    $('.data_2 .input-group.date').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy"
    });
    $('.data_3 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('.chosen-select').chosen({
      width: "100%",
      no_results_text: "No se encontró resultados"
    });
  </script>
@endsection