@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Plan {{ $plan->plan }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                                <tr>
                                    <th>Mes</th>
                                    <th>% Mensual </th>
                                    <th>Valor </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $transacciones as $transaccion)
                                    <tr>
                                        <td> {{ $transaccion->created_at }} </td>
                                        <td> {{ $transaccion->percentage }} </td>
                                        <td> {{ number_format($transaccion->amount) }} </td>
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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Informacion del plan</h5>
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <tr>
                            <td>Plan</td>
                            <td>{{ $plan->plan }}</td>
                        </tr>
                        <tr>
                            <td>Inversion</td>
                            <td> {{ number_format($plan->charge) }} </td>
                        </tr>
                        <tr>
                            <td>Apertura</td>
                            <td> {{ $plan->created_at }} </td>
                        </tr>
                        <tr>
                            <td>Vencimiento</td>
                            <td> {{ $plan->end_at }} </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if($plan->status == 1)
                                    <a class="btn btn-primary disabled">Activo</a>
                                @else 
                                    <a class="btn btn-danger disabled">Finalizado</a>
                                @endif 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
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