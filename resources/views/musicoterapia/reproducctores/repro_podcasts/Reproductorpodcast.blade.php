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
        <div class="podcast-header">
          <h1 id="podcast-title">Podcast</h1>
        </div>

        <div class="podcast-content">
          <div class="player-container">
            <div class="audio-player">
              <audio id="audio-player" controls>
                <source id="audio-source" type="audio/mpeg">
                Tu navegador no soporta el elemento de audio.
              </audio>
            </div>

            <div class="player-controls">
              <button id="prev-button"><i class="fas fa-step-backward"></i></button>
              <button id="play-button"><i class="fas fa-play"></i></button>
              <button id="next-button"><i class="fas fa-step-forward"></i></button>
            </div>
          </div>

          <div class="episodes-container" id="episodes-list">
            <!-- Episodios se cargarán aquí -->
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
      const podcastId = window.location.pathname.split('/').pop();
      const player = document.getElementById('audio-player');
      const playButton = document.getElementById('play-button');

      // Elementos de la UI
      const uiElements = {
        title: document.getElementById('podcast-title'),
        episodesList: document.getElementById('episodes-list')
      };

      try {
        // Obtener datos del podcast
        const podcastResponse = await api.getPodcast(podcastId);
        const podcast = podcastResponse.data;

        // Obtener episodios
        const episodesResponse = await api.getPlaylistPodcasts(podcastId);
        const episodes = episodesResponse.data;

        // Actualizar UI
        uiElements.title.textContent = podcast.title;

        // Mostrar episodios
        uiElements.episodesList.innerHTML = episodes.map((episode, index) => `
          <div class="episode" data-episode-id="${episode.id}">
            <div class="episode-number">${index + 1}</div>
            <div class="episode-info">
              <h4>${episode.title}</h4>
              ${episode.description ? `<p>${episode.description}</p>` : ''}
              <div class="episode-meta">
                <span>${formatDuration(episode.duration)}</span>
                <span>${new Date(episode.created_at).toLocaleDateString()}</span>
              </div>
            </div>
            <button class="play-episode" data-src="${episode.audio_file}">
              <i class="fas fa-play"></i>
            </button>
          </div>
        `).join('');

        // Controlador de eventos para reproducir episodios
        document.querySelectorAll('.play-episode').forEach(btn => {
          btn.addEventListener('click', () => {
            const audioSrc = btn.dataset.src;
            player.src = audioSrc;
            player.play();
            playButton.innerHTML = '<i class="fas fa-pause"></i>';
          });
        });

        // Controladores del reproductor
        playButton.addEventListener('click', () => {
          if (player.paused) {
            player.play();
            playButton.innerHTML = '<i class="fas fa-pause"></i>';
          } else {
            player.pause();
            playButton.innerHTML = '<i class="fas fa-play"></i>';
          }
        });

        player.addEventListener('timeupdate', () => {
          // Actualizar barra de progreso si la tienes
        });

      } catch (error) {
        console.error('Error:', error);
        alert('Error cargando el podcast');
      }
    });

    function formatDuration(seconds) {
      const minutes = Math.floor(seconds / 60);
      const secs = seconds % 60;
      return `${minutes}:${secs.toString().padStart(2, '0')}`;
    }
  </script>

  <style>
    .podcast-content {
    padding: 2rem;
}

.audio-player {
    width: 100%;
    margin: 2rem 0;
}

.player-controls {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 1rem;
}

.player-controls button {
    font-size: 1.5rem;
    padding: 1rem 2rem;
    border: none;
    background: #59009a;
    color: white;
    border-radius: 50px;
    cursor: pointer;
}

.episodes-container {
    margin-top: 3rem;
}

.episode {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.9);
    margin-bottom: 1rem;
    border-radius: 10px;
}

.episode-number {
    font-size: 1.2rem;
    margin-right: 1rem;
    color: #59009a;
}

.play-episode {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
}
  </style>
<body>
</html>
