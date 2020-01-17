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
              <th>Nombre</th>
              <th>Correo</th>
              <th>Ver</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($socios as $key => $socio)
              <tr>
                <th>{{ $socio->id }}</th>
                <td>{{ $socio->name }}</td>
                <td>{{ $socio->email }}</td>
                <td>
                  <a href="{{ url('admin/socios/view/' . $socio->id )}}"  class="btn btn-primary">Ver</a>
                  <a href="{{ url('admin/socios/' . $socio->id . '/edit' )}}"  class="btn btn-primary">Editar</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      <a href="{{ url('admin/socios/create') }}" class="btn btn-primary"> Nuevo usuario </a>
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