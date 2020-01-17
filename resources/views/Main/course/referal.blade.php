@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
                <div class="col-lg-8">
                    <div class="ibox-content">
                            <h2>Prevision de ganancias actual</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td>Referidos</td>
                                    <td>${{ number_format($niveles[1] * 0.30, 2) }}</td>
                                    <td>{{ $cursos_niveles[1] }} Cursos</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">Total de Comisiones</span>
                            <h5>Comisiones</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">${{ number_format($comision_akademy,2) }}</h1>                             
                        </div>
                    </div>
                </div>
            </div>
            <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Referidos de akademy</h5>
                </div>
                <div class="ibox-content">
                    <h2>Nivel 1</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>email</th>
                                <th>Estado </th>											
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($nivel1 as $n1)
                                <tr>
                                    <td>{{ $n1->name}}</td>
                                    <td>{{ $n1->email}}</td>
                                    <td>{{ $n1->status ? 'Activo' : 'Inactivo' }}</td>    
                                </tr>
                                @endForeach                  
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox-content">
                        <h2>Nivel 2</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>email</th>
                                    <th>Estado </th>											
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($nivel2 as $n2)
                                    <tr>
                                        <td>{{ $n2->name}}</td>
                                        <td>{{ $n2->email}}</td>
                                        <td>{{ $n2->status ? 'Activo' : 'Inactivo' }}</td>    
                                    </tr>
                                    @endForeach                  
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ibox-content">
                            <h2>Nivel 3</h2>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>email</th>
                                        <th>Estado </th>											
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($nivel3 as $n3)
                                        <tr>
                                            <td>{{ $n3->name}}</td>
                                            <td>{{ $n3->email}}</td>
                                            <td>{{ $n3->status ? 'Activo' : 'Inactivo' }}</td>    
                                        </tr>
                                        @endForeach                  
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ibox-content">
                                <h2>Nivel 4</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>email</th>
                                            <th>Estado </th>											
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($nivel4 as $n4)
                                            <tr>
                                                <td>{{ $n4->name}}</td>
                                                <td>{{ $n4->email}}</td>
                                                <td>{{ $n4->status ? 'Activo' : 'Inactivo' }}</td>    
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