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
              <th>Pago diario</th>
              <th>Total</th>
              <th>Total de Planes</th>
              <th>Planes disponibles</th>
              <th>Detalle</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($planes as $key => $plan)
              <tr>
                <th>{{ $plan->id }}</th>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->days }} Dias</td>
                <td>${{ $plan->daily }}</td>
                <td>${{ number_format($plan->total) }}</td>
                <td>{{ $plan->total_plans }}</td>
                <td>{{ $plan->used_plans }}</td>
                <td>
                  <a href="{{ url('admin/promocional/' . $plan->id . '/edit') }}"  class="btn btn-primary">Ver</a>
                  @if($plan->activado == 0 )
                    <a href="{{ url('admin/promocional/' . $plan->id . '/activar') }}" class="btn btn-default"> Desactivado </a>
                  @else 
                    <a href="{{ url('admin/promocional/' . $plan->id . '/activar') }}" class="btn btn-success"> Activado </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="div-btn">
        <a href="{{ url('/admin/promocional/create') }}" class="btn btn-primary">Nuevo Plan</a>
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