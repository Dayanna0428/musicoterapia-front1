<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// RUTAS INICIO
Route::get('/login', function () {
    return view('musicoterapia.modulo-iniciar-sesion.login.login');
})->name('login');

Route::get('/mensaje', function () {
    return view('musicoterapia.modulo-iniciar-sesion.mensajes.recuperarContraseña2');
})->name('mensaje');

Route::get('/registro', function () {
    return view('musicoterapia.modulo-iniciar-sesion.registro.registro');
})->name('registro');



// RUTAS FOOTER
Route::get('/footer', function () {
    return view('musicoterapia.Fotter.inicio.footer');
})->name('footer.inicio');

// RUTAS LINKS
Route::get('/aviso-legal', function () {
    return view('musicoterapia.Fotter.inicio.link.avisolegal');
})->name('aviso-legal');

Route::get('/beneficios', function () {
    return view('musicoterapia.Fotter.inicio.link.beneficiosdetranquilidad');
})->name('beneficios');

Route::get('/consejos', function () {
    return view('musicoterapia.Fotter.inicio.link.consejodebienestar');
})->name('consejos');

Route::get('/contacto', function () {
    return view('musicoterapia.Fotter.inicio.link.contacto');
})->name('contacto');

Route::get('/guia', function () {
    return view('musicoterapia.Fotter.inicio.link.guiadeuso');
})->name('guia');

Route::get('/politica-privacidad', function () {
    return view('musicoterapia.Fotter.inicio.link.politicadeprivacidad');
})->name('politica-privacidad');

Route::get('/quienes-somos', function () {
    return view('musicoterapia.Fotter.inicio.link.quienessomos');
})->name('quienes.somos');

Route::get('/sugerencias', function () {
    return view('musicoterapia.Fotter.inicio.link.sugerencias');
})->name('sugerencias');

Route::get('/terminos-y-condiciones', function () {
    return view('musicoterapia.Fotter.inicio.link.terminosycondiciones');
})->name('terminos-y-condiciones');

// RUTAS HEADER
Route::get('/header', function () {
    return view('musicoterapia.Header.header');
})->name('header');

Route::get('/header1', function () {
    return view('musicoterapia.Header.header1');
})->name('header1');


// RUTAS MUSICOTERAPIA
Route::get('/me-gusta', function () {
    return view('musicoterapia.megusta.megusta');
})->name('me-gusta');

Route::get('/creaciones', function () {
    return view('musicoterapia.miscreaciones.miscreaciones');
})->name('creaciones');

Route::get('/playlist', function () {
    return view('musicoterapia.playlist.playList');
})->name('playlist');

Route::get('/album', function () {
    return view('musicoterapia.principal_album.principal_album');
})->name('album');

Route::get('/buscar', function () {
    return view('musicoterapia.principal_buscar.buscar');
})->name('buscar');

Route::get('/estudio', function () {
    return view('musicoterapia.principal_estudio_podcasts.principal_estudio');
})->name('estudio');
Route::get('/generos', function () {
    return view('musicoterapia.principal_generos.principal_generos');
})->name('generos');

Route::get('/podcast', function () {
    return view('musicoterapia.principal_podcast.principal_podcast');
})->name('podcast');

Route::get('/binaurales', function () {
    return view('musicoterapia.sonidos_binaurales.binaurales');
})->name('binaurales');

// RUTAS REPRODUCTORES
//  REPRODUCCTORES ALBUM
Route::get('/reproductor-album', function () {
    return view('musicoterapia.reproducctores.album_elegido.album_elegido');
})->name('reproductor-album');
Route::get('/reproductor-album1', function () {
    return view('musicoterapia.reproducctores.album_elegido.dormir.album_elegido1');
})->name('reproductor-album1');

Route::get('/reproductor-album2', function () {
    return view('musicoterapia.reproducctores.album_elegido.relajarse.album_elegido2');
})->name('reproductor-album2');
Route::get('/reproductor-album3', function () {
    return view('musicoterapia.reproducctores.album_elegido.concentrarse.album_elegido3');
})->name('reproductor-album3');

Route::get('/reproductor-album4', function () {
    return view('musicoterapia.reproducctores.album_elegido.gamer.album_elegido4');
})->name('reproductor-album4');

//  REPRODUCCTORES GENEROS
Route::get('/reproductor-genero', function () {
    return view('musicoterapia.reproducctores.genero_elegido.genero_elegido');
})->name('reproductor-genero');
Route::get('/reproductor-genero1', function () {
    return view('musicoterapia.reproducctores.genero_elegido.clasica.genero_elegido1');
})->name('reproductor-genero1');
Route::get('/reproductor-genero2', function () {
    return view('musicoterapia.reproducctores.genero_elegido.ambiental.genero_elegido2');
})->name('reproductor-genero2');
Route::get('/reproductor-genero4', function () {
    return view('musicoterapia.reproducctores.genero_elegido.electronica.genero_elegido4');
})->name('reproductor-genero4');
Route::get('/reproductor-genero5', function () {
    return view('musicoterapia.reproducctores.genero_elegido.instrumental.genero_elegido5');
})->name('reproductor-genero5');

// REPRODUCTOR SONIDOS BINAURALES
Route::get('/reproductor-binaural', function () {
    return view('musicoterapia.reproducctores.repro_binaurales.Reproducctor2');
})->name('reproductor-binaural');

// REPRPRODUCTOR BUSQUEDA
Route::get('/reproductor-busqueda', function () {
    return view('musicoterapia.reproducctores.repro_busqueda.repro_busqueda');
})->name('reproductor-busqueda');

// REPRODUCTOR CREACIONES
Route::get('/reproductor-creaciones', function () {
    return view('musicoterapia.reproducctores.repro_creaciones.Reproductor_creaciones');
})->name('reproductor-creaciones');

// REPRODUCTOR PISTAS
Route::get('/reproductor-pistas', function () {
    return view('musicoterapia.reproducctores.repro_pistas.Reproductor_pistas');
})->name('reproductor-pistas');

// RUTAS REPRODUCTORES PODCAST

Route::get('/reproductor-podcast1', function () {
    return view('musicoterapia.reproductores.repro_podcasts.afirmaciones.Reproductorpodcast1');
})->name('reproductor-podcast1'); // ← ✅ CORRECTO

Route::get('/reproductor-podcast2', function () {
    return view('musicoterapia.reproducctores.repro_podcasts.autoestima.Reproductorpodcast2');
})->name('reproductor-podcast2');

Route::get('/reproductor-podcast3', function () {
    return view('musicoterapia.reproducctores.repro_podcasts.motivacion.Reproductorpodcast3');
})->name('reproductor-podcast3');


Route::get('/prueba', function () {
    return view('musicoterapia.reproducctores.repro_pistas.Reproductor_pistas');
});
