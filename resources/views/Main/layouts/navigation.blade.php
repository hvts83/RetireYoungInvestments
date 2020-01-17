<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
          <div class="dropdown profile-element"> <span>
            <img alt="image" class="img-circle" src="{{ asset('img/retireyoung-logo.png') }}" style="width:  120px; height:  auto;">
          </span>
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear">
              <span class="block m-t-xs">
                <img src="{{ asset(Auth::user()->image->url) }}" class="img-circle" width="64px">
             </span>
             <span class="text-muted text-xs block">
                <strong class="font-bold">{{ Auth::user()->name }}</strong>
               <b class="caret"></b>
             </span>  
          </a>
             <ul class="dropdown-menu animated fadeInRight m-t-xs">
              <li><a href="{{ url('profile')}}">Perfil</a></li>
              <li><a href="{{ url('settings')}}">Configuración</a></li>
              <li class="divider"></li>
              <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Cerrar sesión </a>
              </li>
          </ul>
          </div>
            <div class="logo-element">
                RY
            </div>
        </li>

        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
        </li>
        <li><a href="{{ url('profile')}}"><i class="fa fa-user"></i> <span class="nav-label">Perfil</span></a></li>
        <li>
          <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Inversión</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
              <li><a href="{{url('invest/plans')}}">Planes</a></li>
              <li><a href="{{url('invest/payment')}}">Deposito/Transferencias</a></li>
              <li><a href="{{url('invest/history')}}">Historial</a></li>
              <li><a href="{{url('withdraw')}}">Retiros</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Referidos</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
              <li><a href="{{url('referal/index')}}">Personas Referidas</a></li>
              <li><a href="{{url('referal/tools')}}">Herramientas</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-university"></i> <span class="nav-label">Akademy</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
              <li><a href="https://akademy.teachable.com/" target="_blank">Sitio</a></li>
              <li><a href="{{ url('course/index') }}"> Mis cursos</a></li>
              <li><a href="{{url('course/tools')}}">Herramientas</a></li>
              <li><a href="{{url('course/referal')}}">Referidos</a></li>
              <li><a href="{{url('course/retire')}}">Retiro de comisiones</a></li>
          </ul>
        </li>
        <li>
          <a href="{{url('mailbox/compose')}}"><i class="fa fa-envelope"></i> <span class="nav-label">Mensaje a administrador</span></a>
        </li>
        <li>
          <a href="{{url('videos')}}" target="_blank"><i class="fa fa-video-camera"></i> <span class="nav-label">Videos</span></a>
        </li>
        <li><a href="{{ url('settings')}}"><i class="fa fa-cog"></i> <span class="nav-label">Configuración</span></a></li>
      </ul>
    </div>
</nav>
