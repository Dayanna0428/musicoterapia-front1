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

    <main class="main-content" style="max-width: 1200px; margin: 0 auto;">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>

        <div class="title">
          <span>Buscar Audios</span>
        </div>

        <div class="image-container">
            <img id="carousel-image"  src="{{ asset('image/images/GENERO CARRUSEL 1.png') }}" alt="Carrusel de géneros" />
            <img id="carousel-image"  src="{{ asset('image/images/ALBUM CARRUSEL.png') }}" alt="Carrusel albums" />
          </div>

        <div class="search-bar">
          <input type="text" id="search-input" placeholder="Buscar por título o palabra clave..." />
          <button id="search-button"><i class="fas fa-search"></i></button>
        </div>

        <div class="search-results" id="search-results">
          <!-- Resultados de búsqueda aparecerán aquí -->
        </div>
      </main>

  </div>

  <br><br><br><br>

  {{-- Footer --}}
  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const api = new API();
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const resultsContainer = document.getElementById('search-results');

    async function buscarAudios() {
      const query = searchInput.value.trim().toLowerCase();
      if (!query) {
        resultsContainer.innerHTML = '<p>Ingresa un término para buscar.</p>';
        return;
      }

      try {
        const response = await api.getAllAudios();

        if (!response.data || !Array.isArray(response.data)) {
          throw new Error('Error de formato en los datos de la API');
        }

        const audios = response.data.filter(audio =>
          audio.title?.toLowerCase().includes(query) ||
          audio.description?.toLowerCase().includes(query)
        );

        if (audios.length === 0) {
          resultsContainer.innerHTML = '<p>No se encontraron resultados.</p>';
          return;
        }

        resultsContainer.innerHTML = audios.map(audio => `
          <div class="audio-card">
            <h3>${audio.title}</h3>
            ${audio.description ? `<p>${audio.description}</p>` : ''}
            <p><strong>Duración:</strong> ${formatDuration(audio.duration)}</p>
            ${audio.frecuencia ? `<p><strong>Frecuencia:</strong> ${audio.frecuencia}Hz</p>` : ''}
            <button onclick="window.location.href='/reproductor-binaural/${audio.id}'">
              Reproducir
            </button>
          </div>
        `).join('');
      } catch (error) {
        resultsContainer.innerHTML = `<p class="error">Error al buscar audios: ${error.message}</p>`;
      }
    }

    function formatDuration(seconds) {
      const minutes = Math.floor(seconds / 60);
      const secs = seconds % 60;
      return `${minutes}:${secs.toString().padStart(2, '0')}`;
    }

    searchButton.addEventListener('click', buscarAudios);
    searchInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') buscarAudios();
    });
  });
</script>
<style>
    .search-bar {
  display: flex;
  gap: 10px;
  margin: 20px 0;
}

.search-bar input {
  flex: 1;
  padding: 10px;
  font-size: 16px;
  border-radius: 10px;
  border: 1px solid #ccc;
}

.search-bar button {
  padding: 10px 20px;
  border: none;
  background-color: #6a5acd;
  color: white;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
}

.audio-card {
  background: white;
  padding: 20px;
  border-radius: 15px;
  margin-bottom: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.audio-card button {
  align-self: flex-end; /* Alinea el botón a la derecha */
  padding: 12px 25px;
  border: none;
  background: linear-gradient(45deg, #6a5acd, #8360c3); /* Degradado atractivo */
  color: white;
  border-radius: 25px;
  cursor: pointer;
  font-size: 18px;
  transition: background 0.3s, transform 0.2s;
}

.audio-card button:hover {
  background: linear-gradient(45deg, #8360c3, #6a5acd); /* Cambio de color en hover */
  transform: scale(1.05); /* Efecto de zoom */
}

.audio-card button:focus {
  outline: none;
}

</style>
</body>

</html>










