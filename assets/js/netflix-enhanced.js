// Netflix Enhanced Interactive Effects
class NetflixEffects {
    constructor() {
        this.init();
    }

    init() {
        this.setupParticleSystem();
        this.setupSmoothScrolling();
        this.setupAdvancedAnimations();
        this.setupInteractiveElements();
        this.setupAccessibility();
    }

    // Advanced Particle System
    setupParticleSystem() {
        const particleContainer = document.createElement('div');
        particleContainer.id = 'particle-container';
        particleContainer.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        `;
        document.body.appendChild(particleContainer);

        this.createFloatingParticles(particleContainer);
        this.createMouseFollowParticles();
    }

    createFloatingParticles(container) {
        const particleCount = window.innerWidth > 768 ? 25 : 15;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'floating-particle';
            
            const size = Math.random() * 4 + 2;
            const opacity = Math.random() * 0.6 + 0.2;
            const duration = Math.random() * 15 + 10;
            const delay = Math.random() * 5;
            
            particle.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: #E50914;
                border-radius: 50%;
                opacity: ${opacity};
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                animation: floatParticle ${duration}s ease-in-out ${delay}s infinite;
                filter: blur(${Math.random() * 1}px);
            `;
            
            container.appendChild(particle);
        }

        // Add CSS for particle animation
        if (!document.querySelector('#particle-styles')) {
            const style = document.createElement('style');
            style.id = 'particle-styles';
            style.textContent = `
                @keyframes floatParticle {
                    0%, 100% {
                        transform: translate(0, 0) rotate(0deg);
                        opacity: 0.2;
                    }
                    25% {
                        transform: translate(20px, -30px) rotate(90deg);
                        opacity: 0.8;
                    }
                    50% {
                        transform: translate(-15px, -60px) rotate(180deg);
                        opacity: 0.4;
                    }
                    75% {
                        transform: translate(-25px, -30px) rotate(270deg);
                        opacity: 0.6;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    createMouseFollowParticles() {
        const trail = [];
        const maxTrailLength = 8;

        document.addEventListener('mousemove', (e) => {
            if (trail.length >= maxTrailLength) {
                const oldParticle = trail.shift();
                oldParticle.remove();
            }

            const particle = document.createElement('div');
            particle.style.cssText = `
                position: fixed;
                width: 6px;
                height: 6px;
                background: rgba(229, 9, 20, 0.6);
                border-radius: 50%;
                pointer-events: none;
                z-index: 2;
                left: ${e.clientX - 3}px;
                top: ${e.clientY - 3}px;
                animation: fadeOut 1s ease-out forwards;
            `;

            document.body.appendChild(particle);
            trail.push(particle);
        });

        // Add fade out animation
        const fadeStyle = document.createElement('style');
        fadeStyle.textContent = `
            @keyframes fadeOut {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }
                100% {
                    opacity: 0;
                    transform: scale(0);
                }
            }
        `;
        document.head.appendChild(fadeStyle);
    }

    // Smooth Scrolling
    setupSmoothScrolling() {
        // Enable smooth scrolling for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Advanced Animations
    setupAdvancedAnimations() {
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Logo entrance animation
        this.animateLogoEntrance();
    }

    animateLogoEntrance() {
        const logos = document.querySelectorAll('#intro1 img, #intro2 img');
        logos.forEach((logo, index) => {
            logo.addEventListener('load', () => {
                logo.style.opacity = '0';
                logo.style.transform = 'scale(0.5) rotate(-180deg)';
                
                setTimeout(() => {
                    logo.style.transition = 'all 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                    logo.style.opacity = '1';
                    logo.style.transform = 'scale(1) rotate(0deg)';
                }, index * 500);
            });
        });
    }

    // Interactive Elements
    setupInteractiveElements() {
        // Enhanced button interactions
        document.querySelectorAll('button, .interactive').forEach(button => {
            button.addEventListener('mouseenter', this.createRippleEffect);
            button.addEventListener('click', this.createClickEffect);
        });

        // Form field enhancements
        document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('focus', this.enhanceFocusEffect);
            field.addEventListener('blur', this.enhanceBlurEffect);
            field.addEventListener('input', this.enhanceInputEffect);
        });

        // Modal interactions
        this.setupModalInteractions();
    }

    createRippleEffect(e) {
        const button = e.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;

        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        button.style.position = 'relative';
        button.style.overflow = 'hidden';
        button.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    }

    createClickEffect(e) {
        const button = e.currentTarget;
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
            button.style.transform = '';
        }, 150);
    }

    enhanceFocusEffect(e) {
        const field = e.currentTarget;
        field.style.transform = 'scale(1.02)';
        field.style.boxShadow = '0 0 0 3px rgba(229, 9, 20, 0.2)';
    }

    enhanceBlurEffect(e) {
        const field = e.currentTarget;
        field.style.transform = 'scale(1)';
        field.style.boxShadow = '';
    }

    enhanceInputEffect(e) {
        const field = e.currentTarget;
        const value = field.value;
        
        if (value) {
            field.classList.add('has-content');
        } else {
            field.classList.remove('has-content');
        }

        // Real-time validation visual feedback
        if (field.type === 'text' && field.name === 'nama') {
            if (value.length >= 2) {
                field.style.borderColor = '#10B981';
            } else if (value.length > 0) {
                field.style.borderColor = '#EF4444';
            }
        }
    }

    setupModalInteractions() {
        const modal = document.querySelector('.modal-content, .bg-black.bg-opacity-80');
        if (modal) {
            // 3D tilt effect
            modal.addEventListener('mousemove', (e) => {
                const rect = modal.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width;
                const y = (e.clientY - rect.top) / rect.height;
                
                const tiltX = (y - 0.5) * 10;
                const tiltY = (x - 0.5) * -10;
                
                modal.style.transform = `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
            });

            modal.addEventListener('mouseleave', () => {
                modal.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        }
    }

    // Accessibility Features
    setupAccessibility() {
        // Keyboard navigation
        this.setupKeyboardNavigation();
        
        // Screen reader support
        this.enhanceScreenReaderSupport();
        
        // Reduced motion support
        this.handleReducedMotion();
    }

    setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // Tab navigation enhancement
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-nav');
            }
            
            // Escape key functionality
            if (e.key === 'Escape') {
                const activeModal = document.querySelector('.modal-open');
                if (activeModal) {
                    activeModal.classList.remove('modal-open');
                }
            }
        });

        document.addEventListener('mousedown', () => {
            document.body.classList.remove('keyboard-nav');
        });
    }

    enhanceScreenReaderSupport() {
        // Add ARIA labels where missing
        document.querySelectorAll('input:not([aria-label]):not([aria-labelledby])').forEach(input => {
            const label = input.previousElementSibling;
            if (label && label.tagName === 'LABEL') {
                input.setAttribute('aria-labelledby', label.id || 'label-' + Math.random().toString(36).substr(2, 9));
            }
        });

        // Announce dynamic content changes
        this.createLiveRegion();
    }

    createLiveRegion() {
        const liveRegion = document.createElement('div');
        liveRegion.id = 'live-region';
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.style.cssText = `
            position: absolute;
            left: -10000px;
            width: 1px;
            height: 1px;
            overflow: hidden;
        `;
        document.body.appendChild(liveRegion);

        // Function to announce messages
        window.announceToScreenReader = (message) => {
            liveRegion.textContent = message;
            setTimeout(() => {
                liveRegion.textContent = '';
            }, 1000);
        };
    }

    handleReducedMotion() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.style.setProperty('--animation-duration', '0.01ms');
            document.documentElement.style.setProperty('--transition-duration', '0.01ms');
        }
    }

    // Performance optimization
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    debounce(func, delay) {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }
}

// Enhanced Form Validation
class NetflixFormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        this.init();
    }

    init() {
        if (!this.form) return;
        
        this.setupValidation();
        this.setupRealTimeValidation();
    }

    setupValidation() {
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.validateForm();
        });
    }

    setupRealTimeValidation() {
        const inputs = this.form.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearFieldError(input));
        });
    }

    validateForm() {
        const fields = this.form.querySelectorAll('[required]');
        let isValid = true;

        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        if (isValid) {
            this.submitForm();
        }
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;

        switch (fieldName) {
            case 'nama':
                return this.validateName(field, value);
            case 'usia':
                return this.validateAge(field, value);
            default:
                return this.validateRequired(field, value);
        }
    }

    validateName(field, value) {
        if (!value) {
            this.showFieldError(field, 'Nama wajib diisi');
            return false;
        }
        if (value.length < 2) {
            this.showFieldError(field, 'Nama minimal 2 karakter');
            return false;
        }
        if (value.length > 50) {
            this.showFieldError(field, 'Nama maksimal 50 karakter');
            return false;
        }
        if (!/^[a-zA-Z\s]+$/.test(value)) {
            this.showFieldError(field, 'Nama hanya boleh mengandung huruf dan spasi');
            return false;
        }
        
        this.showFieldSuccess(field);
        return true;
    }

    validateAge(field, value) {
        if (!value) {
            this.showFieldError(field, 'Usia wajib dipilih');
            return false;
        }
        
        this.showFieldSuccess(field);
        return true;
    }

    validateRequired(field, value) {
        if (!value) {
            this.showFieldError(field, 'Field ini wajib diisi');
            return false;
        }
        
        this.showFieldSuccess(field);
        return true;
    }

    showFieldError(field, message) {
        this.clearFieldError(field);
        
        field.classList.add('error');
        field.style.borderColor = '#EF4444';
        
        const errorElement = document.createElement('div');
        errorElement.className = 'field-error';
        errorElement.textContent = message;
        errorElement.style.cssText = `
            color: #EF4444;
            font-size: 12px;
            margin-top: 4px;
            animation: slideInError 0.3s ease-out;
        `;
        
        field.parentNode.appendChild(errorElement);
    }

    showFieldSuccess(field) {
        this.clearFieldError(field);
        
        field.classList.add('success');
        field.style.borderColor = '#10B981';
    }

    clearFieldError(field) {
        field.classList.remove('error', 'success');
        field.style.borderColor = '';
        
        const errorElement = field.parentNode.querySelector('.field-error');
        if (errorElement) {
            errorElement.remove();
        }
    }

    submitForm() {
        // Implementation for form submission
        console.log('Form is valid, submitting...');
    }
}

// Netflix Audio Manager
class NetflixAudioManager {
    constructor() {
        this.audioContext = null;
        this.sounds = {};
        this.init();
    }

    init() {
        // Add subtle sound effects for interactions
        this.loadSounds();
        this.setupAudioControls();
    }

    loadSounds() {
        // Netflix-style UI sounds (you would load actual audio files)
        this.sounds = {
            hover: this.createTone(800, 0.1, 0.05),
            click: this.createTone(1000, 0.1, 0.1),
            success: this.createTone(600, 0.3, 0.2),
            error: this.createTone(400, 0.3, 0.2)
        };
    }

    createTone(frequency, duration, volume) {
        return () => {
            if (!this.audioContext) {
                this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            }

            const oscillator = this.audioContext.createOscillator();
            const gainNode = this.audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(this.audioContext.destination);

            oscillator.frequency.setValueAtTime(frequency, this.audioContext.currentTime);
            gainNode.gain.setValueAtTime(volume, this.audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, this.audioContext.currentTime + duration);

            oscillator.start(this.audioContext.currentTime);
            oscillator.stop(this.audioContext.currentTime + duration);
        };
    }

    setupAudioControls() {
        // Add audio feedback to interactive elements
        document.addEventListener('click', (e) => {
            if (e.target.matches('button, .interactive')) {
                this.playSound('click');
            }
        });

        document.addEventListener('mouseenter', (e) => {
            if (e.target.matches('button, .interactive')) {
                this.playSound('hover');
            }
        }, true);
    }

    playSound(soundName) {
        if (this.sounds[soundName]) {
            this.sounds[soundName]();
        }
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Netflix effects
    new NetflixEffects();
    
    // Initialize form validator
    new NetflixFormValidator('#questionnaireForm');
    
    // Initialize audio manager (optional)
    // new NetflixAudioManager();
    
    // Add custom styles for enhanced animations
    const enhancedStyles = document.createElement('style');
    enhancedStyles.textContent = `
        .animate-in {
            animation: slideInUp 0.6s ease-out forwards;
        }
        
        .keyboard-nav *:focus {
            outline: 3px solid #E50914 !important;
            outline-offset: 2px !important;
        }
        
        @keyframes slideInError {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .has-content {
            background-color: rgba(64, 64, 64, 0.9) !important;
        }
        
        .field-error {
            animation: slideInError 0.3s ease-out;
        }
    `;
    document.head.appendChild(enhancedStyles);
});