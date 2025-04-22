<!DOCTYPE html>
<html lang="esp">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <!-- Estilos -->
 <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/PRINCIPAL_GENEROS/style.css') }}">
  <title>tranquilidad</title>sicoterapia/Header/style.css">

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
      <br /><br /><br>
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
          <span>Géneros</span>
        </div>
        <br>
        <div class="genres" id="genres-container">
          <!-- Géneros se cargarán aquí dinámicamente -->
        </div>
      </main>


  </div>
  <br><br><br><br>


  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const api = new API();
      const genresContainer = document.getElementById('genres-container');

      try {
        // Obtener géneros desde la API
        const { data: genres } = await api.getAllGenres();

        // Generar HTML dinámico
        genresContainer.innerHTML = genres.map(genre => `
          <div class="genre" data-genre-id="${genre.id}">
            <a href="/reproductor-genero/${genre.id}" class="genre-link">
              <div class="genre-card">
                ${genre.image_path ? `
                  <img src="${genre.image_path}" alt="${genre.name}"
                       class="genre-image"
                       onerror="this.onerror=null; this.src='{{ asset('image/images/default-genre.png') }}'">
                ` : `
                  <div class="image-placeholder">
                    <i class="fas fa-music"></i>
                  </div>
                `}
                <div class="genre-card-content">
                  <h3>${genre.name}</h3>
                  ${genre.description ? `<p>${genre.description}</p>` : ''}
                </div>
              </div>
            </a>
          </div>
        `).join('');

      } catch (error) {
        console.error('Error cargando géneros:', error);
        genresContainer.innerHTML = `
          <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error al cargar los géneros</p>
          </div>
        `;
      }
    });
  </script>
</body>

</html>
