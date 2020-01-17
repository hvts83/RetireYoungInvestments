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
             <li><a href="{{ url('admin/profile')}}">Perfil</a></li>
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
          <a href="{{ url('/admin/home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
        </li>
        <li><a href="{{ url('admin/profile')}}"><i class="fa fa-user"></i> <span class="nav-label">Perfil</span></a></li>
        <li>
            <a href="{{ url('admin/report') }}"><i class="fa fa-file"></i> <span class="nav-label">Reportes</span></a>
        </li>
        @if( Auth::user()->type != 'C')
        <li>
          <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Usuarios</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
              <li><a href="{{ url('admin/socios/') }}">Usuarios</a></li>
              <li><a href="{{ url('admin/retire')}}">Solicitudes de retiros</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Planes</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li><a href="{{ url('admin/planes') }}">Planes Generales</a></li>
            <li><a href="{{ url('admin/promocional')}}">Planes Promocionales</a></li>
            <li><a href="{{ url('admin/user-plans/index')}}">Planes de usuarios</a></li>
            <li><a href="{{ url('admin/user-plans/activate') }}">Activar Plan</a></li>
            <li><a href="{{ url('admin/transaction') }}">Transacciones</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-university"></i> <span class="nav-label">Akademy</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
              <li><a href="https://akademy.teachable.com/" target="_blank">Sitio</a></li>
              <li><a href="{{ url('admin/course') }}">Cursos</a></li>
              <li><a href="{{url('admin/akademy/index')}}">Activacion de cursos</a></li>
              <li><a href="{{url('admin/akademy/referal')}}">Activacion de referidos</a></li>
              <li><a href="{{url('admin/akademy/transaction')}}">Generar comisiones</a></li>
              <li><a href="{{url('admin/akademy/retire')}}">Solicitud de retiro</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ url('admin/config') }}"><i class="fa fa-cog"></i> <span class="nav-label">Configuración</span></a>
        </li>
        @endif
      </ul>
    </div>
</nav>
