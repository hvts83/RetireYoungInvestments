@extends('Admin.layouts.app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
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
        <form role="form" method="post" action="{{ url('/admin/user-plans/activate') }}">
             {{ csrf_field() }}
            <div class="form-group">
                <label>Usuario</label>
                <select name="user_id" class="chosen-select">
                    <option selected disabled>Usuario</option>
                    @foreach($users as $user )
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
              </select>
            </div>
            <div class="form-group">
                    <label>Plan</label>
                    <select name="plan_id" class="chosen-select">
                        <option selected disabled>Plan</option>
                        @foreach($plans as $plan )
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach
                  </select>
                </div>
            <div class="form-group">
                <label>Inicia</label>
                <input type="date" class="form-control" name="start_at">
            </div>
            <label>Cargo</label>
            <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Pagado" class="form-control" name="charge" min='0'>
            </div>
            <div class="div-btn">
                <a href="{{ url('admin/user-plans/index') }}" class="btn m-t-n-xs"><strong>Cancelar</strong></a>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link href="{{ asset('css/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
  <link href="{{ asset('css/iCheck/custom.css')}}" rel="stylesheet">
  <link href="{{ asset('css/datepicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('scripts')
  <script src="{{ asset('js/chosen/chosen.jquery.js')}}"></script>
  <script src="{{ asset('js/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{ asset('js/iCheck/icheck.min.js')}}"></script>
  <script>
    $('.chosen-select').chosen({
      width: "100%",
      no_results_text: "No se encontró resultados"
    });
  </script>
@endsection