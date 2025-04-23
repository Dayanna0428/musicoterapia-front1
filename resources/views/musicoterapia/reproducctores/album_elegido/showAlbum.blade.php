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

        /* Estilos mejorados para el dropdown */
        .dropdown {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            border-radius: 8px;
            padding: 8px 0;
            right: 10px;
        }

        .dropdown.show {
            display: block;
        }

        .dropdown-content {
            padding: 10px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-content:hover {
            background-color: #f5f5f5;
        }

        .dropdown-content i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Estilos para el dropdown de playlists */
        .playlists-dropdown {
            max-height: 300px;
            overflow-y: auto;
            display: none;
            background-color: #f9f9f9;
        }

        .playlists-dropdown.show {
            display: block;
        }

        .playlist-option {
            padding: 8px 16px 8px 32px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .playlist-option:hover {
            background-color: #f0f0f0;
        }

        .playlist-option i {
            margin-right: 8px;
        }

        .create-playlist-option {
            color: #59009a;
            font-weight: bold;
            border-top: 1px solid #eee;
            margin-top: 5px;
            padding-top: 10px;
        }

        .dropdown-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #333;
            padding: 5px 10px;
        }

        .actions {
            position: relative;
        }

        .loading-playlists {
            padding: 10px;
            text-align: center;
            color: #666;
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
                    <div class="dropdown-content" onclick="showAddToPlaylist()">
                        <i class="fas fa-plus"></i> Añadir a playlist
                    </div>
                    <div class="dropdown-content" onclick="showHorizontalList()">
                        <i class="fas fa-share-alt"></i> Compartir
                    </div>
                    <div id="playlists-dropdown" class="playlists-dropdown">
                        <!-- Las playlists se cargarán aquí dinámicamente -->
                    </div>
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
      // Elementos del DOM
      const elements = {
        albumTitle: document.getElementById('titulo-album'),
        albumImage: document.getElementById('album-image'),
        audioTitle: document.getElementById('audio-title'),
        audioArtist: document.getElementById('audio-artist'),
        progressBar: document.getElementById('progress-bar'),
        currentTime: document.getElementById('current-time'),
        totalDuration: document.getElementById('total-duration'),
        playPauseBtn: document.getElementById('play-pause-btn'),
        audioElement: document.getElementById('audio'),
        dropdown: document.getElementById('dropdown'),
        playlistsDropdown: document.getElementById('playlists-dropdown'),
        dropdownButton: document.querySelector('.dropdown-button'),
        horizontalList: document.getElementById('horizontal-list'),
        tracksList: document.getElementById('tracks-list')
      };

      // Variables de estado
      const api = new API();
      const albumId = window.location.pathname.split('/').pop();
      let currentTrackIndex = 0;
      let tracks = [];
      let currentAudio = null;

      // Inicialización
      init();

      async function init() {
        try {
          // Cargar datos del álbum
          const albumResponse = await api.getAlbum(albumId);
          const album = albumResponse.data;
          elements.albumTitle.textContent = album.title;
          elements.albumImage.src = album.image_path || '{{ asset("image/images/default-album.png") }}';

          // Cargar pistas del álbum
          const audioResponse = await api.getAllAudios();
          tracks = audioResponse.data.filter(audio => audio.album_id == albumId);

          if (tracks.length === 0) {
            elements.tracksList.innerHTML = `
              <div class="empty-message">
                <i class="fas fa-music"></i>
                <p>No hay pistas en este álbum</p>
              </div>`;
            return;
          }

          // Renderizar pistas
          renderTracks();

          // Configurar eventos
          setupEventListeners();

        } catch (error) {
          console.error('Error:', error);
          elements.tracksList.innerHTML = `
            <div class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              <p>Error cargando el álbum</p>
            </div>`;
        }
      }

      function renderTracks() {
        elements.tracksList.innerHTML = tracks.map((track, index) => `
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

      function setupEventListeners() {
        // Eventos del reproductor
        elements.playPauseBtn.addEventListener('click', togglePlay);
        elements.audioElement.addEventListener('timeupdate', updateProgress);
        elements.progressBar.addEventListener('input', seek);

        // Eventos de las pistas
        document.querySelectorAll('.play-btn').forEach((btn, index) => {
          btn.addEventListener('click', () => {
            currentTrackIndex = index;
            loadTrack(tracks[index]);
          });
        });

        // Eventos del dropdown
        elements.dropdownButton.addEventListener('click', toggleMainDropdown);
        document.addEventListener('click', handleDocumentClick);
      }

      // Funciones del reproductor
      function togglePlay() {
        if (elements.audioElement.paused) {
          if (!elements.audioElement.src && tracks.length > 0) {
            loadTrack(tracks[0]);
          } else {
            elements.audioElement.play();
          }
          elements.playPauseBtn.textContent = '⏸';
        } else {
          elements.audioElement.pause();
          elements.playPauseBtn.textContent = '▶';
        }
      }

      function loadTrack(track) {
        currentAudio = track;
        elements.audioElement.src = track.audio_file;
        elements.audioTitle.textContent = track.title;
        elements.audioArtist.textContent = track.artist || 'Artista desconocido';
        elements.audioElement.play();
        elements.playPauseBtn.textContent = '⏸';

        // Resaltar la pista actual
        document.querySelectorAll('.track').forEach((t, i) => {
          t.classList.toggle('active', i === currentTrackIndex);
          const playBtn = t.querySelector('.play-btn');
          if (playBtn) {
            playBtn.innerHTML = i === currentTrackIndex ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
          }
        });
      }

      function updateProgress() {
        const progress = (elements.audioElement.currentTime / elements.audioElement.duration) * 100;
        elements.progressBar.value = progress;
        elements.currentTime.textContent = formatTime(elements.audioElement.currentTime);
      }

      function seek(e) {
        const time = (e.target.value / 100) * elements.audioElement.duration;
        elements.audioElement.currentTime = time;
      }

      // Funciones del dropdown
      function toggleMainDropdown(e) {
        e.stopPropagation();
        elements.dropdown.classList.toggle('show');
        elements.playlistsDropdown.classList.remove('show');
        elements.horizontalList.style.display = 'none';
      }

      function handleDocumentClick(e) {
        if (!e.target.closest('.dropdown') && !e.target.classList.contains('dropdown-button')) {
          elements.dropdown.classList.remove('show');
          elements.playlistsDropdown.classList.remove('show');
          elements.horizontalList.style.display = 'none';
        }
      }

      // Funciones globales para playlists
      window.showAddToPlaylist = async function() {
        try {
          elements.playlistsDropdown.innerHTML = `
            <div class="loading-playlists">
              <i class="fas fa-spinner fa-spin"></i> Cargando playlists...
            </div>`;

          const response = await api.getUserPlaylists();
          const playlists = response.data;

          if (playlists.length === 0) {
            elements.playlistsDropdown.innerHTML = `
              <div class="playlist-option create-playlist-option" onclick="createNewPlaylist()">
                <i class="fas fa-plus-circle"></i> Crear nueva playlist
              </div>`;
          } else {
            elements.playlistsDropdown.innerHTML = playlists.map(playlist => `
              <div class="playlist-option" onclick="addToPlaylist('${playlist.id}')">
                <i class="fas fa-music"></i> ${playlist.name}
              </div>
            `).join('') + `
              <div class="playlist-option create-playlist-option" onclick="createNewPlaylist()">
                <i class="fas fa-plus-circle"></i> Crear nueva playlist
              </div>`;
          }

          elements.playlistsDropdown.classList.add('show');
        } catch (error) {
          console.error('Error cargando playlists:', error);
          alert('Error al cargar playlists');
        }
      };

      window.addToPlaylist = async function(playlistId) {
        if (!currentAudio) {
          alert('Selecciona un audio primero');
          return;
        }

        try {
          await api.addAudioToPlaylist(playlistId, currentAudio.id);
          alert('Audio añadido a la playlist');
          elements.playlistsDropdown.classList.remove('show');
          elements.dropdown.classList.remove('show');
        } catch (error) {
          console.error('Error añadiendo a playlist:', error);
          alert('Error al añadir a playlist: ' + (error.message || ''));
        }
      };

      window.createNewPlaylist = async function() {
        const name = prompt('Nombre de la nueva playlist:');
        if (!name) return;

        const description = prompt('Descripción (opcional):') || '';

        try {
          await api.createPlaylist({ name, description });
          alert('Playlist creada! Ahora puedes añadir el audio');
          showAddToPlaylist(); // Recargar la lista
        } catch (error) {
          console.error('Error creando playlist:', error);
          alert('Error al crear playlist: ' + (error.message || ''));
        }
      };

      window.showHorizontalList = function() {
        elements.horizontalList.style.display = 'flex';
        elements.dropdown.classList.remove('show');
      };

      window.copyLink = function() {
        navigator.clipboard.writeText(window.location.href)
          .then(() => alert('Enlace copiado al portapapeles'))
          .catch(err => console.error('Error al copiar:', err));
      };

      // Funciones de utilidad
      function formatDuration(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
      }

      function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
      }
    });
  </script>

<style>
    .me-gusta {
    cursor: pointer;
    font-size: 1.5rem;
    color: #000000;
    transition: all 0.3s ease;
    margin-right: 15px;
}

.me-gusta.active {
    color: #59009A;
}

.me-gusta:hover {
    transform: scale(1.1);
}
</style>
</body>
</html>
