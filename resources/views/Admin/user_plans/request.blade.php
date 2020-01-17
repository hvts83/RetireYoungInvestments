@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
				  
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Solicitar Retiro</h5>
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
                    <form class="form-horizontal" role="form" method="post" action="{{ url('/admin/user-plans/request') }}">
                        {{ csrf_field() }}
                        <p>Seleccionar Plan</p>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Plan</label>
                            <div class="col-lg-10">
                                <select class="form-control m-b" name="plan" readonly="true">
                                        <option value="{{ $user_plan->id }}" selected> {{ $plan->name  }} - ${{ $plan->charge}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Cantidad a Retirar $</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Cantidad" class="form-control" name='amount'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Wallet BTC</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" placeholder="Wallet BTC" name='btc'></textarea>
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
        </div>
    
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title"> <h5>Condiciones</h5> </div>
                <div class="ibox-content">
                    <h2>Planes de Inversión</h2>
                    <ul>
						<li>La cuenta de tu wallet BTC nos ayuda a realizar los depósitos de una manera mas rapida</li>
                        <li>Retiro Mensual 10% de comisi&oacute;n</li>
                        <li>Retiro al finalizar el plazo 5% de comisi&oacute;n</li>						
					</ul>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endSection