<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Estilos -->
 <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
 <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/REPRO_PODCAST\MOTIVACION/style.css') }}">

 <style>
    /* Nuevos estilos para video */
    .video-container {
        width: 80%;
        max-width: 800px;
        margin: 2rem auto;
        background: #000;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    .episode-video {
        width: 100%;
        height: auto;
        aspect-ratio: 16/9;
    }

    .episodes-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
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
        <div class="podcast-header">
            <h1 id="podcast-title">Podcast</h1>
        </div>

        <div class="podcast-content">
            <div class="episodes-container" id="episodes-list">
                <div class="loading-message">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Cargando podcast...</p>
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

    <script src="{{ asset('js/api.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const api = new API();
            const episodesList = document.getElementById('episodes-list');
            const podcastTitle = document.getElementById('podcast-title');

            // Obtener el ID del podcast de la URL
            const podcastId = window.location.pathname.split('/').pop();

            try {
                // Obtener el podcast específico
                const response = await api.getPodcast(podcastId);
                const podcast = response.data;

                // Actualizar el título
                podcastTitle.textContent = podcast.title;

                // Mostrar solo este podcast
                episodesList.innerHTML = `
                    <div class="video-container">
                        <video class="episode-video" controls poster="${podcast.image_file || ''}">
                            <source src="${podcast.video_file}" type="video/mp4">
                            Tu navegador no soporta videos HTML5
                        </video>
                        <div class="video-info">
                            <h3>${podcast.title}</h3>
                            ${podcast.description ? `<p>${podcast.description}</p>` : ''}
                            <div class="video-meta">
                                <span>Duración: ${formatDuration(podcast.duration)}</span>
                                <span>Publicado: ${new Date(podcast.created_at).toLocaleDateString()}</span>
                            </div>
                        </div>
                    </div>
                `;

            } catch (error) {
                console.error('Error:', error);
                episodesList.innerHTML = `
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Error cargando el podcast</p>
                        <p>${error.message || ''}</p>
                    </div>`;
            }
        });

        function formatDuration(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${minutes}:${secs.toString().padStart(2, '0')}`;
        }
    </script>

    <style>
        /* Estilos mejorados para el reproductor individual */
        .video-container {
            width: 90%;
            max-width: 1000px;
            margin: 2rem auto;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .episode-video {
            width: 100%;
            height: auto;
            min-height: 500px;
            background: #000;
        }

        .video-info {
            /* padding: 1.5rem; */
            background: linear-gradient(to right, #2c0059, #4a0080);
            color: white;
        }

        .video-info h3 {
            margin: 0 0 1rem 0;
            font-size: 1.5rem;
            color: #fff;
        }

        .video-info p {
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .video-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #ddd;
        }

        .video-meta span:first-child {
            color: #ff9f00;
        }

        @media (max-width: 768px) {
            .video-container {
                width: 95%;
            }

            .episode-video {
                min-height: 300px;
            }

            .video-info {
                padding: 1rem;
            }

            .video-info h3 {
                font-size: 1.2rem;
            }
        }
    </style>
<body>
</html>
