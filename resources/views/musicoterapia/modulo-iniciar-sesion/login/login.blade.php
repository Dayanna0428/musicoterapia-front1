<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión</title>
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Login/login.css') }}">
  <style>
   .crearCuenta{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 70%;
    height:100vh;
    overflow:hidden;
    /* background-color: #fafafb; */
    filter: brightness(90%); /* Reduce el brillo al 50% */
    background-image:  url('image/login/Imagen de WhatsApp 2024-12-09 a las 20.39.27_862bd1f7.jpg');
}
  </style>
</head>

<body>
  <div class="contenedorCrearcuenta">
    <!-- contenedor de ingresar -->
    <div class="ingresar">
      <div class="contenedorLogo">
        <img src="{{ asset('image/images/6aa3987c-48ce-4355-b6bf-26c76c37e93d-removebg.png') }}"  alt="" />
      </div>
      <div class="contenedorH2">
        <h2>¡Bienvenido De Nuevo!</h2>
      </div>
      <div class="contenedorP">
        <p>Para mantenerse conectado, inicie sesión con su información personal.</p>
      </div>
    </div>
    <!-- contenedor de crear cuenta -->
    <div class="crearCuenta">
      <div class="contenedorIngresar">
        <h1>Iniciar sesión</h1>
        <p>Ingresa tus datos</p>
        <form class="registrarse" id="loginForm">
          <div class="inputGrupo">
            <input type="email" id="email" placeholder="Correo:" required />
          </div>
          <div class="inputGrupo">
            <input type="password" id="password" placeholder="Contraseña:" required />
          </div>
          <div class="btnRegistro">
            <button type="submit" class="button">
              <h3>Ingresar</h3>
            </button>            
          </div>
        </form>
        <div id="message" style="text-align: center; margin-top: 10px;"></div> <!-- Added for feedback -->
      </div>
      <a href="{{ route('mensaje') }}">¿Olvidaste tu contraseña?</a>
      <a href="/inicio-de-sesion/Modulo-iniciar-sesion/registroProfesional/registroProfesional.html">Registrarse como
        profesional</a>
        <a href="{{ route('registro') }}">Regístrate</a>
      <div class="redes">
        <div class="contenedorRedes">
          <a href="#"><img src="{{ asset('image/login/facebookLogo.png') }}"alt="Facebook" /></a>
        </div>
        <div class="contenedorRedes">
          <a href="#"><img src="{{ asset('image/login/gmail.png') }}" alt="Google" /></a>
        </div>
        <div class="contenedorRedes">
          <a href="#"><img src="{{ asset('image/login/Apple.png') }}" alt="Apple" /></a>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/musicoterapia.js/Login/fetch.js') }}"></script> <!-- Ensure this matches your file name -->
</body>

</html>