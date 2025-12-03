<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - DetikBahagia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/netflix-enhanced.css">
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
                        'pulse': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
        }
    </style>
</head>
<body class="bg-black text-white overflow-x-hidden">
    <!-- Intro Screen 1 - Single N Logo -->
    <div id="intro1" class="fixed inset-0 z-50 bg-black flex items-center justify-center">
        <div class="text-center">
            <img src="assets/images/logo n.png" alt="N Logo" class="w-32 h-32 mx-auto animate-fadeIn animate-logoGlow">
        </div>
    </div>

    <!-- Intro Screen 2 - Full NETFLIX Logo -->
    <div id="intro2" class="fixed inset-0 z-40 bg-black flex items-center justify-center opacity-0">
        <div class="text-center">
            <img src="assets/images/logo nitflix.png" alt="NETFLIX" class="h-20 mx-auto animate-fadeIn">
        </div>
    </div>

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen bg-gradient-to-br from-black via-red-950 to-black opacity-0">
        <!-- Background Effects -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-20 w-72 h-72 bg-netflix-red rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-red-900 rounded-full blur-3xl opacity-20"></div>
        </div>

        <!-- Netflix Logo Header -->
        <div class="relative z-10 pt-8 text-center">
            <h1 class="text-6xl md:text-8xl font-bold text-netflix-red tracking-wide">
                NETFLIX
            </h1>
        </div>

        <!-- Questionnaire Modal -->
        <div class="relative z-20 flex items-center justify-center min-h-screen p-4">
            <div class="w-full max-w-md">
                <!-- Modal Container -->
                <div class="bg-black bg-opacity-80 backdrop-blur-xl rounded-2xl border border-red-800 border-opacity-50 p-8 shadow-2xl animate-slideUp">
                    <!-- Modal Header -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-white mb-3">
                            Saatnya Mengisi Kuisioner
                        </h2>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Terima kasih sudah menonton film ini. Silahkan isi data diri singkat dan klik tombol di bawah untuk melanjutkan mengisi kuisioner.
                        </p>
                    </div>

                    <!-- Form -->
                    <form id="questionnaireForm" class="space-y-5">
                        <!-- Name Input -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-white font-medium text-sm">
                                Nama
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="nama" 
                                    name="nama" 
                                    placeholder="Masukkan Nama Anda"
                                    class="w-full px-4 py-3 bg-gray-700 bg-opacity-80 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-netflix-red focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Age Dropdown -->
                        <div class="space-y-2">
                            <label for="usia" class="block text-white font-medium text-sm">
                                Usia (Tahun)
                            </label>
                            <div class="relative">
                                <select 
                                    id="usia" 
                                    name="usia"
                                    class="w-full px-4 py-3 bg-gray-700 bg-opacity-80 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-netflix-red focus:border-transparent transition-all duration-300 backdrop-blur-sm appearance-none cursor-pointer"
                                    required
                                >
                                    <option value="" class="text-gray-400">Pilih Rentang Usia</option>
                                    <option value="remaja">REMAJA 12 - 19 Tahun</option>
                                    <option value="dewasa_muda">DEWASA MUDA 20 - 30 Tahun</option>
                                    <option value="dewasa">DEWASA 31 - 70 Tahun</option>
                                </select>
                                <!-- Custom Dropdown Arrow -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-netflix-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-netflix-red hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-netflix-red focus:ring-opacity-50 shadow-lg hover:shadow-xl mt-6"
                        >
                            <span class="flex items-center justify-center">
                                <span>Mulai kuisioner</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center hidden">
        <div class="text-center">
            <div class="inline-flex space-x-1 mb-4">
                <div class="w-3 h-3 bg-netflix-red rounded-full animate-pulse"></div>
                <div class="w-3 h-3 bg-netflix-red rounded-full animate-pulse delay-75"></div>
                <div class="w-3 h-3 bg-netflix-red rounded-full animate-pulse delay-150"></div>
            </div>
            <p class="text-white">Memproses data Anda...</p>
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
                mainContent.style.transition = 'opacity 1s ease-in';
            }, 5000);

            setTimeout(() => {
                intro1.style.display = 'none';
                intro2.style.display = 'none';
            }, 6000);
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

            // Simulate form processing
            setTimeout(() => {
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
                            window.location.href = 'pages/questionnaire.php';
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
            }, 1500);
        });

        // Enhanced input animations
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105', 'shadow-lg');
                this.parentElement.style.transition = 'all 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105', 'shadow-lg');
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
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            
            notification.className = `fixed top-5 right-5 ${bgColor} text-white px-6 py-3 rounded-lg shadow-xl z-50 transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
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
            }, 4000);
        }

        // Particle effect background
        function createParticles() {
            const particleContainer = document.createElement('div');
            particleContainer.className = 'fixed inset-0 pointer-events-none z-0';
            document.body.appendChild(particleContainer);

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-1 h-1 bg-netflix-red rounded-full opacity-20';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `float ${5 + Math.random() * 10}s infinite linear`;
                
                particleContainer.appendChild(particle);
            }
        }

        // Add floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px) translateX(0px);
                    opacity: 0.2;
                }
                25% {
                    transform: translateY(-20px) translateX(10px);
                    opacity: 0.4;
                }
                50% {
                    transform: translateY(0px) translateX(-10px);
                    opacity: 0.2;
                }
                75% {
                    transform: translateY(10px) translateX(5px);
                    opacity: 0.3;
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize particles after main content loads
        setTimeout(() => {
            createParticles();
        }, 6000);

        // Add hover effects to form elements
        document.addEventListener('mousemove', function(e) {
            const form = document.querySelector('.bg-black.bg-opacity-80');
            if (form) {
                const rect = form.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                form.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(229, 9, 20, 0.1), rgba(0, 0, 0, 0.9))`;
            }
        });
    </script>
    <script src="assets/js/netflix-enhanced.js"></script>
</body>
</html>
