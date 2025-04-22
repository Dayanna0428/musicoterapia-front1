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
          <span>Podcast</span>
        </div>

        <div class="podcasts-container" id="podcasts-container">
          <div class="loading">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Cargando podcasts...</p>
          </div>
        </div>
      </main>
  </div>

  <br><br><br><br>

  {{-- Footer --}}
  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const api = new API();
      const container = document.getElementById('podcasts-container');
      const defaultImage = "{{ asset('image/images/default-podcast.png') }}";

      try {
        const response = await api.getAllPodcasts();
        const podcasts = response.data;

        if (podcasts.length === 0) {
          container.innerHTML = '<p class="empty">No se encontraron podcasts</p>';
          return;
        }

        container.innerHTML = `
          <div class="podcasts-grid">
            ${podcasts.map(podcast => `
              <a href="/podcast/${podcast.id}" class="podcast-card">
                <div class="podcast-image">
                  <img src="${podcast.image_url || defaultImage}"
                       alt="${podcast.title}"
                       onerror="this.src='${defaultImage}'">
                </div>
                <div class="podcast-info">
                  <h3>${podcast.title}</h3>
                  ${podcast.description ? `<p>${podcast.description}</p>` : ''}
                  <div class="podcast-meta">
                    <span><i class="fas fa-headphones"></i> ${podcast.episodes_count} episodios</span>
                    <span><i class="fas fa-clock"></i> ${podcast.duration} min</span>
                  </div>
                </div>
              </a>
            `).join('')}
          </div>
        `;

      } catch (error) {
        console.error('Error:', error);
        container.innerHTML = `
          <div class="error">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error cargando podcasts</p>
          </div>
        `;
      }
    });
  </script>

<style>
    .podcasts-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 columnas en cada fila */
  gap: 1.5rem; /* Espacio entre los elementos */
  padding: 1.5rem;
}

@media (max-width: 1200px) {
  .podcasts-grid {
    grid-template-columns: repeat(3, 1fr); /* 3 columnas en pantallas más pequeñas */
  }
}

@media (max-width: 900px) {
  .podcasts-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 columnas en pantallas más pequeñas */
  }
}

@media (max-width: 600px) {
  .podcasts-grid {
    grid-template-columns: 1fr; /* 1 columna en pantallas muy pequeñas */
  }
}

    .podcast-card {
      display: flex;
      flex-direction: column;
      background-color: #ffffffcc;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-decoration: none;
      color: #333;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      max-width: 220px;
      margin: auto;
    }

    .podcast-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .podcast-image img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-bottom: 1px solid #ddd;
    }

    .podcast-info {
      padding: 0.8rem;
    }

    .podcast-info h3 {
      margin: 0 0 0.5rem;
      font-size: 1.1rem;
      color: #4a3c8c;
    }

    .podcast-info p {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 0.6rem;
    }

    .podcast-meta {
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
      color: #777;
    }

    .podcast-meta i {
      margin-right: 5px;
    }
  </style>


</body>

</html>
