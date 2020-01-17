@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section ('content')

  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="tblretire" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Usuario</th>
              <th>Curso</th>
              <th>Estado</th>
              <th>Ultima activación</th>
              <th>-</th>
            </tr>
          </thead>
          <tbody>
            @php
              $today = Carbon\Carbon::now();
            @endphp
            @foreach ($courses as $key => $cours)
              @php
                $diference = $today->diffInDays( $cours->date_activation);
              @endphp
              <tr>
                <th>{{ $cours->id }}</th>
                <td>{{ $cours->user }}</td>
                <td>{{ $cours->course }}</td>
                <td>
                  {{ $cours->status ? 'Activo': 'Inactivo' }}
                </td>
                <td>{{ $diference }} días </td>
                <td> 
                  @if( $cours->status )
                    <a href="{{ url('admin/akademy/active/' . $cours->id )}}"  class="btn btn-danger">Desactivar </a>
                  @else
                  <a href="{{ url('admin/akademy/active/' . $cours->id )}}"  class="btn btn-info">Activar </a>
                  @endif
                  @if( $diference > 30 && $cours->status && $cours->activation == 0 )
                    <a href="{{ url('admin/akademy/verify/' . $cours->id )}}"  class="btn btn-warning">Ver. de actividad</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="div-btn">
        <a href="{{ url('/admin/akademy/make') }}" class="btn btn-primary">Agregar curso</a>
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
    //Datatable
    var tabla = $('#tblretire').DataTable({
      "paging": true,"language": {
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