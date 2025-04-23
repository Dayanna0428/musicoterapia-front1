// Configuración base
const API_BASE_URL = 'http://localhost:8000/v1';

class API {
    constructor() {
        this.authToken = localStorage.getItem('authToken');
    }

    async _fetch(endpoint, options = {}) {
        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            ...(this.authToken && { 'Authorization': `Bearer ${this.authToken}` })
        };

        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            ...options,
            headers: { ...headers, ...options.headers }
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Error en la solicitud');
        }

        return response.json();
    }

    // ==================== Autenticación ====================
    async login(email, password) {
        return this._fetch('/login', {
            method: 'POST',
            body: JSON.stringify({ email, password })
        }).then(data => {
            this.authToken = data.token;
            localStorage.setItem('authToken', data.token);
            return data;
        });
    }

    // ==================== Géneros ====================
    async getAllGenres() {
        return this._fetch('/genres');
    }

    async createGenre(genreData) {
        return this._fetch('/genres', {
            method: 'POST',
            body: JSON.stringify(genreData)
        });
    }

    async getGenre(id) {
        return this._fetch(`/genres/${id}`);
    }

    async updateGenre(id, genreData) {
        return this._fetch(`/genres/${id}`, {
            method: 'PUT',
            body: JSON.stringify(genreData)
        });
    }

    async deleteGenre(id) {
        return this._fetch(`/genres/${id}`, {
            method: 'DELETE'
        });
    }

    // ==================== Álbumes ====================
    async getAllAlbums() {
        return this._fetch('/albums');
    }

    async createAlbum(albumData) {
        return this._fetch('/albums', {
            method: 'POST',
            body: JSON.stringify(albumData)
        });
    }

    async getAlbum(id) {
        return this._fetch(`/albums/${id}`);
    }

    async updateAlbum(id, albumData) {
        return this._fetch(`/albums/${id}`, {
            method: 'PUT',
            body: JSON.stringify(albumData)
        });
    }

    async deleteAlbum(id) {
        return this._fetch(`/albums/${id}`, {
            method: 'DELETE'
        });
    }

    // ==================== Audios ====================
    async getAllAudios() {
        return this._fetch('/audios');
    }

    async createAudio(audioData) {
        const formData = new FormData();
        Object.entries(audioData).forEach(([key, value]) => {
            formData.append(key, value);
        });

        return this._fetch('/audios', {
            method: 'POST',
            headers: {},
            body: formData
        });
    }

    async getAudio(id) {
        return this._fetch(`/audios/${id}`);
    }

    async updateAudio(id, audioData) {
        return this._fetch(`/audios/${id}`, {
            method: 'PUT',
            body: JSON.stringify(audioData)
        });
    }

    async deleteAudio(id) {
        return this._fetch(`/audios/${id}`, {
            method: 'DELETE'
        });
    }

    // ==================== Podcasts ====================
    async getAllPodcasts() {
        return this._fetch('/podcasts');
    }

    async createPodcast(podcastData) {
        const formData = new FormData();
        Object.entries(podcastData).forEach(([key, value]) => {
            formData.append(key, value);
        });

        return this._fetch('/podcasts', {
            method: 'POST',
            headers: {},
            body: formData
        });
    }

    async getPodcast(id) {
        return this._fetch(`/podcasts/${id}`);
    }

    async updatePodcast(id, podcastData) {
        return this._fetch(`/podcasts/${id}`, {
            method: 'PUT',
            body: JSON.stringify(podcastData)
        });
    }

    async deletePodcast(id) {
        return this._fetch(`/podcasts/${id}`, {
            method: 'DELETE'
        });
    }

    async getPodcasts() {
        return this._fetch('/podcasts');
    }

    async getSinglePodcast(podcastId) {
        return this._fetch(`/podcasts/${podcastId}`);
    }

    // ==================== Playlists ====================
    // Playlists CRUD
    async getAllPlaylists() {
        return this._fetch('/playlists');
    }

    async createPlaylist(playlistData) {
        return this._fetch('/playlists', {
            method: 'POST',
            body: JSON.stringify(playlistData)
        });
    }

    async getPlaylist(id) {
        return this._fetch(`/playlists/${id}`);
    }

    async updatePlaylist(id, playlistData) {
        return this._fetch(`/playlists/${id}`, {
            method: 'PUT',
            body: JSON.stringify(playlistData)
        });
    }

    async deletePlaylist(id) {
        return this._fetch(`/playlists/${id}`, {
            method: 'DELETE'
        });
    }

    // Gestión de audios en playlists
    async addAudioToPlaylist(playlistId, audioId) {
        return this._fetch(`/playlists/${playlistId}/audios`, {
            method: 'POST',
            body: JSON.stringify({ audio_id: audioId })
        });
    }

    async getPlaylistAudios(playlistId) {
        return this._fetch(`/playlists/${playlistId}/audios`);
    }

    async updateAudioOrder(playlistId, audioId, order) {
        return this._fetch(`/playlists/${playlistId}/audios/${audioId}`, {
            method: 'PUT',
            body: JSON.stringify({ order })
        });
    }

    async removeAudioFromPlaylist(playlistId, audioId) {
        return this._fetch(`/playlists/${playlistId}/audios/${audioId}`, {
            method: 'DELETE'
        });
    }

    // Gestión de podcasts en playlists
    async addPodcastToPlaylist(playlistId, podcastId) {
        return this._fetch(`/playlists/${playlistId}/podcasts`, {
            method: 'POST',
            body: JSON.stringify({ podcast_id: podcastId })
        });
    }

    async getPlaylistPodcasts(playlistId) {
        return this._fetch(`/playlists/${playlistId}/podcasts`);
    }

    async updatePodcastOrder(playlistId, podcastId, order) {
        return this._fetch(`/playlists/${playlistId}/podcasts/${podcastId}`, {
            method: 'PUT',
            body: JSON.stringify({ order })
        });
    }

    async removePodcastFromPlaylist(playlistId, podcastId) {
        return this._fetch(`/playlists/${playlistId}/podcasts/${podcastId}`, {
            method: 'DELETE'
        });
    }



    async getUserPlaylists() {
        return this._fetch('/playlists');
      }

      async addAudioToPlaylist(playlistId, audioId) {
        return this._fetch(`/playlists/${playlistId}/audios`, {
          method: 'POST',
          body: JSON.stringify({ audio_id: audioId })
        });
      }

      async createPlaylist(data) {
        return this._fetch('/playlists', {
          method: 'POST',
          body: JSON.stringify(data)
        });
      }




    // ==================== Likes ====================
    async toggleLike(audioId) {
        return this._fetch(`/likes/toggle/${audioId}`, {
            method: 'POST'
        });
    }

    async checkLike(audioId) {
        return this._fetch(`/likes/check/${audioId}`);
    }

    async getUserLikes() {
        return this._fetch('/likes/user');
    }

    async getUserLikes() {
        return this._fetch('/likes/user');
    }
    async getLikedAudios() {
        return this._fetch('/audios/liked');
    }

    // Likes
    async toggleLike(audioId) {
        return this._fetch(`/likes/toggle/${audioId}`, {
            method: 'POST'
        });
    }

    async checkLike(audioId) {
        return this._fetch(`/likes/check/${audioId}`);
    }
}

// Instancia global
window.api = new API();
