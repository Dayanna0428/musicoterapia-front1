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

  <!-- Script -->
  <script src="{{ asset('js/musicoterapia.js/PLAYLIST/script.js') }}"></script>
  <script>
    const reproductorPistasUrl = "{{ route('reproductor-pistas') }}";
</script>
<script>
  const placeholderImg = "{{ asset('image/img/placeholder.png') }}";
  const defaultPlaylistImg = "{{ asset('image/imgplaylist/pl.png') }}";
</script>
<script>
  const loginUrl = "{{ route('login') }}";
</script>

</body>
</html>
