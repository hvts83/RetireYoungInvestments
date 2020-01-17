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
              <th>Dias</th>
              <th>Maximo de interes</th>
              <th>Minimo de interes</th>
              <th>Detalle</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($planes as $key => $plan)
              <tr>
                <th>{{ $plan->id }}</th>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->days }} Dias</td>
                <td>{{ $plan->maximum_percentage }}</td>
                <td>{{ $plan->minimum_percentage }}</td>
                <td> <a href="{{ url('admin/planes/' . $plan->id . '/edit')}}"  class="btn btn-primary">Ver</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="div-btn">
        <a href="{{ url('/admin/planes/create') }}" class="btn btn-primary">Nuevo Plan</a>
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