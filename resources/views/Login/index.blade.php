<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset("assets/librerias/bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/librerias/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/StyleLogin/login.css")}}" rel="stylesheet" type="text/css" />
<style>
    *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

.wave{
	position: fixed;
	bottom: 0;
	left: 0;
	height: 100%;
	z-index: -1;
}

.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.img{
	display: flex;
	justify-content: flex-end;
	align-items: center;
}

.login-content{
	display: flex;
	justify-content: flex-start;
	align-items: center;
	text-align: center;
}

.img img{
	width: 500px;
}

form{
	width: 360px;
}

.login-content img{
    height: 100px;
}

.login-content h2{
	margin: 15px 0;
	color: #333;
	text-transform: uppercase;
	font-size: 2.9rem;
}

.login-content .input-div{
	position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
}

.login-content .input-div.one{
	margin-top: 0;
}

.i{
	color: #d9d9d9;
	display: flex;
	justify-content: center;
	align-items: center;
}

.i i{
	transition: .3s;
}

.input-div > div{
    position: relative;
	height: 45px;
}

.input-div > div > h5{
	position: absolute;
	left: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #352525;
	font-size: 18px;
	transition: .3s;
}

.input-div:before, .input-div:after{
	content: '';
	position: absolute;
	bottom: -2px;
	width: 0%;
	height: 2px;
	background-color: #04a1fc;
	transition: .4s;
}

.input-div:before{
	right: 50%;
}

.input-div:after{
	left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
	width: 50%;
}

.input-div.focus > div > h5{
	top: -5px;
	font-size: 15px;
}

.input-div.focus > .i > i{
	color: #04a1fc;
}

.input-div > div > input{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}
.input-div > div > select{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}

.input-div.pass{
	margin-bottom: 4px;
}

a{
	display: block;
	text-align: right;
	text-decoration: none;
	color: #999;
	font-size: 0.9rem;
	transition: .3s;
}

a:hover{
	color: #04a1fc;
}

.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	background: #04a1fc;
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	font-family: 'Poppins', sans-serif;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
}
.btn:hover{
	background-position: right;
	background: #142e3d;
	color: wheat;
}


@media screen and (max-width: 1050px){
	.container{
		grid-gap: 5rem;
	}
}

@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}

	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}

	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 900px){
	.container{
		grid-template-columns: 1fr;
	}

	.img{
		display: none;
	}

	.wave{
		display: none;
	}

	.login-content{
		justify-content: center;
	}
}

.error{
    background: #FF3D3D;
    color: white;
}

.verPassword{
    font-size: 20px;
    cursor: pointer;
    position: absolute;
    float: right;
    margin-top: -60px;
}
.view{
    width: 100%; 
    display: flex;
    align-items: center;
    justify-content: flex-end;
    
    
}
</style>
    <title>Login</title>
</head>
<body class="align">
    <img class="wave" src="{{ asset("assets/img/login/wave.png")}}">
    <div class="container">
       <div class="img">
          <img src="{{ asset("assets/img/login/bg.svg")}}">
       </div>
       <div class="login-content">
          <form method="POST" action="{{ route('login_post') }}" name="flogin" id="flogin" autocomplete="off" class="form-table form-login">
            @csrf
             <img src="{{ asset("assets/img/login/avatar.svg")}}">
             <h2 class="title">BIENVENIDO</h2>
             <div class="input-div one">
                <div class="i">
                    <i class="bi bi-person-circle" style="font-size: 2rem; color: rgb(50, 58, 58);"></i>
                </div>
                <div class="div">
                   <h5>Usuario</h5>
                   <input type="number" id="email" name="email" class="input">
                </div>
             </div>
             <div class="input-div pass">
                <div class="i">
                    <i class="bi-key" style="font-size: 2rem; color: rgb(50, 58, 58);"></i>
                </div>
                <div class="div">
                   <h5>Contraseña</h5>
                   <input type="password" id="password" name="password" class="input" >
                </div>
             </div>
            
             <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
               <!--para mesaje de alerta error de credenciales-->
                @if ($errors -> any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <div class="alert-text">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error}}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            <!--fin-->
          </form>
       </div>
    </div>
    
    {{--<div class="login">
  
        <header class="login__header">
            <h2><svg class="icon">
                <use xlink:href="#icon-lock" />
            </svg>Inicio de sesion</h2>
        </header>
  
        <form class="login__form" method="POST" action="{{ route('login_post') }}" name="flogin" id="flogin" autocomplete="off">
            @csrf
            <div>
            <label for="number">Usuario</label>
            <input type="number" id="email" name="email" value="{{old('email')}}" placeholder="Nro. de usuario" required>
            </div>
    
            <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
    
            <div>
            <input class="button" type="submit" value="Conestarse">
            </div>
            <!--para mesaje de alerta error de credenciales-->
            @if ($errors -> any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <div class="alert-text">
                    @foreach ($errors->all() as $error)
                    <span>{{ $error}}</span>
                    @endforeach
                </div>
            </div>
            @endif
            <!--fin-->
        </form>
  
    </div>
  
    <svg xmlns="http://www.w3.org/2000/svg" class="icons">
  
      <symbol id="icon-lock" viewBox="0 0 448 512">
        <path d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z" />
      </symbol>
  
    </svg>--}}
  
    <script src="{{ asset("assets/librerias/jquery/jquery-3.3.1.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/librerias/bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/librerias/bootstrap4/js/bootstrap.bundle.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/scripts/login/main.js")}}" type="text/javascript"></script>

  </body>

</html>