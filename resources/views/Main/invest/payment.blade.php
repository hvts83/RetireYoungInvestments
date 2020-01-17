@extends('Main.layouts.app')

@section ('title') {{ $page_title }} @stop

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">    
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Compra de Planes BTC</h5>
            </div>
            <div class="ibox-content">
                <img src={{"https://qrcode.online/img/?type=text&size=8&data=" . $config->qr }} width="240px" higth="" />
				<p>{{ $config->qr }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Compra de Planes</h5>
            </div>
            <div class="ibox-content">
                <p>El único medio de pago para la compra de nuestros planes es por medio de bitcoin, si tu tienes bitcoin puedes transferir el monto a invertir neto a nuestra wallet.</p>
                <p><strong>Debes transferir a la direccion de wallet la cantidad equivalente en bitcoin, respectiva al plan que elegiste, una vez hecha la transferencia envíanos un screenshot en un correo electrónico a <a href="mailto:contact@retireyoung.co">contact@retireyoung.co</a> contact@retireyoung.co junto con el hash ID de la transacción, el nombre del titular, el correo electrónico y la forma de retiros que elegiste, ya sea mensual o al finalizar el plazo; la activación de tu Plan se realizará 24 horas después.</strong></p>
                <p>Una vez hecha la compra de tu plan, este empezará a generar ganancias 10 días después por lo tanto la fecha que aparecerá para tu plan será la fecha que comienza tu pago diario.</p>
                
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Precio Bitcoin</h5>
            </div>
            <div class="ibox-content">
               <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
          <div class="coinmarketcap-currency-widget" data-currencyid="1" data-base="USD" data-secondary="" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-stats="USD" data-statsticker="true">
            </div>
            </div>
        </div>

        </div>
        <div class="row">
      
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Calculadora de Dollar a Bitcoin</h5>
            </div>
            <div class="ibox-content">
            <span class="custom-dropdown">
    <select id="test">
        <option value=1>Seleccionar</option>
        <option value=2>BTC to USD</option>
    </select>
</span>
            <form class="login-form">
                <h2 id="second"></h1>
                <input type="text" placeholder="valor" id="USD"/>      
                <h2 id="first"></h1>
                <input type="text" placeholder="valor" id="BTC"/>
                
                </form>               
            </div>
            </div>
        </div>
    </div>
</div>
<script src="{!! asset('js/btc.js') !!}" type="text/javascript"></script>
@endSection