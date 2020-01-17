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
                    <h5>Solicitar Retiro de ganancias</h5>
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
                    <p>Planes actuales</p> 
                    <table class="table">
                        @foreach ($plans as $plan)
                            <tr>
                                <td>Plan: {{ $plan->name }} de ${{ $plan->charge }}</td>
                                <td>Disponible: ${{ number_format($plan->monto_disponible - $plan->monto_retirado, 2)  }}  </td>
                            </tr>
                        @endforeach
                    </table>
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/withdraw/plan') }}">
                        {{ csrf_field() }}
                        <p>Seleccionar Plan</p>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Plan</label>
                            <div class="col-lg-10">
                                <select class="form-control m-b" name="plan">
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}"> {{ $plan->name  }} de ${{ $plan->charge}} Disponible: ${{ number_format($plan->monto_disponible - $plan->monto_retirado, 2) }}</option>
                                    @endForeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Cantidad a Retirar $</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="Cantidad" class="form-control" name='amount' min='0.01' step='0.01'>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-info" type="submit">Enviar Solicitud</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
                    @if( $comision_actual == 0)
                        <p>Saldo insuficiente</p>
                    @else
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/withdraw/comision') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Cantidad a Retirar $</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="Cantidad" class="form-control" name='amount' min='0.01' step='0.01'  max='{{ $comision_actual }}'>
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
                    <h2>Fondos de Inversión</h2>
                    <ul>
                        <li>La cuenta de tu wallet BTC nos ayuda a realizar los depósitos de una manera mas rapida </li>
                        <li>Retiro Mensual 10% de comisión </li>
                        <li>Retiro al finalizar el plazo 5% de comisión </li>                    
                    </ul>
                    <h2>Planes Promocionales</h2>
                    <ul>
                        <li>Retiro Mensual 15% de comisión</li>
                        <li> Retiro al finalizar el plazo 5% de comisión</li> 
                    </ul>
                    <h2>Comisiones de Referidos</h2>
                    <ul>
                        <li>Tus comisiones puedes solicitarlas mensualmente o al finalizar el plazo de tu Plan</li>
                        <li>Estas se acumulan durante un mes y se te pagan el tercer lunes del mes siguiente</li>
                        <li>El porcentaje de retiro es el mismo 15% mensual y 5% al finalizar el plazo.</li>
                    </ul>                
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Solicitudes de planes</h5></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblretire" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Plan</th>
                              <th>Cantidad</th>
                              <th>Estatus peticion</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($retire as $key => $ret)
                              <tr>
                                <td>{{ $ret->plan }}</td>
                                <td>${{ number_format($ret->amount, 2) }}</td>
                                <td>
                                    @if($ret->done == 1 )
                                    Petición Completada
                                    @elseif($ret->done == 0)
                                    Petición Activa
                                    @else 
                                    Petición cancelada
                                    @endif
                                <td>
                                    @if($ret->done === 0 )
                                    <form class="form-horizontal" role="form" method="post" action="{{ url('/withdraw/cancel') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="retire" value="{{ $ret->id }}">
                                        <button class="btn btn-danger" type="submit">Cancelar</button>
                                    </form>
                                    @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
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
