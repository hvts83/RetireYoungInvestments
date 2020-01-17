<h1 align="center">Sitio Web en Mantenimiento<h1>
@extends('landing.layout')

@section('body')
<!--==========================
    Intro Section
  ============================-->

  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="carousel-background"><img src="img/slide/slide1.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>“La Educación formal te permitirá sobrevivir,<br>
                  la autoeducación te llevara al exito” <br>
                  Jim Rohn.</h2>
                <a href="{{ url('akademy')}}" class="btn-get-started scrollto">Mas Informacion</a> </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-background"><img src="img/slide/slide2.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>“La Educación formal te permitirá sobrevivir,<br>
                  la autoeducación te llevara al exito” <br>
                  Jim Rohn.</h2>
                <a href="{{ url('akademy')}}" class="btn-get-started scrollto">Mas Informacion</a> </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-background"><img src="img/slide/slide3.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>“La Educación formal te permitirá sobrevivir,<br>
                  la autoeducación te llevara al exito” <br>
                  Jim Rohn.</h2>
                <a href="{{ url('akademy')}}" class="btn-get-started scrollto">Mas Informacion</a> </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
    </div>
  </section>
  <!-- #intro -->
  
  <section id="ry-intro">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-2"> <img src="img/index/pilar.png" class="img-fluid mx-auto d-block" alt=""> </div>
        <div class="col-lg-10 text-white text-justify py-3">
          <p>Nuestro objetivo es compartir contigo nuestra experiencia, ya que estamos viviendo un cambio de era y que atravesamos por un periodo de transformaciones profundas que permiten la construcción de patrimonios y grandes riquezas, sabemos que con la información correcta podemos acceder a oportunidades únicas haciendo dinero con un "click", lo que nosotros llamamos inversiones inteligentes.</p>
        </div>
      </div>
    </div>
  </section>
  <section id="icon-links" class="py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-4">
          <h3>En que invertimos</h3>
          <img src="img/index/icon-1.png" class="img-fluid" alt=""/><br>
          <a href="{{ url('inversion')}}" class="btn btn-block ghost-button">Mas Informaci&oacute;n</a> </div>
        <div class="col-lg-4">
          <h3>Akademy</h3>
          <img src="img/index/akademy.png" class="img-fluid" alt=""/><br>
          <a href="https://akademy.teachable.com/" class="btn btn-block ghost-button" target="_blank">Mas Informaci&oacute;n</a> </div>
        <div class="col-lg-4">
          <h3>Registrarse</h3>
          <img src="img/index/icon-3.png" class="img-fluid" alt=""/><br>
          <a href="{{ url('register')}}" class="ghost-button btn btn-block">Mas Informaci&oacute;n</a> </div>
          <div class="col-lg-8 offset-lg-2 py-5">
              <video width="100%" height="360" controls>
                <source src="video/akademy.mp4" type="video/mp4">
                Your browser does not support the video tag.
                </video>
                <a href="https://akademy.teachable.com/" target="_blank" class="btn btn-success btn-lg btn-rounded">Ir a Akademy</a>          
                <hr>
                {{-- <div class="jumbotron">
                    <div class="card">
                        <div class="card-body">
                          <h1 class="display-4">Akademy</h1>
                          <hr>
                          <p>Por el lanzamiento de Akademy, Retire Young tiene becas limitadas disponibles para ti.</p>
                          <p>Para obtener tu beca solamente debes enviarnos un correo electrónico a <br>
                            <a href="mailto:akademy@retireyoung.co">akademy@retireyoung.co</a> <br>
                              compartiendo con nosotros por que quieres aprender Forex y te enviaremos un cupón con una beca del 50%</p>
                          <a href="https://akademy.teachable.com/" target="_blank" class="btn btn-success btn-lg btn-rounded">Ir a Akademy</a>
                        </div>
                    </div>  
                  </div>
                </div> --}}
            </div>	
	        </div>	
      </div>
    </div>
  </section>
  <section id="facts"  class="wow fadeIn">
    <div class="container">
      <header class="section-header">
        <h3>Estadisticas</h3>
      </header>
      <div class="row counters">
        <div class="col-lg-3 col-6 text-center"> <span data-toggle="counter-up">243</span>
          <p>Miembros</p>
        </div>
        <div class="col-lg-3 col-6 text-center"> <span data-toggle="counter-up">307,439.97</span>
          <p>Total Ganado</p>
        </div>
        <div class="col-lg-3 col-6 text-center"> <span data-toggle="counter-up">303,013.92</span>
          <p>Total Pagado</p>
        </div>
        <div class="col-lg-3 col-6 text-center"> <span data-toggle="counter-up">386,000.00</span>
          <p>Total Invertido</p>
        </div>
      </div>
    </div>
  </section>
  <!-- #facts -->
  
  <section id="testimonials" class="section-bg wow fadeInUp">
    <div class="container">
      <header class="section-header">
        <h3>Comentarios</h3>
      </header>
      <div class="owl-carousel testimonials-carousel">
        <div class="testimonial-item"> <img src="img/index/testimonio-1.jpg" class="testimonial-img" alt="">
          <h3>Jairo Núñez</h3>
          <p> <img src="img/quote-sign-left.png" class="quote-sign-left" alt=""> “Quiero agradecerles amigos por la tremenda bendición que es Retire Young para mi, desde que conocí en diciembre esta empresa he encontrado la abundancia, llego en el momento en que buscaba una respuesta financiera que no solo fuera buena sino también que fuera segura y real!”<img src="img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
        </div>
        <div class="testimonial-item"> <img src="img/index/testimonio-2.jpg" class="testimonial-img" alt="">
        <h3>Benjamin Navarrete </h3>
          <p> <img src="img/quote-sign-left.png" class="quote-sign-left" alt=""> “Retire Young te da una gran oportunidad en la cual puedes hacer que tu dinero trabaje por ti y a la vez te deja hacer o emprender en lo que más te guste, para mi una gran bendición!”<img src="img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
        </div>
        <div class="testimonial-item"> <img src="img/index/testimonio-3.jpg" class="testimonial-img" alt="">
          <h3>Zeidy Juarez</h3>
          <p> <img src="img/quote-sign-left.png" class="quote-sign-left" alt=""> “Retire Young significa para mí el medio que andaba buscando para incrementar mis ingresos y  poder disfrutar de un negocio innovador que está revolucionando el uso del dinero haciéndolo más rentable.<br>
  Gracias a retire Young me siento tranquila y con la confianza de saber que mi inversión se sigue incrementando en un 100% y que no espere mucho tiempo para obtener las ganancias y utilidades esperadas.”<img src="img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
        </div>
   
     
      </div>
    </div>
  </section>
  <!-- #testimonials -->
  
  @include('landing.proof')
  @include('landing.register_bar')
@endSection