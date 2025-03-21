<div class="sidebar close">
    <div class="logo-details">
        <a href="{{route('inicio')}}" class="logo">
            <i class="bi bi-house-door"></i>{{-- style="font-size: 1rem;"--}}
        </a>
        <span class="logo_name">Sistema de control de lab. Patologia</span>
    </div>
    <ul class="nav-links">
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-journals"></i>
                    <span class="link_name">Administrador</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Administrador</a></li>
                <li><a href="{{route('medicos.index')}}">MEDICOS</a></li>
                <li><a href="{{route('pacientes.index')}}">PACIENTES</a></li>
                <li><a href="{{route('municipios.index')}}">MUNICIPIOS</a></li>
                <li><a href="{{route('establecimientos.index')}}">ESTABLECIMIENTOS</a></li>
                <li><a href="{{route('diagnosticos.index')}}">DIAGNOSTICOS</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-calendar2-check"></i>
                    <span class="link_name">Patologia</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" >Patologia</a></li>
                <li><a href="{{route('SolicitudRural.index')}}">REGISTRO SOLICITUDES</a></li>
                <li><a href="{{route('resultado_rural.resultadoR')}}">REGISTRO RESULTADOS</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-kanban"></i>
                    <span class="link_name">Citologia</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Citologia</a></li>
                <li><a href="{{route('SolicitudCitolgia.index')}}">REGISTRO SOLICITUDES</a></li>
                <li><a href="{{route('ResultadoCitolgia.index')}}">REGISTRO RESULTADOS</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-clipboard-data"></i>
                    <span class="link_name">Reportes</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Reportes</a></li>
                <li><a href="{{route('vista.reportes.index')}}">REPORTES ACTUALES</a></li>
                <li><a href="{{route('reportes.old.index')}}">REPORTES ANTERIORES</a></li>
            </ul>
        </li>
      
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="{{ asset("assets/img/login/avatar.svg")}}" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{auth()->user()->persona->nombres.' '.auth()->user()->persona->apellidos}}</div>
                    <div class="job">Usuario</div>
                </div>
                <a href="{{route('logout')}}" class="logout">
                    <i class="bi bi-box-arrow-left" style="font-size: 2rem; color: rgb(222, 12, 12);" ></i>
                </a>
                <ul class="sub-menu"  style="margin-top: -28px; align: center;">
                    {{--<li><a class="link_name" href="#">Administrar</a></li>-- }}
                    <span class="" style="margin: -17px; font-size: 14px; color: white">Cerrar Sesion</span>--}}
                    <li class="link_name mt-1" style="margin-left: -14px; font-size: 14px; color: white" >Usuario: {{auth()->user()->persona->nombres.' '.auth()->user()->persona->apellidos}} </li>
                    <li>
                        <a href="{{route('logout')}}" class="iconlogout">
                            <span class="mt-2" style="margin: -10px; font-size: 14px; color: white" >Cerrar Sesion</span>
                            <i class="bi bi-box-arrow-left ml-4 " style="margin-top: -5px; font-size: 2.5rem; color: red; " ></i>    
                        </a>
                    </li>
                </ul>
            </div>             
        </li>
    </ul>
</div>