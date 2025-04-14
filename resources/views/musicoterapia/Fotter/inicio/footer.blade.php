<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Fotter/inicio/styles.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="{{  asset('js/musicoterapia.js/Fotter/inicio/script.js') }}"></script>
  <title>Tranquilidad</title>
</head>
<body>

  <footer class="footer">
    <div class="footer-container">
      <div class="footer-column">
        <h4>Acerca de Tranquilidad</h4>
        <ul>
            <li><a href="{{ route('quienes.somos')  }}">Acerca de</a></li>
            <li><a href="{{ route ('beneficios') }}">Beneficios de la Tranquilidad</a></li>
            <li><a href="{{ route('consejos') }}">Consejos de Bienestar</a></li>
        </ul>
      </div>
  
      <div class="footer-column">
        <h4>Ayuda y Soporte</h4>
        <ul>
          <li><a href="{{ route('contacto') }}">Contacto</a></li>
          <li><a href="{{ route('sugerencias') }}">Sugerencias</a></li>
          <li><a href="{{ route('guia') }}">Guía de uso</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Información Legal</h4>
        <ul>
          <li><a href="{{ route('terminos-y-condiciones') }}">Términos y condiciones</a></li>
          <li><a href="{{ route('politica-privacidad') }}">Política de privacidad</a></li>
          <li><a href="{{ route('aviso-legal') }}">Aviso legal</a></li>
        </ul>
      </div>
    </div>
    
    <div class="footer-bottom">
      <p>&copy; 2024 Tranquilidad. Todos los derechos reservados.</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
  </footer>
  
</body>
</html>
