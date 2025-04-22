<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/GENERO_ELEGIDO/CLASICA/style.css') }}">

  <style>
    body {
      background-image:
        linear-gradient(rgba(240, 230, 255, 0.8), rgba(240, 230, 255, 0.8)),
        url('{{ asset('image/imagenes/fondo_principal1abastrato.png') }}');
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
  </style>

  <title>Tranquilidad - Playlist</title>
</head>

<body>
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

    <main class="main">
      <div class="title"><span></span></div>
      <div class="tabs">
        <div class="black"></div>
        <div class="purple">
          <h1 id="playlist-title">Playlist</h1>
        </div>
      </div>
      <br>
      <div class="content">
        <div class="player">
          <div class="album-cover">
            <img id="playlist-image" src="{{ asset('image/images/default_playlist.jpg') }}" alt="" />
            <div class="playhead"></div>
          </div>
          <div>
            <h2 id="audio-title" style="margin: 0">Selecciona una canción</h2>
            <p id="audio-artist">Artista</p>
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
              <div class="dropdown-content" onclick="window.location.href='/me-gusta'">Agregar a favoritos</div>
              <div class="dropdown-content" onclick="showHorizontalList()">Compartir</div>
            </div>
          </div>
          <div id="horizontal-list" class="horizontal-list">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" />
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" />
            <button onclick="copyLink()">Copiar Link</button>
          </div>
        </div>
        <div class="tracks-container" id="tracks-list">
          <div class="loading-message">
            <i class="fas fa-compact-disc fa-spin"></i>
            <p>Cargando pistas...</p>
          </div>
        </div>
      </div>
      <audio id="audio-player"></audio>
    </main>
  </div>

  <br><br><br>
  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const api = new API();
      const playlistId = window.location.pathname.split('/').pop();
      const audioPlayer = document.getElementById('audio-player');
      let currentTrackIndex = -1;
      let tracks = [];
      let isPlaying = false;

      // Elementos de la UI
      const uiElements = {
        playlistTitle: document.getElementById('playlist-title'),
        playlistImage: document.getElementById('playlist-image'),
        tracksList: document.getElementById('tracks-list'),
        audioTitle: document.getElementById('audio-title'),
        audioArtist: document.getElementById('audio-artist'),
        progressBar: document.getElementById('progress-bar'),
        currentTime: document.getElementById('current-time'),
        totalDuration: document.getElementById('total-duration'),
        playPauseBtn: document.getElementById('play-pause-btn'),
        prevBtn: document.getElementById('prev-btn'),
        nextBtn: document.getElementById('next-btn'),
        likeBtn: document.querySelector('.me-gusta'),
        dropdown: document.getElementById('dropdown'),
        horizontalList: document.getElementById('horizontal-list')
      };

      // Cargar datos de la playlist
      try {
        const playlistResponse = await api.getPlaylist(playlistId);
        const playlist = playlistResponse.data;

        // Actualizar información de la playlist
        uiElements.playlistTitle.textContent = playlist.name;
        uiElements.playlistImage.src = playlist.image_url || '{{ asset('image/images/default_playlist.jpg') }}';

        // Obtener audios de la playlist
        const audiosResponse = await api.getPlaylistAudios(playlistId);
        tracks = audiosResponse.data;

        if (tracks.length === 0) {
          uiElements.tracksList.innerHTML = `
            <div class="empty-message">
              <i class="fas fa-music"></i>
              <p>No hay pistas en esta playlist</p>
            </div>
          `;
          return;
        }

        // Mostrar las canciones
        renderTracks();

        // Configurar eventos del reproductor
        setupPlayer();

      } catch (error) {
        console.error('Error cargando playlist:', error);
        uiElements.tracksList.innerHTML = `
          <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Error cargando la playlist</p>
          </div>
        `;
      }

      function renderTracks() {
        uiElements.tracksList.innerHTML = tracks.map((track, index) => `
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
      }

      function formatDuration(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs.toString().padStart(2, '0')}`;
      }

      function setupPlayer() {
        // Evento para reproducir una canción
        document.querySelectorAll('.track').forEach(track => {
          track.addEventListener('click', (e) => {
            if (e.target.classList.contains('play-btn') || e.target.closest('.play-btn')) {
              const index = parseInt(track.dataset.index);
              playTrack(index);
            }
          });
        });

        // Eventos del reproductor de audio
        audioPlayer.addEventListener('timeupdate', updateProgress);
        audioPlayer.addEventListener('ended', playNext);
        audioPlayer.addEventListener('loadedmetadata', updateDuration);

        // Controles del reproductor
        uiElements.playPauseBtn.addEventListener('click', togglePlay);
        uiElements.prevBtn.addEventListener('click', playPrevious);
        uiElements.nextBtn.addEventListener('click', playNext);
        uiElements.progressBar.addEventListener('input', seek);

        // Botón de like
        uiElements.likeBtn.addEventListener('click', toggleLike);

        // Dropdown menu
        document.querySelector('.dropdown-button').addEventListener('click', toggleDropdown);
      }

      function playTrack(index) {
        if (index < 0 || index >= tracks.length) return;

        currentTrackIndex = index;
        const track = tracks[index];

        audioPlayer.src = track.audio_file;
        audioPlayer.play();
        isPlaying = true;

        // Actualizar UI
        uiElements.audioTitle.textContent = track.title;
        uiElements.audioArtist.textContent = track.artist || 'Artista desconocido';
        uiElements.playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';

        // Resaltar la canción que se está reproduciendo
        document.querySelectorAll('.track').forEach((t, i) => {
          t.classList.toggle('active', i === index);
          const playBtn = t.querySelector('.play-btn');
          if (playBtn) {
            playBtn.innerHTML = i === index ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
          }
        });
      }

      function togglePlay() {
        if (audioPlayer.paused) {
          if (audioPlayer.src) {
            audioPlayer.play();
          } else if (tracks.length > 0) {
            playTrack(0);
          }
          isPlaying = true;
          uiElements.playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
        } else {
          audioPlayer.pause();
          isPlaying = false;
          uiElements.playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
        }
      }

      function playNext() {
        if (tracks.length === 0) return;
        const nextIndex = (currentTrackIndex + 1) % tracks.length;
        playTrack(nextIndex);
      }

      function playPrevious() {
        if (tracks.length === 0) return;
        const prevIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
        playTrack(prevIndex);
      }

      function updateProgress() {
        const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        uiElements.progressBar.value = progressPercent;
        uiElements.currentTime.textContent = formatDuration(audioPlayer.currentTime);
      }

      function updateDuration() {
        uiElements.totalDuration.textContent = formatDuration(audioPlayer.duration);
      }

      function seek() {
        const seekTime = (uiElements.progressBar.value / 100) * audioPlayer.duration;
        audioPlayer.currentTime = seekTime;
      }

      function toggleLike() {
        uiElements.likeBtn.classList.toggle('active');
      }

      function toggleDropdown() {
        uiElements.dropdown.classList.toggle('show');
        uiElements.horizontalList.style.display = 'none';
      }

      function showHorizontalList() {
        uiElements.horizontalList.style.display = 'flex';
        uiElements.dropdown.classList.remove('show');
      }

      function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
          alert('Enlace copiado al portapapeles');
        });
      }
    });
  </script>

  <style>
    /* Estilos para el dropdown */
.dropdown {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 5px;
}

.dropdown.show {
  display: block;
}

.dropdown-content {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  cursor: pointer;
}

.dropdown-content:hover {
  background-color: #f1f1f1;
}

/* Estilos para la lista horizontal de compartir */
.horizontal-list {
  display: none;
  position: absolute;
  background-color: white;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  gap: 10px;
  align-items: center;
}

.horizontal-list img {
  width: 30px;
  height: 30px;
  cursor: pointer;
}

.horizontal-list button {
  background: #59009a;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

/* Estilo para el botón de like activo */
.me-gusta.active {
  color: red;
}

/* Estilo para la pista activa */
.track.active {
  background-color: rgba(89, 0, 154, 0.1);
  border-left: 3px solid #59009a;
}
  </style>
</body>
</html>
