@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Listado de cursos</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped tables">
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Precio</th>
                                <th>Fecha de Inicio</th>
                                <th>Estado</th>											
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cursos as $curso)
                                <tr>
                                    <td>{{ $curso->name}}</td>
                                    <td>{{ $curso->price}}</td>
                                    <td>{{ $curso->created_at }}</td>
                                    <td>{{ $curso->status }}</td>    
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
                    <h1 class="no-margins">${{ number_format($comision_actual) }}</h1>                             
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