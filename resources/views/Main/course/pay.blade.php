@extends('Main.layouts.app')

@section ('title') @stop

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pago de Cursos BAC</h5>
                </div>
                <div class="ibox-content">
                  <h3>10 claves para posicionarte en redes </h3>
                  <iframe style="width: 210px;border: none;height: 325px; display: inline;"
                  title=Pagar ahora
                  src="https://checkout.baccredomatic.com/payment_button?token=ZDQzNzUzMWEuMmIxMWI1NTc1OTJkOTYxNTcxMjQ4OTUx&color=%23ffffff&background=%23e4002b&text=Pagar ahora&hasimage=true">
                  <p>Your browser does not support iframes.</p>
                  </iframe>
                  <h3>EmprenDmente</h3>
                  <iframe
                style="width: 210px;border: none;height: 325px; display: inline;"
                title=Pagar ahora
                src="https://checkout.baccredomatic.com/payment_button?token=NmNkMS42YTEzMjM5MzUxZGMwNTcxMDkxNTcxMjUwNjI3&color=%23ffffff&background=%23e4002b&text=Pagar ahora&hasimage=true">
                <p>Your browser does not support iframes.</p>
                </iframe>
                  <h3>Locucion Profesional</h3>
                  <iframe
                  style="width: 210px;border: none;height: 325px; display: inline;"
                  title=Pagar ahora
                  src="https://checkout.baccredomatic.com/payment_button?token=NDA1OTMuNDdhMmRkOTMxN2FjMDY1MDcxNTcxMjUwNTAx&color=%23ffffff&background=%23e4002b&text=Pagar ahora&hasimage=true">
                  <p>Your browser does not support iframes.</p>
                  </iframe>
                  <!-- <h3>Ventas Efectivas</h3>
                  <iframe style="width: 210px;border: none;height: 325px; display: inline;" title="Payment Button IFrame" src="https://checkout.baccredomatic.com/payment_button?token=NzcwMzYwOTQ5OC43NTAwMjJlYzYyNzAxNTU4MzgwNTQ2&color=%23ffffff&background=%2383c260&text=Pagar%20ahora&hasimage=true"><p>Your browser does not support iframes.</p></iframe> -->
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pagos Paypal</h5>
                        </div>
                        <div class="ibox-content">
                          <h3>10 claves para posicionarte en redes</h3>
                          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                          <input type="hidden" name="cmd" value="_s-xclick">
                          <input type="hidden" name="hosted_button_id" value="YGRUAU7VJGPLY">
                          <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                          <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                          </form>
                          <h3>EmprenDmente</h3>
                          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                          <input type="hidden" name="cmd" value="_s-xclick">
                          <input type="hidden" name="hosted_button_id" value="CFMZE95AATJ5W">
                          <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                          <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">                                          
                          </form>
                          <h3>Locucion Profesional</h3>
                          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                          <input type="hidden" name="cmd" value="_s-xclick">
                          <input type="hidden" name="hosted_button_id" value="7XRL6QFDBPX28">
                          <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                          <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                          </form>
                        </div>
                    </div>
        </div> -->
        
        <!--Referidos-->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
            </div>
        </div>
            
    </div>
</div>

@endSection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/dataTables/datatables.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{ asset('js/dataTables/datatables.min.js')}}"></script>
  
<script>

    //Datatable
    var tabla = $('.tables').DataTable({
      "paging": true,
      "language": {
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