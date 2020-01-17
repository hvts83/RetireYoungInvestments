@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de Inversion</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Inversion</th>
                                    <th>Apertura</th>
                                    <th>Vencimiento</th>
                                    <th>Status</th>
                                    <th>Ver transacciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $planes as $plan)
                                    <tr>
                                        <td> {{ $plan->plan  }} </td>
                                        <td> {{ number_format($plan->charge) }} </td>
                                        <td> {{ $plan->created_at }} </td>
                                        <td> {{ $plan->end_at }} </td>
                                        <td>
                                            @if($plan->status == 1)
                                                Activo
                                            @else 
                                                Finalizado
                                            @endif 
                                        </td>
                                        <td>
                                            <a href="{{ url('invest/history_detail/' . $plan->id )}}""  class="btn btn-primary">Ver</a>
                                        </td>
                                    </tr>
                                @endForeach                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Referidos-->
        <div class="col-lg-3">
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

<script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
<script>
$(document).ready(function() {
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
});
</script>
@endsection