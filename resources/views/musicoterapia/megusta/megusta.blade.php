{{-- tranquilidad.blade.php --}}
<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/megusta/style.css') }}">
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
                      // Cargar el JS del footer después de insertarlo
                      if (file.includes("header.html")) {
                          const script = document.createElement("script");
                          script.src = "{{ asset('rutinas-de-ejercicios/includes/Header/script.js') }}";
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
        <div class="title">
          <span></span>
        </div>
        <div class="tabs">
          <div class="black"></div>
          <div class="purple">
            <h1 id="titulo-genero">Tus Me Gusta</h1>
          </div>
        </div>
        <br>
        <div class="content">

          <!-- Reproductor (mantén igual) -->
          <div class="player">
            <!-- ... (mantén la estructura del reproductor igual) ... -->
          </div>

          <!-- Lista de canciones con likes -->
          <div class="tracks-container" id="tracks-list">
            <div class="loading-message">
              <i class="fas fa-compact-disc fa-spin"></i>
              <p>Cargando tus canciones favoritas...</p>
            </div>
          </div>
        </div>
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
    const tracksList = document.getElementById('tracks-list');

    try {
        const response = await api.getLikedAudios();
        const audios = response.data;

        if (audios.length === 0) {
            tracksList.innerHTML = `
                <div class="empty-message">
                    <i class="fas fa-heart"></i>
                    <p>No hay canciones con likes aún</p>
                </div>`;
            return;
        }

        tracksList.innerHTML = audios.map(audio => `
            <div class="track" data-audio-id="${audio.id}">
                <div class="track-info">
                    <span class="track-title">${audio.title}</span>
                    <span class="track-artist">${audio.artist || 'Artista desconocido'}</span>
                </div>
                <div class="track-stats">
                    <span class="likes-count">${audio.likes_count} ❤</span>
                    <span class="track-duration">${formatDuration(audio.duration)}</span>
                </div>
                <button class="play-btn"
                        data-src="${audio.audio_file}"
                        data-title="${audio.title}"
                        data-artist="${audio.artist || ''}">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        `).join('');

          // Configurar reproductor
          setupPlayer();
          setupLikeHandlers();

        } catch (error) {
          console.error('Error:', error);
          uiElements.tracksList.innerHTML = `
            <div class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              <p>Error cargando tus favoritos</p>
            </div>`;
        }

        function formatDuration(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

        // function setupPlayer() {
        //   // Controladores de eventos para los botones de reproducción
        //   document.querySelectorAll('.play-btn').forEach(btn => {
        //     btn.addEventListener('click', () => {
        //       const audioSrc = btn.dataset.src;
        //       const isCurrentAudio = audioSrc === currentAudio;

        //       if (!isCurrentAudio) {
        //         currentAudio = audioSrc;
        //         audioPlayer.src = audioSrc;
        //         audioPlayer.play();
        //         uiElements.audioTitle.textContent = btn.dataset.title;
        //         uiElements.audioArtist.textContent = btn.dataset.artist || 'Artista desconocido';
        //       }

        //       audioPlayer.paused ? audioPlayer.play() : audioPlayer.pause();
        //       updatePlayButtonStates(btn);
        //     });
        //   });

        //    // Actualizar barra de progreso
        // audioPlayer.addEventListener('timeupdate', () => {
        //   const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        //   uiElements.progressBar.value = progress;
        //   uiElements.currentTime.textContent = formatTime(audioPlayer.currentTime);
        // });

        // // Actualizar duración total
        // audioPlayer.addEventListener('loadedmetadata', () => {
        //   uiElements.totalDuration.textContent = formatTime(audioPlayer.duration);
        // });

        // // Control del botón de progreso
        // uiElements.progressBar.addEventListener('input', (e) => {
        //   const time = (e.target.value / 100) * audioPlayer.duration;
        //   audioPlayer.currentTime = time;
        // });

        // // Control del botón play/pause
        // uiElements.playPauseBtn.addEventListener('click', () => {
        //   audioPlayer.paused ? audioPlayer.play() : audioPlayer.pause();
        // });
          // ... (mantén el resto de la configuración del reproductor igual)
        }

        function setupLikeHandlers() {
          document.querySelectorAll('.me-gusta').forEach(btn => {
            btn.addEventListener('click', async () => {
              const audioId = btn.closest('.track').dataset.audioId;

              try {
                const response = await api.toggleLike(audioId);
                if (response.status === 'success') {
                  btn.classList.toggle('active', response.liked);

                  // Si se eliminó el like, quitar el elemento de la lista
                  if (!response.liked) {
                    btn.closest('.track').remove();
                  }
                }
              } catch (error) {
                console.error('Error al toggle like:', error);
              }
            });
          });
        }

        // ... (mantén las funciones restantes del reproductor)
      });
    </script>

    <style>
        .me-gusta {
    cursor: pointer;
    color: #ccc;
    transition: color 0.3s;
    margin-left: 15px;
}

.me-gusta.active {
    color: #ff0000;
}

.track {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.track:hover {
    background-color: #f5f5f5;
}
    </style>
</body>
</html>
