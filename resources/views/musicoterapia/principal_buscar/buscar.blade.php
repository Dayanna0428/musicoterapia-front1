<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  {{-- Iconos --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  
  {{-- Estilos --}}
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/PRINCIPAL_BUSCAR/style.css') }}">

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

  <title>Tranquilidad - Búsqueda</title>

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
      <br><br><br>
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
        <span>Búsqueda</span>
        <br><br>
      </div>

      <div class="content">
        <div class="search-bar">
          <img src="{{ asset('image/img/buscar.png') }}" alt="Ícono de búsqueda">
          <input type="text" placeholder="Buscar pistas, álbumes, etc." aria-label="Buscar contenido">
        </div>
        <br>

        <div class="image-container">
          <img id="carousel-image"  src="{{ asset('image/images/GENERO CARRUSEL 1.png') }}" alt="Carrusel de géneros" />
          <img id="carousel-image"  src="{{ asset('image/images/ALBUM CARRUSEL.png') }}" alt="Carrusel albums" />
        </div>
       
        <div class="recently">Resultados</div>

        <!-- Contenedor de pistas -->
        <div class="image-container2">
          <div class="content">
            <div class="tracks-container" id="tracks-container">
              <p>Cargando resultados...</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <br><br><br><br>

  {{-- Footer --}}
  @include('musicoterapia.Fotter.inicio.footer')

  {{-- Scripts --}}
  <script>
    const images = [
      { src:"{{ asset('image/images/GENERO CARRUSEL 1.png') }}", link: "/musicoterapia/Vistas1.1/PRINCIPAL_GENEROS/principal_generos.html", alt: "Carrusel de géneros" },
      { src:"{{ asset('image/images/ALBUM CARRUSEL.png') }}", link:"{{ route('album') }}", alt: "Carrusel de álbumes" },
      { src: "{{ asset('image/images/PODCASTS CARRUSEL.png') }}", link: "/musicoterapia/Vistas1.1/PRINCIPAL_PODCAST/principal_podcast.html", alt: "Carrusel de podcasts" },
      { src: "{{ asset('image/images/BINAURAL CARRUSEL 2.png') }}", link: "/musicoterapia/Vistas1.1/SONIDOS_BINAURALES/binaurales.html", alt: "Carrusel de sonidos binaurales" }
    ];
  </script>
  <script>
    const reproductorBusquedaUrl = "{{ route('reproductor-busqueda') }}";
</script>

  <script src="{{ asset('js/musicoterapia.js/PRINCIPAL BUSCAR/script.js') }}"></script>
</body>

</html>
