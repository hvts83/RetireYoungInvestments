@extends('landing.layout')

@section('body')

<!--==========================
    Intro Section
  ============================--> 

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/contacto/contacto.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Contacto</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- #intro -->

<section class="py-5">
  <div class="container">
    <div class="col-lg-8 offset-lg-2">
      <h1 class="text-center">D&eacute;janos un mensaje</h1>
      <p class="text-center">Por favor, llena el siguiente formulario para ponernos en contacto contigo rápidamente</p>
      <form role="form" id="contactForm" class="contact-form shake" data-toggle="validator" method="post" action="{{ url('/send-mail') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <div class="controls">
          <input type="text" id="name" class="form-control" placeholder="Nombre" required data-error="Ingrese nombre" name="name">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="controls">
          <input type="email" class="email form-control" id="email" placeholder="Email" required data-error="Ingrese Correo Electronico" name="email">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="controls">
          <input type="text" id="msg_subject" class="form-control" placeholder="Motivo" required data-error="Ingrese Motivo" name="subject">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="controls">
          <textarea id="message" rows="7" placeholder="Mensaje" class="form-control" required data-error="Ingrese Mensaje" name="body"></textarea>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <button type="submit" id="submit" class="btn btn-success"> Enviar Mensaje</button>
      <div id="msgSubmit" class="h3 text-center hidden"></div>
      <div class="clearfix"></div>
      </form>
    </div>
  </div>
</section>

@include('landing.register_bar')

@endSection