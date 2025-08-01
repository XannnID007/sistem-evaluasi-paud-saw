<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK PAUD Flamboyan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdf8f6',
                            100: '#f2e8e5',
                            200: '#eaddd7',
                            300: '#e0cfc6',
                            400: '#d2bab0',
                            500: '#a16207',
                            600: '#92400e',
                            700: '#78350f',
                            800: '#633212',
                            900: '#422006'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #fdf8f6 0%, #f2e8e5 50%, #eaddd7 100%);
            min-height: 100vh;
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(161, 98, 7, 0.1);
            box-shadow: 0 20px 25px -5px rgba(161, 98, 7, 0.1), 0 10px 10px -5px rgba(161, 98, 7, 0.04);
        }

        .logo-gradient {
            background: linear-gradient(135deg, #a16207, #92400e);
            box-shadow: 0 8px 16px rgba(161, 98, 7, 0.3);
        }

        .input-focus:focus {
            border-color: #a16207;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #a16207, #92400e);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #92400e, #78350f);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(161, 98, 7, 0.4);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(161, 98, 7, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            right: 15%;
            top: 30%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            bottom: 30%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            right: 70%;
            bottom: 20%;
            animation-delay: 3s;
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

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Login Card - Compact Size -->
    <div class="login-card rounded-2xl p-8 w-full max-w-md fade-in">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="logo-gradient w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-graduation-cap text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-primary-700 mb-2">Selamat Datang</h1>
            <p class="text-primary-600 text-sm">SPK PAUD Flamboyan</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <span class="text-sm">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-primary-500"></i>Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="masukkan email Anda"
                    class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none transition-all @error('email') border-red-300 @enderror"
                    required autofocus>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-primary-500"></i>Password
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="masukkan password Anda"
                        class="input-focus w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none transition-all @error('password') border-red-300 @enderror"
                        required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary-600 transition-colors">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="btn-primary w-full py-3 px-4 text-white font-semibold rounded-lg transition-all focus:outline-none focus:ring-4 focus:ring-primary-200">
                <span id="loginText">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
                </span>
                <span id="loginSpinner" class="hidden">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
                </span>
            </button>
        </form>
    </div>

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
        document.querySelector('form').addEventListener('submit', function(e) {
            const loginButton = document.querySelector('button[type="submit"]');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');

            // Show loading state
            loginButton.disabled = true;
            loginText.classList.add('hidden');
            loginSpinner.classList.remove('hidden');
        });

        // Form validation
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginButton = document.querySelector('button[type="submit"]');

        function validateForm() {
            const email = emailInput.value.trim();
            const password = passwordInput.value;

            loginButton.disabled = !(email && password.length >= 1);
        }

        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Enhanced input interactions
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Initial validation
        validateForm();

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });

        // Enhanced error handling
        @if ($errors->any())
            setTimeout(() => {
                const loginButton = document.querySelector('button[type="submit"]');
                const loginText = document.getElementById('loginText');
                const loginSpinner = document.getElementById('loginSpinner');

                if (loginButton.disabled) {
                    loginButton.disabled = false;
                    loginText.classList.remove('hidden');
                    loginSpinner.classList.add('hidden');
                }
            }, 500);
        @endif
    </script>
</body>

</html>
