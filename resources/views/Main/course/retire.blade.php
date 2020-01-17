@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Exito</strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error</strong> {{ session('error') }}
            </div>
        @endif
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Solicitar Retiro de comisiones</h5>
                </div>
                <div class="ibox-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Cantidad maxima a retirar: ${{ $comision_actual }}</p>
                    @if( $comision_actual < 55)
                        <p>Saldo insuficiente: debe tener $55 para realizar solicitud</p>
                    @else
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/course/retire') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Cantidad a Retirar $</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="Cantidad" class="form-control" name='amount' min='55.00' step='0.01' max='{{ $comision_actual }}'>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-info" type="submit">Enviar Solicitud</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>

        </div>
        
        
        <!-- Informacion -->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title"> <h5>Condiciones</h5> </div>
                <div class="ibox-content">
                   Cantidad minima a retirar es de $55.
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Solicitudes de comisiones</h5></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblcomision" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Estatus peticion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($comision as $key => $com)
                                <tr>
                                <td>${{ number_format($com->amount) }}</td>
                                <td>{{ $com->done === 1 ? 'Peticion Completada' : 'Peticion Activa' }}</td>
                                </tr>
                            @endforeach
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
	<script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
	<script>
    //Datatable
    $('#tblretire').DataTable({
      "paging": true,"language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
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
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection