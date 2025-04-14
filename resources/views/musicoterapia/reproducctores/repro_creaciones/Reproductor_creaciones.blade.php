<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Estilos -->
 <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
 <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/REPRO_CREACIONES/style.css') }}">

 <style>
   body {
     background-image: 
       linear-gradient(rgba(240, 230, 255, 0.85), rgba(240, 230, 255, 0.85)), 
       url('{{ asset('image/images/fondo_principal 2 abastrato.png') }}');
     background-size: cover;
     background-position: center;
     background-repeat: no-repeat;
     background-attachment: fixed;
     margin: 0;
     padding: 0;
   }
 </style>
    
    <title>tranquilidad</title>
    <script>
      async function includeHTML() {
          const elements = document.querySelectorAll('[include-html]');
          for (let el of elements) {
              const file = el.getAttribute('include-html');
              try {
                  const response = await fetch(file);
                  if (response.ok) {
                      el.innerHTML = await response.text();
                      // Cargar el JS del footer después de insertarlo
                      if (file.includes("header.html")) {
                          const script = document.createElement("script");
                          script.src = "/rutinas-de-ejercicios/includes/Header/script.js";
                          document.body.appendChild(script);
                      }
                  } else {
                      el.innerHTML = "<p>Error al cargar el contenido.</p>";
                  }
              } catch (error) {
                  el.innerHTML = "<p>Error de conexión al cargar el contenido.</p>";
              }
          }
      }
      document.addEventListener("DOMContentLoaded", includeHTML);
  </script>


</head>
<body>
  @include('musicoterapia.Header.header')
  <div class="container">
    <aside class="sidebar">
      <br />
      <br />
      <br>
      <div class="menu-item {{ request()->routeIs('generos') ? 'active' : '' }}">
        <a href="{{ route('generos') }}">
          <img src="{{ asset('image/images/genero.png') }}" alt="Icon" />
          <span>Géneros</span>
        </a>
      </div>
      
      <div class="menu-item {{ request()->routeIs('album') ? 'active' : '' }}">
        <a href="{{ route('album') }}">
          <img src="{{ asset('image/images/album.png') }}" alt="Icon" />
          <span>Álbum</span>
        </a>
      </div>

      <div class="menu-item {{ request()->routeIs('podcast') ? 'active' : '' }}">
        <a href="{{ route('podcast') }}">
          <img src="{{ asset('image/images/pod.png') }}" alt="Icon" />
          <span>Podcast</span>
        </a>
      </div>

      <div class="menu-item {{ request()->routeIs('binaurales') ? 'active' : '' }}">
        <a href="{{ route('binaurales') }}">
          <img src="{{ asset('image/images/binaural.png') }}" alt="Icon" />
          <span>Sonidos Binaurales</span>
        </a>
      </div>

      <div class="menu-item {{ request()->is('musicoterapia/Vistas1.1/PLAYLIST/*') ? 'active' : '' }}">
        <a href="{{ route('playlist') }}" style="text-decoration: none">
          <img src="{{ asset('image/images/playL.png') }}" alt="Icon"  />
          <span>PlayList</span>
        </a>
      </div>
      
      <div class="menu-item {{ request()->routeIs('me-gusta') ? 'active' : '' }}">
        <a href="{{ route('me-gusta') }}" style="text-decoration: none">
          <img src="{{ asset('image/images/like.png') }}" alt="Icon" />
          <span>Me gusta</span>
        </a>
      </div>
      <div class="menu-item {{ request()->routeIs('buscar') ? 'active' : '' }}">
        <a href="{{ route('buscar') }}">
          <img src="{{ asset('image/images/buscar boton.png') }}" alt="Icon" />
          <span>Buscar</span>
        </a>
      </div>
    </aside>

    <main class="main">
        <div class="video-container">
          <div class="video-scroll-wrapper" id="videoScrollWrapper">
              <div class="video-card">
                  <video class="video-player" loop controls>
                      <source src="/musicoterapia/Vistas1.1/Videos/Download (1).mp4" type="video/mp4">
                      Your browser does not support the video tag.
                  </video>
                  <div class="video-actions">
                      <button class="action-button like-button">
                          <i class="fas fa-heart"></i>
                          <span class="action-count">1.2K</span>
                      </button>
                      <button class="action-button bookmark-button">
                          <i class="fas fa-bookmark"></i>
                          <span class="action-count">856</span>
                      </button>
                      <button class="action-button share-button">
                          <i class="fas fa-share"></i>
                          <span class="action-count">234</span>
                      </button>
                  </div>
              </div>
              <div class="video-card">
                  <video class="video-player" loop controls>
                      <source src="/musicoterapia/Vistas1.1/Videos/Download.mp4" type="video/mp4">
                      Your browser does not support the video tag.
                  </video>
                  <div class="video-actions">
                      <button class="action-button like-button">
                          <i class="fas fa-heart"></i>
                          <span class="action-count">2.5K</span>
                      </button>
                      <button class="action-button bookmark-button">
                          <i class="fas fa-bookmark"></i>
                          <span class="action-count">945</span>
                      </button>
                      <button class="action-button share-button">
                          <i class="fas fa-share"></i>
                          <span class="action-count">321</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
      </main>
  </div>
    
    </div>
    <br>
    <br>
    <br>
    <br>
    @include('musicoterapia.Fotter.inicio.footer')
    
    <script src="{{ asset('js/musicoterapia.js/REPRODUCCTORES/REPRO_CREACIONES/scrip.js') }}"></script>

<body>
</html>