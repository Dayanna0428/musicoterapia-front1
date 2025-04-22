<!DOCTYPE html>
<html lang="esp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Icon Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/PRINCIPAL_ALBUM/style.css') }}">

  <title>tranquilidad</title>

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
  @include('musicoterapia.Header.header')

  <div class="container">
    <aside class="sidebar">
      <br><br>
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
          <br><br>
          <span>Albums</span>
        </div>
        <br>
        <div class="genres" id="albums-container">
          <!-- Álbumes se cargarán aquí dinámicamente -->
        </div>
      </main>
  </div>

  <br><br><br><br>

  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const api = new API();
      const albumsContainer = document.getElementById('albums-container');

      try {
        // Obtener álbumes desde la API
        const { data: albums } = await api.getAllAlbums();

        // Generar HTML dinámico
        albumsContainer.innerHTML = albums.map(album => `
          <div class="genre" data-album-id="${album.id}">
            <a href="/reproductor-album/${album.id}" class="album-link">
              <div class="genre-card">
                ${album.image_path ? `
                  <img src="${album.image_path}" alt="${album.title}"
                       class="genre-image"
                       onerror="this.onerror=null; this.src='{{ asset('image/images/default-album.png') }}'">
                ` : `
                  <div class="image-placeholder">
                    <i class="fas fa-compact-disc"></i>
                  </div>
                `}
                <div class="genre-card-content">
                  <h3>${album.title}</h3>
                  ${album.release_date ? `<p>${new Date(album.release_date).getFullYear()}</p>` : ''}
                </div>
              </div>
            </a>
          </div>
        `).join('');

      } catch (error) {
        console.error('Error cargando álbumes:', error);
        albumsContainer.innerHTML = `
          <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error al cargar los álbumes</p>
          </div>
        `;
      }
    });
  </script>
</body>
</html>
