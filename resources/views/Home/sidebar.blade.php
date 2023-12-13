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
                    <span class="link_name">Administrar</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Administrar</a></li>
                <li><a href="{{route('medicos.lista')}}">Lista de medicos</a></li>
                <li><a href="#">Lista de areas</a></li>
                <li><a href="#">Lista tipo de contratos</a></li>
                <li><a href="#">Lista de personas</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-calendar2-check"></i>
                    <span class="link_name">Rolturnos</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Rolturnos</a></li>
                <li><a href="#">Lista tipo de turnos</a></li>
                <li><a href="#">Crear rol de turnos</a></li>
                <li><a href="#">Lista de rol turnos</a></li>
                <li><a href="#">Habilitacion de turnos</a></li>
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
                <li><a href="#">Reportes 1</a></li>
                <li><a href="#">Reportes 2</a></li>
                <li><a href="#">Reportes 3</a></li>
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