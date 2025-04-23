<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- Estilos externos --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  {{-- Estilos locales --}}
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/SONIDOS_BINAURALES/style.css') }}">

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

  <title>Tranquilidad - Sonidos Binaurales</title>

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
      <br><br>
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
          <span>Sonidos Binaurales</span>
        </div>
        <br><br>

        <!-- Sección informativa -->
        <div class="image-container" style="position: relative;">
          <img src="{{ asset('image/imgBin/1.png') }}" alt="Fondo de ondas binaurales"
               style="width: 100%; height: auto; max-height: 500px; object-fit: cover;" />
          <div class="corner-text">ACTIVA TU CEREBRO</div>
          <div class="bottom-left-text">
            ONDAS GAMMA BINAURALES: Rendimiento Mental, Concentración y Memoria
          </div>
        </div>

        <!-- Lista de audios binaurales -->
        <div class="image-container2">
          <div class="content">
            <div class="tracks-container" id="binaural-tracks">
              <!-- Los audios se cargarán aquí -->
            </div>
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
      const container = document.getElementById('binaural-tracks');

      try {
        // 1. Obtener todos los audios
        const response = await api.getAllAudios();
        console.log('Respuesta completa de la API:', response);

        // 2. Verificar estructura de datos
        if (!response.data || !Array.isArray(response.data)) {
          throw new Error('Formato de datos inválido de la API');
        }

        // 3. Depurar valores de es_binaural
        const allAudios = response.data;
        console.log('Todos los audios:', allAudios);

        // 4. Filtrar audios binaurales con verificación
        const binauralAudios = allAudios.filter(audio => {
          console.log(`Audio ID: ${audio.id}, es_binaural: ${audio.es_binaural} (tipo: ${typeof audio.es_binaural})`);
          return Boolean(audio.es_binaural); // Convierte a booleano explícitamente
        });

        console.log('Audios binaurales filtrados:', binauralAudios);

        if (binauralAudios.length === 0) {
          container.innerHTML = '<p>No se encontraron audios binaurales</p>';
          return;
        }

        // 5. Generar HTML con más detalles
        container.innerHTML = binauralAudios.map(audio => `
          <div class="binaural-track">
            <div class="track-info">
              <h3>${audio.title}</h3>
              ${audio.description ? `<p class="description">${audio.description}</p>` : ''}
              <div class="metadata">
                <p>Duración: ${formatDuration(audio.duration)}</p>
                ${audio.frecuencia ? `<p>Frecuencia: ${audio.frecuencia}Hz</p>` : ''}
                <p>Tipo: ${audio.es_binaural ? 'Binaural' : 'Regular'}</p>
              </div>
            </div>
           <button class="play-binaural" data-audio-id="${audio.id}">
                Reproducir
            </button>
          </div>
        `).join('');

        // 6. Agregar eventos de clic
        document.querySelectorAll('.play-binaural').forEach(btn => {
          btn.addEventListener('click', () => {
            const audioId = btn.dataset.audioId;
            window.location.href = `/reproductor-binaural/${audioId}`;
          });
        });

      } catch (error) {
        console.error('Error:', error);
        container.innerHTML = `<p class="error">Error cargando audios: ${error.message}</p>`;
      }

      function formatDuration(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${minutes}:${secs.toString().padStart(2, '0')}`;
      }
    });
</script>



</body>
</html>
