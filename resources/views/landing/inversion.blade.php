@extends('landing.layout')

@section('body')
<!--==========================
    Intro Section
  ============================--> 

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/inversion/invertimos.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>En que Invertimos</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- #intro -->
<section id="ry-intro">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-2 offset-lg-2"> <img src="img/index/pilar.png" class="img-fluid" alt=""> </div>
      <div class="col-lg-6 text-white text-justify py-3">
        <p>Tenemos un grupo de traders e inversionistas con experiencia, una cartera de inversiones diversificada entre Forex, Criptomonedas, Minería y otros activos altamente rentables, así disminuimos el factor de riesgo</p>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="col-lg-10 offset-lg-1">
      <div class="doughnut-chart-container">
        <canvas id="doughnut-chartcanvas-2"></canvas>
      </div>
    </div>
  </div>
</section>

  @include('landing.proof')
  @include('landing.register_bar')
@endSection

@section('scripts')
  <script src="{{ asset('js/Chart.js')}}"></script> 
  <script src="{{ asset('js/donut.js')}}"></script> 
@endSection