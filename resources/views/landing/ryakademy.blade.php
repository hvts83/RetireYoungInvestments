@extends('landing.layout')

@section('body')
<!--==========================
    Intro Section
  ============================--> 

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/akademy/akademy-hero.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Akademy</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- #intro -->
<section id="ry-intro">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-3"> <img src="img/index/pilar.png" class="img-fluid pull-right" alt=""> </div>
      <div class="col-lg-9 text-white text-justify">
        <p>Somos una academia especializada a nivel internacional dedicada a enseñar a las personas a invertir en mercado de divisas, criptomonedas y otros portafolios en la nueva economía. Asesoramos y apoyamos a nuestros alumnos a convertirse en un trader profesional desde su primera etapa, cómo escoger el bróker, descargar la plataforma, gestión monetaria, puesta de operaciones en mercado virtual, para prepararlo para inversiones en dinero real.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 text-center">
	<div class="col-lg-8 offset-lg-2">
		<video width="640" height="360" controls autoplay>
  <source src="video/VID-20180615-WA0008.mp4" type="video/mp4">
  Your browser does not support the video tag.
  </video>
	
	</div>
	<h3>Próximamente, Cursos disponibles a partir de Julio 2018</h3>
</section>

@include('landing.register_bar')

@endSection