@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Usuarios Registrados</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $registrados}}</h1>                             
                </div>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Planes Activos</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $activos}}</h1>                                
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Total Invertido</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{  number_format($invertido) }}</h1>                                
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Total Retirado</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($retirado) }}</h1>
                </div>
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ultimos usuarios registrados</h5>
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
                                <th>Referido</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $usuarios as $usuario)
                                    <tr>
                                        <td> {{ $usuario->id }} </td>
                                        <td> {{ $usuario->create_at }} </td>
                                        <td> {{ $usuario->name  }} </td>
                                        <td> {{ $usuario->email }} </td>
                                        <td> {{ $usuario->reference_name }} </td>
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
            <h2>Ultimos Referidos</h2>
            <table class="table table-hover margin bottom">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="text-center">Fecha</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($referidos as $referido)
                        <tr>
                            <td>{{ $referido->id }}</td>
                            <td class="text-center small">{{ $referido->created_at}}</td>
                            <td>{{ $referido->name }}</td>
                            <td class="text-center">${{ $referido->email }}</td>
                        </tr>
                    @endForeach
                </tbody>
            </table>            
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-9">
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
                                        <td> {{ $plan->charge }} </td>
                                        <td> {{ $plan->days/30 }} Meses</td>
                                        <td> <a href='{{ url('admin/user-plans/view/'. $plan->id) }}' class='btn btn-primary'>Ver</a></td>
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
