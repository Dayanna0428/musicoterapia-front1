<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Íconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/Header/style copy.css') }}">
  <link rel="stylesheet" href="{{ asset('css/musicoterapia.css/PLAYLIST/style.css') }}">

  <title>Tranquilidad - Playlists</title>

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
</head>
<body>
  {{-- Header --}}
  @include('musicoterapia.Header.header')

  <div class="container">
    <aside class="sidebar">
      <br>
      <br>
      <br>
      <br>
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
      <div class="menu-item {{ request()->routeIs('playlist') ? 'active' : '' }}">
        <a href="{{ route('playlist') }}">
          {{-- <img src="{{ asset('image/images/playL.png') }}" alt="Icon" /> --}}
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
        <span>PlayList</span>
      </div>
      <div class="playlists" id="playlists-container">
        <p>Cargando playlists...</p>
      </div>
    </main>
  </div>
<br>
<br>
<br>

  {{-- Footer --}}
  @include('musicoterapia.Fotter.inicio.footer')

  <script src="{{ asset('js/api.js') }}"></script>
  <script>
 document.addEventListener('DOMContentLoaded', async () => {
    const api = new API();
    const container = document.getElementById('playlists-container');

    // Define la imagen por defecto para las playlists
    const defaultPlaylistImg = '{{ asset('image/images/default_playlist.jpg') }}';

    // Define el formulario para nueva playlist
    const newPlaylistForm = `
        <div class="new-playlist-form" id="new-playlist-form" style="display: none;">
            <input type="text" id="playlist-name" placeholder="Nombre de la playlist" required>
            <textarea id="playlist-description" placeholder="Descripción"></textarea>
            <button id="create-playlist">Crear</button>
            <button id="cancel-create">Cancelar</button>
        </div>
    `;

    try {
        // Cargar playlists
        container.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Cargando playlists...</div>';

        const response = await api.getAllPlaylists();
        const playlists = response.data;

        if (playlists.length === 0) {
            container.innerHTML = `
                <div class="empty-playlists">
                    <p>Aún no tienes ninguna playlist</p>
                    <button id="show-create-form">Crear nueva playlist</button>
                </div>
                ${newPlaylistForm}
            `;
        } else {
            container.innerHTML = `
                <div class="playlist-button-container">
                    <button id="show-create-form">Nueva Playlist <i class="fas fa-plus"></i></button>
                </div>
                <div class="playlist-grid" id="playlist-grid"></div>
                ${newPlaylistForm}
            `;

            const grid = document.getElementById('playlist-grid');
             grid.innerHTML = playlists.map(playlist => `
                <a href="/playlists/${playlist.id}" class="playlist-card">
                    <div class="playlist-image">
                        <img src="${playlist.image_url || defaultPlaylistImg}"
                             alt="${playlist.name}"
                             onerror="this.src='${defaultPlaylistImg}'">
                    </div>
                    <div class="playlist-info">
                        <h3>${playlist.name}</h3>
                        ${playlist.description ? `<p>${playlist.description}</p>` : ''}
                        <div class="playlist-stats">
                            <span><i class="fas fa-music"></i> ${playlist.audios_count + playlist.podcasts_count} pistas</span>
                        </div>
                    </div>
                </a>
            `).join('');
        }

        // Manejar creación de nuevas playlists
        document.getElementById('show-create-form')?.addEventListener('click', () => {
            document.getElementById('new-playlist-form').style.display = 'block';
        });

        document.getElementById('cancel-create')?.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('new-playlist-form').style.display = 'none';
        });

        document.getElementById('create-playlist')?.addEventListener('click', async (e) => {
            e.preventDefault();
            const name = document.getElementById('playlist-name').value;
            const description = document.getElementById('playlist-description').value;

            if (!name) {
                alert('El nombre es requerido');
                return;
            }

            try {
                const newPlaylist = await api.createPlaylist({
                    name: name,
                    description: description
                });

                // Recargar playlists
                location.reload();
            } catch (error) {
                console.error('Error creando playlist:', error);
                alert('Error al crear la playlist: ' + error.message);
            }
        });

    } catch (error) {
        console.error('Error cargando playlists:', error);
        container.innerHTML = `
            <div class="error">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Error cargando playlists</p>
                ${error.message ? `<small>${error.message}</small>` : ''}
            </div>
        `;
    }
});
  </script>

  <style>
   /* Actualización en el estilo para las playlists */
   .playlist-button-container {
    width: 100%;
    display: flex;
    justify-content: flex-start;
    margin-bottom: 1rem;
}
.playlist-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.playlist-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Tres columnas por fila */
    gap: 1.5rem;
    margin-top: 2rem;
}

.playlist-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 1rem;
    transition: transform 0.3s ease;
    text-decoration: none;
    color: #333;
}

.playlist-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.playlist-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}

.playlist-info {
    padding: 1rem 0;
}

.playlist-info h3 {
    margin: 0;
    color: #59009a;
    font-size: 1.2rem;
}

.playlist-stats {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

/* Estilo del formulario para nueva playlist */
.new-playlist-form {
    background: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    border-radius: 15px;
    margin-top: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.new-playlist-form input,
.new-playlist-form textarea {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
}

.new-playlist-form button {
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-right: 1rem;
}

#create-playlist {
    background: #59009a;
    color: white;
}

#cancel-create {
    background: #ddd;
    color: #333;
}

/* Botón de Nueva Playlist */
#show-create-form {
    background: #59009a;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 2rem;
    display: inline-block;
    font-size: 1rem;
    transition: background 0.3s ease;
}

#show-create-form:hover {
    background: #45007a;
}

/* Estilo de la carga y mensajes de error */
.loading {
    text-align: center;
    padding: 2rem;
    font-size: 1.2rem;
}

.empty-playlists {
    text-align: center;
    padding: 2rem;
}

.empty-playlists button {
    background: #59009a;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 1rem;
}

.error {
    text-align: center;
    padding: 2rem;
    color: #dc3545;
}
  </style>

</body>
</html>
