<div class="sidebar close">
    <div class="logo-details">
        <a href="{{route('inicio')}}" class="logo">
            <i class="bi bi-house-door"></i>{{-- style="font-size: 1rem;"--}}
        </a>
        <span class="logo_name">Sistema</span>
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
                <li><a href="#">Lista de Medicos</a></li>
                <li><a href="#">Lista de Pacientes</a></li>
                <li><a href="#">Lista de Municipios</a></li>
                <li><a href="#">Lista de Establecimientos</a></li>
                <li><a href="#">Lista Diagnostiscos</a></li>
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
                <li><a href="{{route('SolicitudRural.index')}}">Rural Solicitudes</a></li>{{--SolicitudRural.index--}}
                <li><a href="{{route('resultado_rural.resultadoR')}}">Rural Resultados</a></li>
                <li><a href="{{route('test')}}">Rural Informes</a></li>
                <li><a href="#">Urbano Solicitudes</a></li>
                <li><a href="#">Urbano Resultados</a></li>
                <li><a href="#">Urbano Informes</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-clipboard-data"></i>
                    <span class="link_name">Citologia</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Citologia</a></li>
                <li><a href="#">Solicitud</a></li>
                <li><a href="#">Resultado</a></li>
                <li><a href="#">Informes</a></li>
            </ul>
        </li>
      
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="{{ asset("assets/img/login/avatar.svg")}}" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{--auth()->user()->per_user->nombres.' '.auth()->user()->per_user->apellidos --}}</div>
                    <div class="job">Web Desginer</div>
                </div>
                <a href="{{route('logout')}}" class="logout">
                    <i class="bi bi-box-arrow-left" style="font-size: 2rem; color: rgb(222, 12, 12);" ></i>
                </a>
                <ul class="sub-menu"  style="margin-top: -28px; align: center;">
                    {{--<li><a class="link_name" href="#">Administrar</a></li>--}}
                    <span class="" style="margin: -17px; font-size: 14px; color: white">Cerrar Sesion</span>
                    <li><a href="{{route('logout')}}" class="iconlogout">
                        <i class="bi bi-box-arrow-left" style="margin-top: -8px; font-size: 2.5rem; color: red; " ></i>    
                    </a></li>
                </ul>
            </div>             
        </li>
    </ul>
</div>