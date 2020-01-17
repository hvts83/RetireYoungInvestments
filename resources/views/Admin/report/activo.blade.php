@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="ibox-content">
            <div class="table-responsive">
            <table id="tbl" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Plan adquirido</th>
                    <th>Tipo plan</th>
                    <th>Inversión</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Fecha activación</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($activos as $activo)
                    <tr>
                        <td>{{ $activo->id }}</td>
                        <td>{{ $activo->plan }}</td>
                        <td>{{ $activo->special == 1 ? 'Especial' : 'Normal'}} </td>
                        <td>${{ $activo->charge }}</td>
                        <td>{{ $activo->usuario }}</td>
                        <td>{{ $activo->email }}</td>
                        <td>{{ $activo->start_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dataTables/buttons.dataTables.min.css')}}">
@endsection

@section('scripts')
    <script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/buttons.print.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/jszip.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/pdfmake.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/vfs_fonts.js')}}"></script>
	<script>
    //Datatable
    var tabla = $('#tbl').DataTable({
      
      "paging": true,
      "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      'dom': 'Bfrtip',
      'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });
</script>
@endsection