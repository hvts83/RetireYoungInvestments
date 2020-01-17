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
      <h1>Planes</h1>
      <div class="table-responsive">
        <table id="tblretire" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Plan</th>
              <th>Cantidad</th>
              <th>Estatus Plan</th>
              <th>Estatus petición</th>
              <th>Ver</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($retire as $key => $ret)
              <tr>
                <th>{{ $ret->id }}</th>
                <td>{{ $ret->name }}</td>
                <td>{{ $ret->plan }}</td>
                <td>${{ number_format($ret->amount, 2) }}</td>
                <td>{{ $ret->status === 1 ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    @if($ret->done == 1 )
                      Petición Completada
                    @elseif($ret->done == 0)
                      Petición Activa
                    @else 
                      Petición cancelada
                    @endif
                </td>
                <td> <a href="{{ url('admin/retire/view/' . $ret->id )}}"  class="btn btn-primary">Ver</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="ibox-content">
      <h1>Comisiones</h1>
      <div class="table-responsive">
        <table id="tblcomision" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Estatus peticion</th>
              <th>Ver</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comision as $key => $com)
              <tr>
                <th>{{ $com->id }}</th>
                <td>{{ $com->name }}</td>
                <td>${{ number_format($com->amount) }}</td>
                <td>
		    @if($com->done == 1 )
                      Petición Completada
                    @elseif($com->done == 0)
                      Petición Activa
                    @else 
                      Petición cancelada
                    @endif
		</td>
                <td> <a href="{{ url('admin/retire/comision/' . $com->id )}}"  class="btn btn-primary">Ver</a></td>
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
@endsection

@section('scripts')
	<script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
	<script>
    //Datatable
    $('#tblretire').DataTable({
      "paging": true,"language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "order": [[ 5, "asc" ]],
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#tblcomision').DataTable({
      "paging": true,"language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "order": [[ 3, "asc" ]],
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
