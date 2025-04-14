<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/GENERO_ELEGIDO/ELECTRONICA/style.css') }}">
  <style>
    body {
  background-image: 
      linear-gradient(rgba(240, 230, 255, 0.8), rgba(240, 230, 255, 0.8)),
      url('/image/imagenes/fondo_principal1abastrato.png');
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  margin: 0;
  padding: 0;
  min-height: 100vh;
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
      <br>
      <br>
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
        <img src="{{ asset('image/images/playL.png') }}" alt="Icon" />
        <a href="{{ route('playlist') }}" >
          <span>PlayList</span>
        </a>
      </div>
    
      <div class="menu-item {{ request()->routeIs('me-gusta') ? 'active' : '' }}">
        <img src="{{ asset('image/images/like.png') }}" alt="Icon" />
        <a href="{{ route('me-gusta') }}">
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
      <div class="title">
        <span></span>
      </div>
      <div class="tabs">
        <div class="black" onclick="window.location.href='#pistas'"></div>
        <div class="purple" onclick="window.location.href='#podcast'">
          <h1 id="titulo-genero">Género</h1>
        </div>
      </div>
      <br>
      <div class="content">



        <div class="player">
          <div class="album-cover">
            <img id="album-image" src="/musicoterapia/Vistas1.1/images/El-piano.jpg" alt="genre" />
            <div class="playhead"></div>
          </div>
          <div>
            <h2 id="audio-title" style="margin: 0">Bienvenido y disfruta ♫</h2>
            <p id="audio-artist">Artist</p>
          </div>
          <div class="progress-container">
            <input type="range" id="progress-bar" value="0" min="0" max="100" step="0.1">
          </div>
          <div class="time">
            <span id="current-time">0:00</span>
            <span id="total-duration">0:00</span>
          </div>
          <div class="controls">
            <button id="prev-btn">&#9664;&#9664;</button>
            <button id="play-pause-btn">&#9654;</button>
            <button id="next-btn">&#9654;&#9654;</button>
          </div>
          <div class="actions">
            <div><span class="me-gusta">❤</span></div>
            <button class="dropdown-button" onclick="toggleDropdown('dropdown')">
              &#8942;
            </button>
            <div id="dropdown" class="dropdown">
              <div class="dropdown-content">Agregar a favoritos</div>
              <div class="dropdown-content" onclick="toggleNestedDropdown('playlist-dropdown')">
                Agregar a playlist
              </div>
              <div id="playlist-dropdown" class="nested-dropdown">
                <div class="dropdown-content">Playlist 1</div>
                <div class="dropdown-content">Playlist 2</div>
                <div class="dropdown-content">Playlist 3</div>
              </div>
              <div class="dropdown-content" onclick="showHorizontalList()">
                Compartir
              </div>
            </div>
          </div>
          <div id="horizontal-list" class="horizontal-list">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
              alt="Facebook" />
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" />
            <button onclick="copyLink()">Copiar Link</button>
          </div>
        </div>




        <div class="tracks-container" id="tracks-list">
          <!-- Los audios se cargarán dinámicamente aquí -->

        </div>




      </div>
    </main>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  @include('musicoterapia.Fotter.inicio.footer')
    
  <script src="{{ asset('js/musicoterapia.js/REPRODUCCTORES/GENERO_ELEGIDO/scrip.js') }}"></script>
</body>
</html>