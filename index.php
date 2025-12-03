<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nitflix - DetikBahagia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/logo n.png" type="image/png">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'netflix': ['Netflix Sans', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        'netflix-red': '#E50914',
                        'netflix-dark': '#141414',
                        'netflix-gray': '#333333',
                    },
                    animation: {
                        'fadeIn': 'fadeIn 2s ease-in-out',
                        'fadeInDelay': 'fadeIn 2s ease-in-out 1s both',
                        'slideUp': 'slideUp 0.8s ease-out',
                        'logoGlow': 'logoGlow 2s ease-in-out infinite alternate',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'scale(0.9)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(50px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        logoGlow: {
                            '0%': { filter: 'drop-shadow(0 0 5px #E50914)' },
                            '100%': { filter: 'drop-shadow(0 0 20px #E50914)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Netflix Sans', Arial, sans-serif;
            background: #000;
            overflow: hidden; /* Prevent scrolling */
            height: 100vh;
        }
        
        /* Custom logo sizing for different screen sizes */
        .logo {
            width: auto;
            max-width: 120px;
        }
        
        @media (min-width: 640px) {
            .logo {
                max-width: 150px;
            }
        }
        
        @media (min-width: 768px) {
            .logo {
                max-width: 180px;
            }
        }
        
        @media (min-width: 1024px) {
            .logo {
                max-width: 200px;
            }
        }
        
        /* Enhanced responsive design */
        @media (max-height: 600px) {
            .modal-compact {
                padding: 1rem !important;
                margin: 0.5rem !important;
            }
            .modal-compact h2 {
                font-size: 1.2rem !important;
                margin-bottom: 0.5rem !important;
            }
            .modal-compact p {
                font-size: 0.8rem !important;
                margin-bottom: 1rem !important;
            }
            .modal-compact .space-y-3 > div {
                margin-top: 0.5rem !important;
            }
            .modal-compact button {
                padding: 0.75rem !important;
                font-size: 0.9rem !important;
            }
        }
        
        /* Mobile landscape optimization */
        @media (max-height: 500px) and (orientation: landscape) {
            #mainContent {
                overflow-y: auto;
            }
            .modal-container {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        }
    </style>
</head>
<body class="bg-black text-white overflow-x-hidden">
    <!-- Intro Screen 1 - Single N Logo -->
    <div id="intro1" class="fixed inset-0 z-50 bg-black flex items-center justify-center">
        <div class="text-center">
            <img src="assets/images/logo n.png" alt="N Logo" id="logo1" class="logo fade-in animate-logoGlow">
        </div>
    </div>

    <!-- Intro Screen 2 - Full NETFLIX Logo -->
    <div id="intro2" class="fixed inset-0 z-40 bg-black flex items-center justify-center opacity-0">
        <div class="text-center">
            <img src="assets/images/logo nitflix.png" alt="NETFLIX" class="h-20 mx-auto animate-fadeIn">
        </div>
    </div>

    <!-- Main Content -->
    <div id="mainContent" class="h-screen bg-gradient-to-br from-black via-red-950 to-black opacity-0 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-48 h-48 md:w-72 md:h-72 bg-netflix-red rounded-full blur-3xl opacity-30 animate-float"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 md:w-96 md:h-96 bg-red-900 rounded-full blur-3xl opacity-20 animate-float delay-1000"></div>
        </div>

        <!-- Netflix Logo Header -->
        <div class="relative z-10 pt-4 md:pt-8 text-center">
            <img src="assets/images/logo nitflix.png" alt="NETFLIX" class="logo h-12 sm:h-16 md:h-20 lg:h-24 mx-auto">
        </div>

        <!-- Questionnaire Modal -->
        <div class="relative z-20 flex items-center justify-center h-full p-4 pb-20 modal-container">
            <div class="w-full max-w-sm sm:max-w-md lg:max-w-lg">
                <!-- Modal Container -->
                <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-2xl sm:rounded-3xl border border-red-800 border-opacity-50 p-4 sm:p-6 md:p-8 shadow-2xl animate-slideUp hover:shadow-red-500/20 transition-all duration-500 modal-compact">
                    <!-- Modal Header -->
                    <div class="text-center mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-white mb-2 sm:mb-3 font-netflix">
                            Saatnya Mengisi Kuisioner
                        </h2>
                        <p class="text-gray-300 text-xs sm:text-sm leading-relaxed font-light px-2">
                            Terima kasih sudah menonton film ini. Silahkan isi data diri singkat dan klik tombol di bawah untuk melanjutkan mengisi kuisioner.
                        </p>
                    </div>

                    <!-- Form -->
                    <form id="questionnaireForm" class="space-y-3 sm:space-y-4 md:space-y-5">
                        <!-- Name Input -->
                        <div class="space-y-1 sm:space-y-2">
                            <label for="nama" class="block text-white font-medium text-xs sm:text-sm font-netflix">
                                Nama
                            </label>
                            <div class="relative group">
                                <input 
                                    type="text" 
                                    id="nama" 
                                    name="nama" 
                                    placeholder="Masukkan Nama Anda"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-gray-700 bg-opacity-80 border border-gray-600 rounded-lg sm:rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-netflix-red focus:border-transparent transition-all duration-300 backdrop-blur-sm group-hover:shadow-lg text-sm sm:text-base"
                                    required
                                >
                                <div class="absolute inset-0 rounded-lg sm:rounded-xl opacity-0 group-hover:opacity-10 bg-gradient-to-r from-netflix-red to-red-600 pointer-events-none transition-opacity duration-300"></div>
                            </div>
                        </div>

                        <!-- Age Dropdown -->
                        <div class="space-y-1 sm:space-y-2">
                            <label for="usia" class="block text-white font-medium text-xs sm:text-sm font-netflix">
                                Usia (Tahun)
                            </label>
                            <div class="relative group">
                                <select 
                                    id="usia" 
                                    name="usia"
                                    class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-gray-700 bg-opacity-80 border border-gray-600 rounded-lg sm:rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-netflix-red focus:border-transparent transition-all duration-300 backdrop-blur-sm appearance-none cursor-pointer group-hover:shadow-lg text-sm sm:text-base"
                                    required
                                >
                                    <option value="" class="text-gray-400">Pilih Rentang Usia</option>
                                    <option value="remaja" class="bg-gray-800">REMAJA 12 - 19 Tahun</option>
                                    <option value="dewasa_muda" class="bg-gray-800">DEWASA MUDA 20 - 30 Tahun</option>
                                    <option value="dewasa" class="bg-gray-800">DEWASA 31 - 70 Tahun</option>
                                </select>
                                <!-- Custom Dropdown Arrow -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-netflix-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 rounded-lg sm:rounded-xl opacity-0 group-hover:opacity-10 bg-gradient-to-r from-netflix-red to-red-600 pointer-events-none transition-opacity duration-300"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-gradient-to-r from-netflix-red to-red-700 hover:from-red-700 hover:to-netflix-red text-white font-bold py-3 sm:py-4 px-4 rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-netflix-red focus:ring-opacity-50 shadow-lg hover:shadow-2xl hover:shadow-red-500/50 mt-4 sm:mt-6 md:mt-8 font-netflix text-sm sm:text-base"
                        >
                            <span class="flex items-center justify-center">
                                <span>Mulai kuisioner</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-95 z-60 flex items-center justify-center hidden">
        <div class="text-center">
            <div class="inline-flex space-x-2 mb-6">
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce"></div>
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce delay-75"></div>
                <div class="w-4 h-4 bg-netflix-red rounded-full animate-bounce delay-150"></div>
            </div>
            <p class="text-white font-netflix text-lg">Memproses data Anda...</p>
        </div>
    </div>

    <script>
        // Netflix intro sequence
        document.addEventListener('DOMContentLoaded', function() {
            const intro1 = document.getElementById('intro1');
            const intro2 = document.getElementById('intro2');
            const mainContent = document.getElementById('mainContent');

            // Show intro sequence
            setTimeout(() => {
                intro1.style.opacity = '0';
                intro1.style.transition = 'opacity 1s ease-out';
                
                intro2.style.opacity = '1';
                intro2.style.transition = 'opacity 1s ease-in';
            }, 2500);

            setTimeout(() => {
                intro2.style.opacity = '0';
                intro2.style.transition = 'opacity 1s ease-out';
                
                mainContent.style.opacity = '1';
                mainContent.style.transition = 'opacity 1.5s ease-in';
            }, 5000);

            setTimeout(() => {
                intro1.style.display = 'none';
                intro2.style.display = 'none';
            }, 6500);
        });

        // Enhanced form interactions
        document.getElementById('questionnaireForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('nama').value.trim();
            const usia = document.getElementById('usia').value;
            const loadingOverlay = document.getElementById('loadingOverlay');

            if (!nama || !usia) {
                showNotification('Mohon lengkapi semua field!', 'error');
                return;
            }

            if (nama.length < 2) {
                showNotification('Nama minimal 2 karakter!', 'error');
                return;
            }

            // Show loading
            loadingOverlay.classList.remove('hidden');

            // Send data via fetch
            const formData = new FormData();
            formData.append('nama', nama);
            formData.append('usia', usia);

            fetch('includes/process_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loadingOverlay.classList.add('hidden');
                
                if (data.status === 'success') {
                    showNotification('Data berhasil disimpan!', 'success');
                    setTimeout(() => {
                        window.location.href = 'landing_page.php';
                    }, 1500);
                } else {
                    showNotification(data.message || 'Terjadi kesalahan!', 'error');
                }
            })
            .catch(error => {
                loadingOverlay.classList.add('hidden');
                console.error('Error:', error);
                showNotification('Terjadi kesalahan koneksi!', 'error');
            });
        });

        // Enhanced input animations
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('scale-105', 'shadow-xl', 'shadow-red-500/20');
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.classList.remove('scale-105', 'shadow-xl', 'shadow-red-500/20');
                this.parentElement.style.transform = 'translateY(0)';
            });

            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.add('ring-2', 'ring-green-500', 'ring-opacity-50');
                    this.classList.remove('ring-red-500');
                } else {
                    this.classList.remove('ring-green-500', 'ring-red-500');
                }
            });
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';
            
            notification.className = `fixed top-5 right-5 ${bgColor} text-white px-6 py-4 rounded-xl shadow-xl z-50 transform translate-x-full transition-all duration-300 backdrop-blur-lg`;
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        ${type === 'success' ? 
                            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>'
                        }
                    </div>
                    <span class="font-medium">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        // Add hover effects to form container
        document.addEventListener('mousemove', function(e) {
            const modal = document.querySelector('.bg-black.bg-opacity-80');
            if (modal) {
                const rect = modal.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                
                modal.style.background = `
                    radial-gradient(circle at ${x}% ${y}%, rgba(229, 9, 20, 0.15) 0%, rgba(0, 0, 0, 0.85) 50%), 
                    rgba(0, 0, 0, 0.8)
                `;
            }
        });

        // Add floating particles effect
        function createParticles() {
            const particleCount = 15;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'fixed pointer-events-none z-0';
                particle.style.cssText = `
                    width: ${Math.random() * 4 + 1}px;
                    height: ${Math.random() * 4 + 1}px;
                    background: rgba(229, 9, 20, ${Math.random() * 0.5 + 0.2});
                    border-radius: 50%;
                    left: ${Math.random() * 100}vw;
                    top: ${Math.random() * 100}vh;
                    animation: float ${Math.random() * 20 + 10}s infinite linear;
                    transform: translateY(${Math.random() * 100}px);
                `;
                document.body.appendChild(particle);
            }
        }

        // Initialize particles after intro
        setTimeout(() => {
            createParticles();
        }, 6500);
    </script>
</body>
</html>