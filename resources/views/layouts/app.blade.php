<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPK PAUD Flamboyan')</title>
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
                        },
                        brown: {
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
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .custom-shadow {
            box-shadow: 0 4px 6px -1px rgba(161, 98, 7, 0.1), 0 2px 4px -1px rgba(161, 98, 7, 0.06);
        }

        .nav-link-active {
            background: linear-gradient(135deg, #a16207, #92400e);
            color: white;
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.3);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced sidebar styling */
        .sidebar {
            background: linear-gradient(180deg, #fdf8f6 0%, #ffffff 50%, #f2e8e5 100%);
            border-right: 1px solid rgba(161, 98, 7, 0.1);
        }

        .sidebar-logo {
            background: linear-gradient(135deg, #a16207, #92400e);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.3);
        }

        .nav-link {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 0;
        }

        .nav-link:hover:not(.nav-link-active) {
            background: linear-gradient(135deg, rgba(161, 98, 7, 0.1), rgba(161, 98, 7, 0.05));
            color: #92400e;
            transform: translateX(4px);
        }

        /* Header styling */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(161, 98, 7, 0.1);
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #a16207, #92400e);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #92400e, #78350f);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(161, 98, 7, 0.4);
        }

        .btn-secondary {
            border: 2px solid #a16207;
            color: #a16207;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #a16207;
            color: white;
            transform: translateY(-1px);
        }

        /* Card enhancements */
        .card-enhanced {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(161, 98, 7, 0.1);
            box-shadow: 0 4px 16px rgba(161, 98, 7, 0.08);
            transition: all 0.3s ease;
        }

        .card-enhanced:hover {
            box-shadow: 0 8px 24px rgba(161, 98, 7, 0.15);
            transform: translateY(-2px);
        }

        /* Alert styles */
        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #ecfdf5);
            border: 1px solid #10b981;
            color: #065f46;
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2, #fef2f2);
            border: 1px solid #ef4444;
            color: #dc2626;
        }

        /* Form enhancements */
        .form-control:focus {
            border-color: #a16207;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
        }

        /* User avatar styling */
        .user-avatar {
            background: linear-gradient(135deg, #a16207, #92400e);
            color: white;
        }

        /* Dropdown styling */
        .dropdown-menu {
            border: 1px solid rgba(161, 98, 7, 0.1);
            box-shadow: 0 8px 24px rgba(161, 98, 7, 0.15);
        }

        .dropdown-item:hover {
            background: rgba(161, 98, 7, 0.1);
            color: #92400e;
        }

        /* Loading states */
        .loading-overlay {
            background: rgba(161, 98, 7, 0.1);
        }

        /* Responsive enhancements */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 sidebar sidebar-transition">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 border-b border-brown-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 sidebar-logo rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div class="text-left">
                        <span class="text-lg font-bold text-brown-700">SPK PAUD</span>
                        <div class="text-xs text-brown-600">Flamboyan</div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                @if (auth()->user()->isAdmin())
                    <!-- Admin Menu -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.kriteria.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.kriteria.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-list-check w-5 h-5 mr-3"></i>
                        Data Kriteria
                    </a>

                    <a href="{{ route('admin.alternatif.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.alternatif.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        Data Alternatif
                    </a>

                    <a href="{{ route('admin.penilaian.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.penilaian.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-clipboard-check w-5 h-5 mr-3"></i>
                        Data Nilai Alternatif
                    </a>

                    <a href="{{ route('admin.saw.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.saw.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-calculator w-5 h-5 mr-3"></i>
                        Data Perhitungan SAW
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-user-cog w-5 h-5 mr-3"></i>
                        Kelola User
                    </a>
                @else
                    <!-- Guru Menu -->
                    <a href="{{ route('guru.dashboard') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('guru.dashboard') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('guru.hasil.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('guru.hasil.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        Hasil Penilaian
                    </a>

                    <a href="{{ route('guru.profile.index') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('guru.profile.*') ? 'nav-link-active' : 'text-brown-700 hover:text-brown-800' }}">
                        <i class="fas fa-user-edit w-5 h-5 mr-3"></i>
                        Kelola Profile
                    </a>
                @endif
            </nav>

            <!-- Footer Info -->
            <div class="px-4 py-4 border-t border-brown-200">
                <div class="text-center">
                    <div class="text-xs text-brown-600 mb-1">🌺 PAUD Flamboyan</div>
                    <div class="text-xs text-brown-500">"Mendidik dengan Cinta"</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 main-content">
        <!-- Top Navigation -->
        <header class="header px-6 py-4 sticky top-0 z-40">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden p-2 rounded-lg text-brown-600 hover:bg-brown-100" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-brown-800">@yield('breadcrumb', 'Dashboard')</h1>
                        <div class="text-sm text-brown-600">{{ now()->format('l, d F Y') }}</div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 text-sm text-brown-700 hover:text-brown-900 transition-colors p-2 rounded-lg hover:bg-brown-100">
                            <div class="w-9 h-9 user-avatar rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">
                                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                                </span>
                            </div>
                            <div class="text-left hidden sm:block">
                                <div class="font-medium">{{ auth()->user()->nama }}</div>
                                <div class="text-xs text-brown-600">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-brown-200 py-2 z-50 dropdown-menu">

                            <div class="px-4 py-3 border-b border-brown-100">
                                <div class="text-sm font-medium text-brown-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-brown-600">{{ auth()->user()->email }}</div>
                            </div>

                            @if (auth()->user()->isGuru())
                                <a href="{{ route('guru.profile.index') }}"
                                    class="dropdown-item flex items-center px-4 py-3 text-sm text-brown-700 hover:bg-brown-50 transition-colors">
                                    <i class="fas fa-user-edit w-4 h-4 mr-3"></i>
                                    Profile Settings
                                </a>
                            @endif

                            <div class="border-t border-brown-100 mt-2 pt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item w-full text-left flex items-center px-4 py-3 text-sm text-brown-700 hover:bg-brown-50 transition-colors">
                                        <i class="fas fa-sign-out-alt w-4 h-4 mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @if (session('success'))
                <div class="mb-6 alert-success px-4 py-3 rounded-xl border fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 alert-error px-4 py-3 rounded-xl border fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile sidebar overlay -->
    <div class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden" id="sidebarOverlay"></div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.add('hidden');
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-success, .alert-error');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Loading state for forms
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.disabled) {
                        submitBtn.disabled = true;
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML =
                            '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';

                        // Re-enable after 3 seconds as fallback
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }, 3000);
                    }
                });
            });

            // Enhanced card interactions
            document.querySelectorAll('.card-enhanced').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Smooth scroll for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
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
        });

        // Page transition effect
        window.addEventListener('beforeunload', function() {
            document.body.style.opacity = '0.7';
            document.body.style.transition = 'opacity 0.3s ease-out';
        });

        // Enhanced focus management
        document.addEventListener('keydown', function(e) {
            // Escape key to close dropdowns
            if (e.key === 'Escape') {
                document.querySelectorAll('[x-data]').forEach(el => {
                    if (el.__x) {
                        el.__x.$data.open = false;
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
