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
                                <th>Usuario</th>
                                <th>email</th>
                                <th>Fecha de Inicio</th>
                                <th>Plan </th>
                                <th>Comision </th>											
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($referidos as $referido)
                                <tr>
                                    <td>{{ $referido->name}}</td>
                                    <td>{{ $referido->email}}</td>
                                    <td>{{ $referido->created_at }}</td>
                                    <td>{{ $referido->plan }}</td>
                                    <td>{{ number_format($referido->bonus) }}</td>    
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
                    <span class="label label-info pull-right">Total de Comisiones</span>
                    <h5>Comisiones</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">${{ number_format($comision) }}</h1>                             
                </div>
            </div>
        </div>
            
    </div>
</div>

@endSection

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