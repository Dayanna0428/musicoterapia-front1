<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/REPRODUCCTORES/REPRO_BINAURALES/style.css') }}">
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
#titulo-album {
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  color: #59009a;
  font-style: italic;
  font-size: 48px;
  text-align: right;
  margin-top: 75px;
  margin-right: 320px; /* Antes estaba en 60px */
  width: 100%;
}

  </style>
  <title>Tranquilidad - Sonido Binaural</title>
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
        <h1 id="titulo-album">Sonido Binaural</h1>
        <br><br>

        <div class="content">
            <div class="player">
                <div class="album-cover">
                    <img id="album-image" src="" alt="" />
                    <div class="playhead"></div>
                </div>
                <div class="track-info">
                    <h2 id="audio-title" style="margin: 0">Bienvenido y disfruta ♫</h2>
                    <p id="audio-artist">Sin descripción</p>
                </div>
                <div class="progress-container">
                    <input type="range" id="progress-bar" value="0" min="0" max="100" step="0.1">
                </div>
                <div class="time">
                    <span id="current-time">0:00</span>
                    <span id="total-duration">0:00</span>
                </div>
                <div class="controls">
                    <button id="play-pause-btn">▶</button>
                </div>
            </div>

            <!-- Sección de información adicional -->
            <div class="binaural-info">
                <h3 id="binaural-frequency"></h3>
                <p id="binaural-description"></p>
                <div class="binaural-effects">
                    <div class="effect-card">
                        <i class="fas fa-brain"></i>
                        <span>Efecto en ondas cerebrales</span>
                    </div>
                    <div class="effect-card">
                        <i class="fas fa-clock"></i>
                        <span>Duración recomendada: 30 min</span>
                    </div>
                </div>
            </div>
        </div>

        <audio id="audio"></audio>
    </main>
  </div>

  <br><br><br><br>
  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', async () => {
        const api = new API();
        const audioId = window.location.pathname.split('/').pop();

        // Verificar elementos esenciales
        const requiredElements = {
            audioTitle: document.getElementById('audio-title'),
            audioArtist: document.getElementById('audio-artist'),
            frequency: document.getElementById('binaural-frequency'),
            description: document.getElementById('binaural-description'),
            audioElement: document.getElementById('audio'),
            progressBar: document.getElementById('progress-bar'),
            currentTime: document.getElementById('current-time'),
            totalDuration: document.getElementById('total-duration'),
            playPauseBtn: document.getElementById('play-pause-btn')
        };

        // Validar que todos los elementos existen
        for (const [key, element] of Object.entries(requiredElements)) {
            if (!element) {
                console.error(`Elemento faltante: ${key}`);
                alert(`Error de configuración: Elemento ${key} no encontrado`);
                return;
            }
        }

        try {
            // Obtener detalles del audio
            const response = await api.getAudio(audioId);
            const audioData = response.data;

            // Actualizar UI
            requiredElements.audioTitle.textContent = audioData.title;
            requiredElements.audioArtist.textContent = audioData.artist || 'Sonido terapéutico';
            requiredElements.frequency.textContent = `Frecuencia: ${audioData.frecuencia}Hz`;
            requiredElements.description.textContent = audioData.description || 'Sonido diseñado para estimulación cerebral';

            // Configurar reproductor
            requiredElements.audioElement.src = audioData.audio_file;

            // Controladores de eventos
            requiredElements.audioElement.addEventListener('loadedmetadata', () => {
                requiredElements.totalDuration.textContent = formatTime(requiredElements.audioElement.duration);
            });

            requiredElements.audioElement.addEventListener('timeupdate', () => {
                requiredElements.currentTime.textContent = formatTime(requiredElements.audioElement.currentTime);
                const progress = (requiredElements.audioElement.currentTime / requiredElements.audioElement.duration) * 100;
                requiredElements.progressBar.value = progress;
            });

            requiredElements.playPauseBtn.addEventListener('click', () => {
                if (requiredElements.audioElement.paused) {
                    requiredElements.audioElement.play();
                    requiredElements.playPauseBtn.textContent = '⏸';
                } else {
                    requiredElements.audioElement.pause();
                    requiredElements.playPauseBtn.textContent = '▶';
                }
            });

            requiredElements.progressBar.addEventListener('input', (e) => {
                const time = (e.target.value / 100) * requiredElements.audioElement.duration;
                requiredElements.audioElement.currentTime = time;
            });

        } catch (error) {
            console.error('Error:', error);
            alert('Error cargando el audio: ' + error.message);
        }

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs.toString().padStart(2, '0')}`;
        }
    });
</script>
</body>

</html>
