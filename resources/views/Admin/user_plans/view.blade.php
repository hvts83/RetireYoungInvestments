@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <table class="table">
                        <tr>
                            <td>Usuario</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Plan</td>
                            <td>{{$plan->name}}</td>
                        </tr>
                        <tr>
                            <td>Inicio</td>
                            <td>{{$user_plan->start_at}}</td>
                        </tr>
                        <tr>
                            <td>Fin</td>
                            <td>{{$user_plan->end_at}}</td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td>{{$user_plan->status === 1 ? 'Activo' : 'Finalizado' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Transacciones del plan</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Porcentaje</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td> {{ $transaction->id }} </td>
                                        <td> {{ $transaction->name  }} </td>
                                        <td> {{ number_format($transaction->amount)  }} </td>
                                        <td> {{ $transaction->percentage }} </td>
                                    </tr>     
                                @endForeach
                            </tbody>
                        </table>
                    </div>

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
            