@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Total invertido</span>
                    <h5>Invertido</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($invertido, 2) }}</h1>                             
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Total Ganado</span>
                    <h5>Total Ganado</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($ganado, 2) }}</h1>                                
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Ganancia Actual</span>
                    <h5>Ganancia</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($dinero_actual, 2) }}</h1>
                </div>
            </div>
        </div> 
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Total Retirado</span>
                    <h5>Total Retirado</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($retirado, 2) }}</h1>
                </div>
            </div>
        </div>  
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Total de Rentabilidad</span>
                    <h5>Rentabilidad</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($rentabilidad, 2) }}</h1>                                
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Comisiones</span>
                    <h5>Total Comisiones</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($comision, 2) }}</h1>                             
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Comisiones</span>
                    <h5>Comisiones retiradas</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($retirado_comision, 2) }}</h1>                             
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Comisiones</span>
                    <h5>Comisiones</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($comision_actual, 2) }}</h1>                             
                </div>
            </div>
        </div>  
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de Inversion</h5>
                </div>
                <div class="ibox-content">83
                
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                            <tr>
                                <th>Mes</th>
                                <th>Plan </th>
                                <th>Inversion</th>
                                <th>% Mensual </th>
                                <th>Valor </th>
                                <th>Vencimiento</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $planes as $plan)
                                    <tr>
                                        <td> {{ $plan->created_at }} </td>
                                        <td> {{ $plan->name  }} </td>
                                        <td> {{ number_format($plan->charge) }} </td>
                                        <td> {{ $plan->percentage }} </td>
                                        <td> {{ number_format($plan->amount) }} </td>
                                        <td> {{ $plan->end_at }} </td>
                                    </tr>
                                @endForeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ultimos planes activos</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Plan</th>
                                <th>Inversion</th>
                                <th>Plazo</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($planes_activos as $plan_a)
                                    <tr>
                                        <td> {{ $plan_a->start_at }} </td>
                                        <td> {{ $plan_a->plan }} </td>
                                        <td> {{ number_format($plan_a->charge) }} </td>
                                        <td> {{ $plan_a->days/30 }} Meses</td>
                                    </tr>     
                                @endForeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de Inversion Especiales</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Plan </th>
                                <th>Detalle</th>
                                <th>Cantidad </th>
                                <th>Vencimiento </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($especiales as $special)
                                    <tr>
                                        <td> {{ $special->created_at }} </td>
                                        <td> {{ $special->name  }} </td>
                                        <td> {{ $special->transactionName }} </td>
                                        <td> {{ number_format($special->amount, 2) }} </td>
                                        <td> {{ $special->end_at }} </td>
                                    </tr>     
                                @endForeach
                                @foreach($comisiones as $comisionx)
                                    <tr>
                                        <td> {{ $comisionx->created_at }} </td>
                                        <td> {{ $comisionx->name  }} </td>
                                        <td> {{ $comisionx->transactionName }} </td>
                                        <td> {{ number_format($comisionx->amount, 2) }} </td>
                                        <td> {{ $comisionx->end_at }} </td>
                                    </tr>     
                                @endForeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!--Referidos-->
        <div class="col-lg-4">
            <h2>Referidos</h2>
            <table class="table table-hover margin bottom">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Cantidad</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($referidos as $referido)
                        <tr>
                            <td>{{ $referido->name }}</td>
                            <td class="text-center small">{{ $referido->created_at}}</td>
                            <td class="text-center">${{ number_format($referido->bonus) }}</td>
                        </tr>
                    @endForeach
                </tbody>
            </table>            
        </div>

    </div>

</div>
@endsection


@section('css')
  <link rel="stylesheet" href="{{ asset('css/dataTables/datatables.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
  
<script>

    //Datatable
    var tabla = $('.tables').DataTable({
      "paging": true,
      "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
