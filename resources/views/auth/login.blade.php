<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK PAUD Flamboyan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #a16207;
            --primary-hover: #92400e;
            --primary-light: #f2e8e5;
            --primary-dark: #78350f;
            --secondary-color: #64748b;
            --text-color: #1e293b;
            --border-color: #e2e8f0;
            --background-color: #fdf8f6;
            --card-background: #ffffff;
            --input-focus: #fef3c7;
            --accent-brown: #d2bab0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--background-color) 0%, var(--primary-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--card-background);
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 25px -5px rgba(161, 98, 7, 0.1), 0 10px 10px -5px rgba(161, 98, 7, 0.04);
            border: 1px solid rgba(161, 98, 7, 0.1);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            position: relative;
            box-shadow: 0 8px 16px rgba(161, 98, 7, 0.3);
        }

        .login-logo::after {
            content: '';
            position: absolute;
            inset: 2px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            border-radius: 14px;
            pointer-events: none;
        }

        .login-logo i {
            font-size: 1.75rem;
            color: white;
            z-index: 1;
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: var(--secondary-color);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background-color: var(--card-background);
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--input-focus);
            transform: translateY(-1px);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 8px;
            font-size: 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-hover), var(--primary-dark));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(161, 98, 7, 0.4);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.3);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .alert-danger {
            background-color: #fef2f2;
            border: 2px solid #fecaca;
            color: #dc2626;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: block;
            font-weight: 500;
        }

        .school-info {
            margin-top: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary-light), rgba(161, 98, 7, 0.05));
            border-radius: 12px;
            text-align: center;
            border: 1px solid rgba(161, 98, 7, 0.1);
        }

        .school-name {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .school-tagline {
            color: var(--secondary-color);
            font-size: 0.8rem;
            font-style: italic;
            font-weight: 500;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        /* Floating particles effect */
        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: var(--accent-brown);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.1;
        }

        .particle:nth-child(1) {
            width: 6px;
            height: 6px;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 8px;
            height: 8px;
            left: 20%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 4px;
            height: 4px;
            left: 70%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 10px;
            height: 10px;
            left: 80%;
            animation-delay: 1s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
                max-width: 100%;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .login-logo {
                width: 60px;
                height: 60px;
            }

            .login-logo i {
                font-size: 1.5rem;
            }
        }

        /* Loading spinner */
        .spinner-border {
            width: 1.2rem;
            height: 1.2rem;
            border-width: 0.15em;
        }

        /* Enhanced animations */
        .login-container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-container">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukkan password Anda" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login" id="loginButton">
                <span id="loginText">Masuk ke Sistem</span>
                <span id="loginSpinner" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span>
                    Memproses...
                </span>
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginButton = document.getElementById('loginButton');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');

            // Show loading state
            loginButton.disabled = true;
            loginText.classList.add('d-none');
            loginSpinner.classList.remove('d-none');

            // Let the form submit normally to Laravel
            // Don't prevent default - let Laravel handle the authentication
        });

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });

        // Form validation
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');

        function validateForm() {
            const email = emailInput.value.trim();
            const password = passwordInput.value;

            if (email && password.length >= 1) {
                loginButton.disabled = false;
            } else {
                loginButton.disabled = true;
            }
        }

        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Enhanced input interactions
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Initial validation
        validateForm();

        // Add smooth transitions to particles
        document.querySelectorAll('.particle').forEach((particle, index) => {
            particle.style.animationDelay = (index * 1.5) + 's';
        });

        // Auto-hide loading state if there's an error (form didn't submit successfully)
        setTimeout(() => {
            const loginButton = document.getElementById('loginButton');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');

            if (loginButton.disabled && document.querySelector('.alert-danger')) {
                loginButton.disabled = false;
                loginText.classList.remove('d-none');
                loginSpinner.classList.add('d-none');
            }
        }, 1000);
    </script>
</body>

</html>
