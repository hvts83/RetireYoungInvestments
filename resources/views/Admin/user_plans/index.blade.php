@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ultimos planes activos</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Inversion</th>
                                <th>Plazo</th>
                                <th>Archivo</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($planes as $plan)
                                    <tr>
                                        <td> {{ $plan->id }} </td>
                                        <td> {{ $plan->start_at }} </td>
                                        <td> {{ $plan->user  }} </td>
                                        <td> {{ $plan->email  }} </td>
                                        <td> {{ $plan->plan }} </td>
                                        <td> {{ number_format($plan->charge) }} </td>
                                        <td> {{ $plan->days/30 }} Meses</td>
                                        <td> 
                                            <a href='{{ url('admin/user-plans/view/'. $plan->id) }}' class='btn btn-primary'>Ver</a>
                                            <a href='{{ url('admin/user-plans/request/'. $plan->id) }}' class='btn btn-info'>solicitud</a>
                                        </td>
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
