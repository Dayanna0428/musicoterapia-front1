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
    <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/GENERO_ELEGIDO/CLASICA/style.css') }}">
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
      <div class="title"><span></span></div>
      <div class="tabs">
        <div class="black" onclick="window.location.href='#pistas'"></div>
        <div class="purple">
          <h1 id="titulo-genero">Genero Clasica</h1>
        </div>
      </div>
      <br>
      <div class="content">
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
        <div class="tracks-container" id="tracks-list"></div>
      </div>
      <audio id="audio"></audio>
    </main>
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
      const genreId = window.location.pathname.split('/').pop();
      const audioPlayer = document.getElementById('audio');
      let currentAudio = null;

      // Elementos de la UI
      const uiElements = {
        genreTitle: document.getElementById('titulo-genero'),
        albumImage: document.getElementById('album-image'),
        tracksList: document.getElementById('tracks-list'),
        audioTitle: document.getElementById('audio-title'),
        audioArtist: document.getElementById('audio-artist'),
        progressBar: document.getElementById('progress-bar'),
        currentTime: document.getElementById('current-time'),
        totalDuration: document.getElementById('total-duration'),
        playPauseBtn: document.getElementById('play-pause-btn')
      };

      // Mostrar estado de carga
      uiElements.tracksList.innerHTML = `
        <div class="loading-message">
          <i class="fas fa-compact-disc fa-spin"></i>
          <p>Cargando pistas...</p>
        </div>
      `;

      try {
        // Obtener datos del género
        const genreResponse = await api.getGenre(genreId);
        const genre = genreResponse.data;

        // Actualizar UI con datos del género
        uiElements.genreTitle.textContent = genre.name;
        uiElements.albumImage.src = genre.image_path || '{{ asset("image/images/default-genre.png") }}';

        // Obtener audios del género
        const audioResponse = await api.getAllAudios();
        const genreAudios = audioResponse.data.filter(audio => audio.genre_id == genreId);

        if (genreAudios.length === 0) {
          uiElements.tracksList.innerHTML = `
            <div class="empty-message">
              <i class="fas fa-music"></i>
              <p>No hay pistas disponibles en este género</p>
            </div>
          `;
          return;
        }

        // Renderizar pistas
        uiElements.tracksList.innerHTML = genreAudios.map(audio => `
          <div class="track" data-audio-id="${audio.id}">
            <div class="track-info">
              <span class="track-title">${audio.title}</span>
              <span class="track-artist">${audio.artist || 'Artista desconocido'}</span>
            </div>
            <div class="track-duration">${formatDuration(audio.duration)}</div>
            <button class="play-btn" data-src="${audio.audio_file}" data-title="${audio.title}" data-artist="${audio.artist || ''}">
              <i class="fas fa-play"></i>
            </button>
          </div>
        `).join('');

        // Configurar reproductor
        setupPlayer();

      } catch (error) {
        console.error('Error:', error);
        uiElements.tracksList.innerHTML = `
          <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error cargando el contenido del género</p>
          </div>
        `;
      }

      function formatDuration(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
      }

      function setupPlayer() {
        // Controladores de eventos para los botones de reproducción
        document.querySelectorAll('.play-btn').forEach(btn => {
          btn.addEventListener('click', () => {
            const audioSrc = btn.dataset.src;
            const isCurrentAudio = audioSrc === currentAudio;

            if (!isCurrentAudio) {
              currentAudio = audioSrc;
              audioPlayer.src = audioSrc;
              audioPlayer.play();
              uiElements.audioTitle.textContent = btn.dataset.title;
              uiElements.audioArtist.textContent = btn.dataset.artist || 'Artista desconocido';
            }

            audioPlayer.paused ? audioPlayer.play() : audioPlayer.pause();
            updatePlayButtonStates(btn);
          });
        });

        // Actualizar barra de progreso
        audioPlayer.addEventListener('timeupdate', () => {
          const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
          uiElements.progressBar.value = progress;
          uiElements.currentTime.textContent = formatTime(audioPlayer.currentTime);
        });

        // Actualizar duración total
        audioPlayer.addEventListener('loadedmetadata', () => {
          uiElements.totalDuration.textContent = formatTime(audioPlayer.duration);
        });

        // Control del botón de progreso
        uiElements.progressBar.addEventListener('input', (e) => {
          const time = (e.target.value / 100) * audioPlayer.duration;
          audioPlayer.currentTime = time;
        });

        // Control del botón play/pause
        uiElements.playPauseBtn.addEventListener('click', () => {
          audioPlayer.paused ? audioPlayer.play() : audioPlayer.pause();
        });
      }

      function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
      }

      function updatePlayButtonStates(activeBtn) {
        document.querySelectorAll('.play-btn').forEach(btn => {
          btn.classList.remove('active');
          btn.innerHTML = '<i class="fas fa-play"></i>';
        });

        if (activeBtn) {
          activeBtn.classList.add('active');
          activeBtn.innerHTML = audioPlayer.paused ?
            '<i class="fas fa-play"></i>' :
            '<i class="fas fa-pause"></i>';
        }
      }
    });
  </script>
</body>

</html>
