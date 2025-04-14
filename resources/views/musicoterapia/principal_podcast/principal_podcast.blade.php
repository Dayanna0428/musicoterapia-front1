<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- Iconos y fuentes --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  {{-- Estilos locales --}}
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/PRINCIPAL_PODCAST/style.css') }}">

  <title>Tranquilidad</title>

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

  <script>
    async function includeHTML() {
      const elements = document.querySelectorAll('[include-html]');
      for (let el of elements) {
        const file = el.getAttribute('include-html');
        try {
          const response = await fetch(file);
          if (response.ok) {
            el.innerHTML = await response.text();
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
  {{-- Header --}}
  @include('musicoterapia.Header.header')

  <div class="container">
    <aside class="sidebar">
      <br /><br />
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
      <div class="menu-item {{ request()->routeIs('playlist') ? 'active' : '' }}">
        <a href="{{ route('playlist') }}">
          <img src="{{ asset('image/images/playL.png') }}" alt="Icon" />
          <span>PlayList</span>
        </a>
      </div>
      <div class="menu-item {{ request()->routeIs('me-gusta') ? 'active' : '' }}">
        <a href="{{ route('me-gusta') }}">
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

    <main class="main-content">
      <div class="title">
        <span>Podcast</span><br><br>
      </div>

      <div class="genres">
        {{-- Tarjeta 1 --}}
        <div class="genre">
          <div class="genre-card">
           <a href="{{ route('reproductor-podcast1') }}">
              <img src="{{ asset('image/images/podcast1.jpg') }}" alt="Afirmaciones" loading="lazy"
                onerror="this.style.display='none'; this.parentElement.innerHTML += '<div class=\'image-placeholder\'>Image Not Available</div>';" />
              <div class="genre-card-content">
                <h3>Afirmaciones</h3>
              </div>
            </a>
          </div>
        </div>
       
        {{-- Tarjeta 2 --}}
        <div class="genre">
          <div class="genre-card">
          <a href="{{ route('reproductor-podcast2') }}">
            <a href="/musicoterapia/Vistas1.1/REPRODUCCTORES/REPRO_PODCAST/AUTOESTIMA/Reproductorpodcast2.html">
              <img src="{{ asset('image/images/Podcast2.png') }}" alt="Autoestima" loading="lazy"
                onerror="this.style.display='none'; this.parentElement.innerHTML += '<div class=\'image-placeholder\'>Image Not Available</div>';" />
              <div class="genre-card-content">
                <h3>Autoestima</h3>
              </div>
            </a>
          </div>
        </div>
      
        {{-- Tarjeta 3 --}}
        <div class="genre">
          <div class="genre-card">
            <a href="{{ route('reproductor-podcast3') }}">
              <img src="{{ asset('image/images/PODCAST 2.jpg') }}" alt="Motivación" loading="lazy"
                onerror="this.style.display='none'; this.parentElement.innerHTML += '<div class=\'image-placeholder\'>Image Not Available</div>';" />
              <div class="genre-card-content">
                <h3>Motivación</h3>
              </div>
            </a>
          </div>
        </div>
     
        {{-- Tarjeta 4 --}}
        <div class="genre">
          <div class="genre-card">
            <a href="/musicoterapia/Vistas1.1/REPRODUCCTORES/REPRO_PODCAST/Reproductorpodcast.html?podcastId=4">
              <img src="{{ asset('image/images/PODCASTS 1.jpg') }}" alt="Electrónica" loading="lazy"
                onerror="this.style.display='none'; this.parentElement.innerHTML += '<div class=\'image-placeholder\'>Image Not Available</div>';" />
              <div class="genre-card-content">
                {{-- Puedes agregar texto si quieres --}}
              </div>
            </a>
            <a href="{{ route('estudio') }}" class="boton-enlace">
              <button class="add-button">
                <i class="material-icons">add</i>
              </button>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <br><br><br><br>

  {{-- Footer --}}
  @include('musicoterapia.Fotter.inicio.footer')

  {{-- Scripts --}}
  <script src="{{ asset('js/musicoterapia.js/PRINCIPAL_PODCAST/script.js') }}"></script>
</body>

</html>
