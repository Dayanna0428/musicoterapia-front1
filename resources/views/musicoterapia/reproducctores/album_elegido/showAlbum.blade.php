<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/ALBUM_ELEGIDO/style.css') }}">
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
                      if (file.includes("header.html")) {
                          const script = document.createElement("script");
                          script.src = "/rutinas-de-ejercicios/includes/Header/script.js";
                          document.body.appendChild(script);
                      }
                  }
              } catch (error) {
                  console.error('Error loading included HTML:', error);
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
      <div class="title"><span></span></div>
      <div class="tabs">
        <div class="black"></div>
        <div class="purple">
          <h1 id="titulo-album">Álbum</h1>
        </div>
      </div>
      <br>
      <div class="content">
        <!-- Reproductor completo -->
        <div class="player">
            <div class="album-cover">
              <img id="album-image" src="/musicoterapia/Vistas1.1/images/El-piano.jpg" alt="" />
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
              <button id="prev-btn">◀◀</button>
              <button id="play-pause-btn">▶</button>
              <button id="next-btn">▶▶</button>
            </div>
            <div class="actions">
              <div><span class="me-gusta">❤</span></div>
              <button class="dropdown-button">⋮</button>
              <div id="dropdown" class="dropdown">
                <!-- Only playlists will be shown here -->
              </div>
              <div id="create-playlist-form" class="playlist-form" style="display: none;">
                <input type="text" id="playlist-name" placeholder="Nombre de la playlist">
                <input type="text" id="playlist-description" placeholder="Descripción de la playlist">
                <button id="create-playlist-btn">Aceptar</button> <!-- Removed inline onclick -->
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

        <!-- Lista de pistas -->
        <div class="tracks-container" id="tracks-list"></div>
      </div>
      <audio id="audio"></audio>
    </main>
  </div>

  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      // Verificar elementos críticos
      const requiredElements = {
        albumTitle: document.getElementById('titulo-album'),
        albumImage: document.getElementById('album-image'),
        audioTitle: document.getElementById('audio-title'),
        audioArtist: document.getElementById('audio-artist'),
        progressBar: document.getElementById('progress-bar'),
        currentTime: document.getElementById('current-time'),
        totalDuration: document.getElementById('total-duration'),
        playPauseBtn: document.getElementById('play-pause-btn'),
        audioElement: document.getElementById('audio')
      };

      // Validar elementos esenciales
      for (const [key, element] of Object.entries(requiredElements)) {
        if (!element) {
          console.error(`Elemento crítico no encontrado: ${key}`);
          return;
        }
      }

      const api = new API();
      const albumId = window.location.pathname.split('/').pop();
      let currentTrackIndex = 0;
      let tracks = [];

      try {
        // Cargar datos del álbum
        const albumResponse = await api.getAlbum(albumId);
        const album = albumResponse.data;
        requiredElements.albumTitle.textContent = album.title;
        requiredElements.albumImage.src = album.image_path || '{{ asset("image/images/default-album.png") }}';

        // Cargar pistas del álbum
        const audioResponse = await api.getAllAudios();
        tracks = audioResponse.data.filter(audio => audio.album_id == albumId);

        if (tracks.length === 0) {
          document.getElementById('tracks-list').innerHTML = `
            <div class="empty-message">
              <i class="fas fa-music"></i>
              <p>No hay pistas en este álbum</p>
            </div>`;
          return;
        }

        // Renderizar pistas
        const tracksHTML = tracks.map((track, index) => `
          <div class="track" data-index="${index}">
            <div class="track-info">
              <span class="track-title">${track.title}</span>
              <span class="track-artist">${track.artist || 'Artista desconocido'}</span>
            </div>
            <div class="track-duration">${formatDuration(track.duration)}</div>
            <button class="play-btn" data-src="${track.audio_file}">
              <i class="fas fa-play"></i>
            </button>
          </div>
        `).join('');

        document.getElementById('tracks-list').innerHTML = tracksHTML;

        // Configurar eventos del reproductor
        setupPlayerControls();
        setupTrackClicks();

      } catch (error) {
        console.error('Error:', error);
        document.getElementById('tracks-list').innerHTML = `
          <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error cargando el álbum</p>
          </div>`;
      }

      function formatDuration(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins}:${secs.toString().padStart(2, '0')}`;
      }

      function setupPlayerControls() {
        // Botón Play/Pause
        requiredElements.playPauseBtn.addEventListener('click', () => {
          if (requiredElements.audioElement.paused) {
            requiredElements.audioElement.play();
            requiredElements.playPauseBtn.textContent = '⏸';
          } else {
            requiredElements.audioElement.pause();
            requiredElements.playPauseBtn.textContent = '▶';
          }
        });

        // Barra de progreso
        requiredElements.audioElement.addEventListener('timeupdate', () => {
          const progress = (requiredElements.audioElement.currentTime / requiredElements.audioElement.duration) * 100;
          requiredElements.progressBar.value = progress;
          requiredElements.currentTime.textContent =
            formatTime(requiredElements.audioElement.currentTime);
        });

        requiredElements.progressBar.addEventListener('input', (e) => {
          const time = (e.target.value / 100) * requiredElements.audioElement.duration;
          requiredElements.audioElement.currentTime = time;
        });
      }

      function setupTrackClicks() {
        document.querySelectorAll('.play-btn').forEach((btn, index) => {
          btn.addEventListener('click', () => {
            currentTrackIndex = index;
            loadTrack(tracks[index]);
          });
        });
      }

      function loadTrack(track) {
        requiredElements.audioElement.src = track.audio_file;
        requiredElements.audioTitle.textContent = track.title;
        requiredElements.audioArtist.textContent = track.artist || 'Artista desconocido';
        requiredElements.audioElement.play();
        requiredElements.playPauseBtn.textContent = '⏸';
      }

      function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
      }
    });
  </script>
</body>
</html>
