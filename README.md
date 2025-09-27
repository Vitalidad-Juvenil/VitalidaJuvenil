Codigo anterio musica
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Multimedia Moderno</title>
    <!-- Tailwind CSS para el estilo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <!-- Iconos de Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: url('https://tse4.mm.bing.net/th/id/OIP.C7WQIAYOUrgCnJoPUjmLRQHaEp?rs=1&pid=ImgDetMain&o=7&rm=3') no-repeat center center fixed;
           
        
           
            overflow-y: auto;
            background-size: cover;
            overflow-y: auto;
        }

        /* Estilo para las tarjetas con efecto de vidrio (glassmorphism) */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Ocultar inputs de archivo originales */
        #audio-upload-input, #video-upload-input {
            display: none;
        }

        /* Estilo para la barra de progreso del reproductor de audio */
        #audio-progress-bar {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            outline: none;
            cursor: pointer;
        }

        #audio-progress-bar::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            background: #8b5cf6; /* Violet */
            border-radius: 50%;
            transition: background 0.2s;
        }
        
        #audio-progress-bar:hover::-webkit-slider-thumb {
             background: #a78bfa;
        }

        /* Animación para la aparición de elementos */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        /* Estilos para la lista de canciones */
        #playlist li.playing {
            background-color: rgba(139, 92, 246, 0.3); /* violet-500 with opacity */
            color: #f0f0f0;
        }
    </style>
</head>
<body class="text-white flex flex-col items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-5xl mx-auto fade-in">
        <!-- Título Principal -->
        <header class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-emerald-400">
                Tu Centro Multimedia
            </h1>
            <p class="text-gray-400 mt-2 text-lg">Música y videos, todo en un mismo lugar.</p>
        </header>

        <!-- Pestañas de Navegación -->
        <div class="flex justify-center items-center gap-4 mb-8">
            <button id="tab-music" class="tab-btn bg-violet-500 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-violet-500/30 flex items-center gap-2">
                <i class="ph ph-music-notes"></i> Música
            </button>
            <button id="tab-video" class="tab-btn bg-gray-700/80 text-gray-300 font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:bg-emerald-500 hover:text-white hover:shadow-lg hover:shadow-emerald-500/30 flex items-center gap-2">
                <i class="ph ph-monitor-play"></i> Video
            </button>
        </div>

        <!-- Contenedor de los Reproductores -->
        <main>
            <!-- Reproductor de Música -->
            <div id="music-player" class="player-content glass-card rounded-2xl p-6 sm:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Columna Izquierda: Controles y Archivos -->
                    <div class="flex flex-col">
                        <h2 class="text-2xl font-bold mb-4">Reproductor de Audio</h2>
                        <button id="audio-upload-label" class="w-full bg-violet-500 hover:bg-violet-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 mb-6">
                            <i class="ph ph-upload-simple"></i> Añadir Canciones
                        </button>
                        <input type="file" id="audio-upload-input" accept="audio/*" multiple>
                        
                        <div class="bg-black/20 rounded-lg p-4 flex-grow">
                             <h3 class="font-semibold mb-2 border-b border-gray-600 pb-2">Lista de Reproducción</h3>
                             <ul id="playlist" class="h-64 overflow-y-auto pr-2">
                                <p id="no-songs-message" class="text-gray-400 text-center mt-8">Sube algunas canciones para empezar.</p>
                                <!-- Las canciones se añadirán aquí -->
                             </ul>
                        </div>
                    </div>
                    
                    <!-- Columna Derecha: Player -->
                    <div class="flex flex-col items-center justify-center bg-black/30 rounded-lg p-8">
                        <i class="ph-fill ph-music-notes-simple text-8xl text-violet-300 mb-4"></i>
                        <p id="current-song-title" class="text-xl font-bold text-center mb-2 truncate w-full">Selecciona una canción</p>
                        <p id="current-song-artist" class="text-gray-400 mb-6">...</p>

                        <div class="w-full">
                            <input type="range" id="audio-progress-bar" value="0" step="1">
                            <div class="flex justify-between text-sm text-gray-400 mt-1">
                                <span id="current-time">0:00</span>
                                <span id="total-time">0:00</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 mt-6">
                            <button id="prev-btn" class="text-3xl text-gray-300 hover:text-white transition-colors transform hover:scale-110"><i class="ph-fill ph-skip-back"></i></button>
                            <button id="play-pause-btn" class="text-5xl bg-violet-500 text-white rounded-full w-16 h-16 flex items-center justify-center hover:bg-violet-600 transition-all transform hover:scale-110 shadow-lg shadow-violet-500/30">
                                <i id="play-pause-icon" class="ph-fill ph-play"></i>
                            </button>
                            <button id="next-btn" class="text-3xl text-gray-300 hover:text-white transition-colors transform hover:scale-110"><i class="ph-fill ph-skip-forward"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reproductor de Video -->
            <div id="video-player" class="player-content hidden">
                <div class="glass-card rounded-2xl p-6 sm:p-8 mb-8">
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                             <label class="block text-lg font-bold mb-2 text-gray-200">Desde tu computador</label>
                             <button id="video-upload-label" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                 <i class="ph ph-file-video"></i> Seleccionar Archivo
                            </button>
                             <input type="file" id="video-upload-input" accept="video/*">
                             <p id="file-name" class="text-gray-400 text-sm mt-2 truncate">Ningún archivo seleccionado.</p>
                        </div>
                        <div>
                             <label class="block text-lg font-bold mb-2 text-gray-200">Desde YouTube</label>
                             <div class="flex gap-2">
                                 <input type="text" id="youtube-url-input" class="w-full bg-gray-700/50 text-white border border-gray-600 rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 focus:outline-none placeholder-gray-400" placeholder="Pega el enlace aquí...">
                                 <button id="load-youtube-btn" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-5 rounded-lg transition-colors duration-300 transform hover:scale-105">Cargar</button>
                             </div>
                        </div>
                     </div>
                </div>
                <div id="video-container" class="w-full bg-black rounded-2xl shadow-2xl overflow-hidden border border-gray-700 flex items-center justify-center" style="aspect-ratio: 16 / 9;">
                     <p id="placeholder-text" class="text-gray-500 text-xl">Aquí se mostrará tu video</p>
                </div>
                <div id="error-message" class="text-center text-red-400 mt-4 font-semibold h-6"></div>
            </div>
        </main>
    </div>

    <audio id="audio-element"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Lógica de Pestañas ---
            const tabMusic = document.getElementById('tab-music');
            const tabVideo = document.getElementById('tab-video');
            const musicPlayer = document.getElementById('music-player');
            const videoPlayer = document.getElementById('video-player');

            function switchTab(activeTab) {
                if (activeTab === 'music') {
                    musicPlayer.classList.remove('hidden');
                    videoPlayer.classList.add('hidden');
                    tabMusic.classList.replace('bg-gray-700/80', 'bg-violet-500');
                    tabMusic.classList.replace('text-gray-300', 'text-white');
                    tabVideo.classList.replace('bg-emerald-500', 'bg-gray-700/80');
                    tabVideo.classList.replace('text-white', 'text-gray-300');
                } else {
                    musicPlayer.classList.add('hidden');
                    videoPlayer.classList.remove('hidden');
                    tabMusic.classList.replace('bg-violet-500', 'bg-gray-700/80');
                    tabMusic.classList.replace('text-white', 'text-gray-300');
                    tabVideo.classList.replace('bg-gray-700/80', 'bg-emerald-500');
                    tabVideo.classList.replace('text-gray-300', 'text-white');
                }
            }

            tabMusic.addEventListener('click', () => switchTab('music'));
            tabVideo.addEventListener('click', () => switchTab('video'));


            // --- Lógica del Reproductor de Música ---
            const audioUploadLabel = document.getElementById('audio-upload-label');
            const audioUploadInput = document.getElementById('audio-upload-input');
            const playlistElement = document.getElementById('playlist');
            const noSongsMessage = document.getElementById('no-songs-message');
            const audioElement = document.getElementById('audio-element');
            const playPauseBtn = document.getElementById('play-pause-btn');
            const playPauseIcon = document.getElementById('play-pause-icon');
            const nextBtn = document.getElementById('next-btn');
            const prevBtn = document.getElementById('prev-btn');
            const progressBar = document.getElementById('audio-progress-bar');
            const currentTimeEl = document.getElementById('current-time');
            const totalTimeEl = document.getElementById('total-time');
            const currentSongTitleEl = document.getElementById('current-song-title');

            let playlist = [];
            let currentSongIndex = -1;
            let isPlaying = false;

            // Cargar canciones del localStorage al iniciar
            function loadSongsFromStorage() {
                const storedSongs = localStorage.getItem('musicPlaylist');
                if (storedSongs) {
                    playlist = JSON.parse(storedSongs);
                    renderPlaylist();
                }
            }

            // Guardar canciones en el localStorage
            function saveSongsToStorage() {
                localStorage.setItem('musicPlaylist', JSON.stringify(playlist));
            }

            // Renderizar la lista de reproducción en la UI
            function renderPlaylist() {
                playlistElement.innerHTML = '';
                if (playlist.length === 0) {
                    noSongsMessage.style.display = 'block';
                } else {
                    noSongsMessage.style.display = 'none';
                    playlist.forEach((song, index) => {
                        const li = document.createElement('li');
                        li.textContent = song.name;
                        li.className = 'p-2 cursor-pointer hover:bg-violet-500/20 rounded-md transition-colors';
                        li.dataset.index = index;
                        li.addEventListener('click', () => {
                            playSong(index);
                        });
                        playlistElement.appendChild(li);
                    });
                }
            }
            
            // Subir archivos de audio
            audioUploadLabel.addEventListener('click', () => audioUploadInput.click());
            audioUploadInput.addEventListener('change', (event) => {
                const files = event.target.files;
                if(files.length === 0) return;

                let filesProcessed = 0;
                for(const file of files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        playlist.push({ name: file.name, data: e.target.result });
                        filesProcessed++;
                        if(filesProcessed === files.length) {
                             saveSongsToStorage();
                             renderPlaylist();
                             if(currentSongIndex === -1 && playlist.length > 0) {
                                 loadSong(0);
                             }
                        }
                    };
                    reader.readAsDataURL(file);
                }
                audioUploadInput.value = ''; // Reset para poder subir el mismo archivo
            });

            // Cargar una canción pero no reproducirla
            function loadSong(index) {
                if (index < 0 || index >= playlist.length) return;
                currentSongIndex = index;
                const song = playlist[index];
                audioElement.src = song.data;
                currentSongTitleEl.textContent = song.name.replace('.mp3','').replace('.wav','').replace('.ogg','');
                
                // Actualizar UI de la playlist
                Array.from(playlistElement.children).forEach((li, i) => {
                    li.classList.remove('playing');
                    if (i === index) {
                        li.classList.add('playing');
                    }
                });
            }

            // Reproducir una canción
            function playSong(index) {
                loadSong(index);
                audioElement.play();
                isPlaying = true;
                playPauseIcon.classList.replace('ph-play', 'ph-pause');
            }
            
            function togglePlayPause() {
                if (currentSongIndex === -1 && playlist.length > 0) {
                    playSong(0);
                    return;
                }
                
                if (isPlaying) {
                    audioElement.pause();
                } else {
                    audioElement.play();
                }
                isPlaying = !isPlaying;
                playPauseIcon.classList.toggle('ph-play', !isPlaying);
                playPauseIcon.classList.toggle('ph-pause', isPlaying);
            }

            function playNext() {
                let newIndex = currentSongIndex + 1;
                if (newIndex >= playlist.length) {
                    newIndex = 0;
                }
                playSong(newIndex);
            }

            function playPrev() {
                let newIndex = currentSongIndex - 1;
                if (newIndex < 0) {
                    newIndex = playlist.length - 1;
                }
                playSong(newIndex);
            }
            
            function updateProgress() {
                if(isNaN(audioElement.duration)) return;
                const { duration, currentTime } = audioElement;
                progressBar.value = (currentTime / duration) * 100;
                currentTimeEl.textContent = formatTime(currentTime);
            }

            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
            }

            playPauseBtn.addEventListener('click', togglePlayPause);
            nextBtn.addEventListener('click', playNext);
            prevBtn.addEventListener('click', playPrev);
            audioElement.addEventListener('ended', playNext);
            audioElement.addEventListener('timeupdate', updateProgress);
            audioElement.addEventListener('loadedmetadata', () => {
                totalTimeEl.textContent = formatTime(audioElement.duration);
            });
            progressBar.addEventListener('input', (e) => {
                 if(!isNaN(audioElement.duration)) {
                    audioElement.currentTime = (e.target.value / 100) * audioElement.duration;
                 }
            });


            // --- Lógica del Reproductor de Video (código original adaptado) ---
            const videoUploadInput = document.getElementById('video-upload-input');
            const fileNameDisplay = document.getElementById('file-name');
            const youtubeUrlInput = document.getElementById('youtube-url-input');
            const loadYoutubeBtn = document.getElementById('load-youtube-btn');
            const videoContainer = document.getElementById('video-container');
            const errorMessage = document.getElementById('error-message');
            const videoUploadLabel = document.getElementById('video-upload-label');

            videoUploadLabel.addEventListener('click', () => videoUploadInput.click());

            videoUploadInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    clearVideoContainer();
                    errorMessage.textContent = '';
                    fileNameDisplay.textContent = file.name;
                    youtubeUrlInput.value = '';

                    const videoPlayer = document.createElement('video');
                    videoPlayer.controls = true;
                    videoPlayer.autoplay = true;
                    videoPlayer.classList.add('w-full', 'h-full', 'object-contain');

                    const fileURL = URL.createObjectURL(file);
                    videoPlayer.src = fileURL;

                    videoContainer.appendChild(videoPlayer);
                }
            });

            loadYoutubeBtn.addEventListener('click', () => {
                const url = youtubeUrlInput.value.trim();
                if (url) {
                    const videoId = getYouTubeVideoId(url);
                    if (videoId) {
                        clearVideoContainer();
                        errorMessage.textContent = '';
                        fileNameDisplay.textContent = 'Ningún archivo seleccionado.';
                        videoUploadInput.value = '';

                        const iframe = document.createElement('iframe');
                        iframe.classList.add('w-full', 'h-full');
                        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
                        iframe.title = "Reproductor de video de YouTube";
                        iframe.frameborder = "0";
                        iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
                        iframe.allowfullscreen = true;

                        videoContainer.appendChild(iframe);
                    } else {
                        showError("El enlace de YouTube no parece válido. Asegúrate de que sea correcto.");
                    }
                }
            });

            function getYouTubeVideoId(url) {
                const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
                const match = url.match(regex);
                return match ? match[1] : null;
            }

            function clearVideoContainer() {
                videoContainer.innerHTML = `<p id="placeholder-text" class="text-gray-500 text-xl">Aquí se mostrará tu video</p>`;
            }

            function showError(message) {
                errorMessage.textContent = message;
                setTimeout(() => {
                    errorMessage.textContent = '';
                }, 5000);
            }
            
            // --- Inicialización ---
            loadSongsFromStorage();
        });
    </script>

</body>
</html>
