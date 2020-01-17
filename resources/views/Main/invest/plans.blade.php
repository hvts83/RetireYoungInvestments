@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">

    <!-- <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de Inversion</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Plazo</th>
                            <th>% de Ganancia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->minimum_percentage}}% y {{ $plan->maximum_percentage}}% Mensual</td>
                        </tr>
                        @endForeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Condiciones</h5>
                </div>
                <div class="ibox-content">
                    <ul>
                        <li>10 días después de la compra de tu Plan este comienza a generar ganancias</li>
                        <li>Se puede Invertir cualquier cantidad en multiplos de $1,000.00</li>
                        <li>La ganancia esta basada en el tiempo de inversion y es variable dependiendo de las ganancias de la empresa.</li>
                        <li>10% por la compra de bitcoin y si pagas en efectivo</li>
                        <li>Retiro Mensual 10% de comisi&oacute;n</li>
                        <li>Retiro al finalizar el plazo 5% de comisi&oacute;n</li>
                    </ul>
                    <a href="{{ url('invest/payment')}}" class="btn btn-block btn-info">Invertir</a> 
                </div>
            </div>
        </div>
    </div> -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Planes de Aniversario: {{ $total_special }} planes disponibles</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        @foreach($specials as $special)
                        <div class="col-lg-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"> {{ $special->name }} </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="the-price">
                                        <table class="table">
                                            <tr>
                                                <td> Diario</td>
                                                <td> ${{ $special->daily }}</td>
                                            </tr>
                                            <tr class="active">
                                                <td> Mensual </td>
                                                <td> ${{ number_format($special->daily*30, 2) }} </td>
                                            </tr>
                                            <tr>
                                                <td> Rentabilidad </td>
                                                <td> ${{ number_format($special->rentability) }} </td>
                                            </tr>
                                            <tr class="active">
                                                <td> Total </td>
                                                <td> ${{ number_format($special->total) }} </td>
                                            </tr>
                                            <tr>
                                                <td> Duraci&oacute;n </td>
                                                <td> {{ $special->days / 30 }} Meses</td>
                                            </tr>
                                            <tr class="active">
                                                <td> 
                                                    Comision<br> Retiro Mensual 
                                                </td>
                                                <td> 15% </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="panel-footer text-center">
                                        <a href="{{ url('invest/payment')}}" class="btn btn-success" role="button">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endForeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection