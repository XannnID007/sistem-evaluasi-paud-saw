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
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --danger-color: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 30%),
                radial-gradient(circle at 80% 20%, rgba(37, 99, 235, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 40% 80%, rgba(96, 165, 250, 0.2) 0%, transparent 30%);
            animation: backgroundMove 20s ease-in-out infinite;
        }

        @keyframes backgroundMove {

            0%,
            100% {
                transform: translateX(0) translateY(0);
            }

            25% {
                transform: translateX(-20px) translateY(-10px);
            }

            50% {
                transform: translateX(20px) translateY(-20px);
            }

            75% {
                transform: translateX(-10px) translateY(10px);
            }
        }

        /* Floating Elements */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            background: rgba(59, 130, 246, 0.1);
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            background: rgba(37, 99, 235, 0.08);
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            background: rgba(96, 165, 250, 0.12);
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 20%;
            background: rgba(147, 197, 253, 0.1);
            animation-delay: 1s;
        }

        .shape:nth-child(5) {
            width: 140px;
            height: 140px;
            top: 60%;
            left: 5%;
            background: rgba(59, 130, 246, 0.06);
            animation-delay: 3s;
        }

        .shape:nth-child(6) {
            width: 90px;
            height: 90px;
            top: 80%;
            right: 30%;
            background: rgba(37, 99, 235, 0.09);
            animation-delay: 5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-30px) translateX(10px) rotate(90deg);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-20px) translateX(-15px) rotate(180deg);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-40px) translateX(5px) rotate(270deg);
                opacity: 0.7;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.1),
                0 8px 32px rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 10;
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), #3b82f6, #60a5fa);
            border-radius: 24px 24px 0 0;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--primary-color), #3b82f6);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow:
                0 10px 30px rgba(37, 99, 235, 0.3),
                0 0 0 10px rgba(37, 99, 235, 0.05);
            position: relative;
            animation: logoGlow 3s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            from {
                box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3), 0 0 0 10px rgba(37, 99, 235, 0.05);
            }

            to {
                box-shadow: 0 15px 40px rgba(37, 99, 235, 0.4), 0 0 0 15px rgba(37, 99, 235, 0.1);
            }
        }

        .login-logo i {
            font-size: 2.2rem;
            color: white;
        }

        @keyframes iconBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .login-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #1e293b, var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: var(--secondary-color);
            font-size: 1rem;
            margin-bottom: 0;
            font-weight: 500;
        }

        .form-floating {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: white;
            transform: translateY(-2px);
        }

        .form-floating>label {
            color: var(--secondary-color);
            font-weight: 500;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .form-control:focus~label,
        .form-control:not(:placeholder-shown)~label {
            color: var(--primary-color);
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            z-index: 5;
            transition: color 0.3s ease;
            padding: 8px;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #3b82f6, #60a5fa);
            border: none;
            border-radius: 16px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
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
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(37, 99, 235, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login:disabled {
            background: #94a3b8;
            transform: none;
            box-shadow: none;
            cursor: not-allowed;
        }

        .alert {
            border: none;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            backdrop-filter: blur(10px);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-info {
            color: var(--secondary-color);
            font-size: 0.875rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .school-info {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(96, 165, 250, 0.05));
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            text-align: center;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .school-name {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .school-tagline {
            color: var(--secondary-color);
            font-size: 0.85rem;
            font-style: italic;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
                border-radius: 20px;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .login-logo {
                width: 70px;
                height: 70px;
            }

            .login-logo i {
                font-size: 1.8rem;
            }
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        /* Ripple Effect */
        .btn-login {
            position: relative;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-effect 0.6s linear;
        }

        @keyframes ripple-effect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
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

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating password-container">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password" required>
                <label for="password">Password</label>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="passwordIcon"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login" id="loginButton" onclick="createRipple(event)">
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

        // Ripple effect for button
        function createRipple(event) {
            const button = event.currentTarget;
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            button.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginButton = document.getElementById('loginButton');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');

            loginButton.disabled = true;
            loginText.classList.add('d-none');
            loginSpinner.classList.remove('d-none');
        });

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();

            // Add animation delay to form elements
            const formElements = document.querySelectorAll('.form-floating, .btn-login');
            formElements.forEach((element, index) => {
                element.style.animationDelay = `${0.2 + index * 0.1}s`;
                element.style.animation = 'slideInUp 0.6s ease-out forwards';
                element.style.opacity = '0';
            });
        });

        // Form validation with live feedback
        const form = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function validateForm() {
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const loginButton = document.getElementById('loginButton');

            if (email && password) {
                loginButton.disabled = false;
                loginButton.style.opacity = '1';
            } else {
                loginButton.disabled = true;
                loginButton.style.opacity = '0.6';
            }
        }

        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Initial validation
        validateForm();

        // Enhanced input animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>

</html>
