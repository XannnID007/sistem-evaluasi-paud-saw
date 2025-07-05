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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
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
            background: rgba(255, 255, 255, 0.8);
        }

        .custom-shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .nav-link-active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
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
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 sidebar-transition">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">SPK PAUD</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-4 space-y-1">
                @if (auth()->user()->isAdmin())
                    <!-- Admin Menu -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.kriteria.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.kriteria.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-list-check w-5 h-5 mr-3"></i>
                        Data Kriteria
                    </a>

                    <a href="{{ route('admin.alternatif.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.alternatif.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        Data Alternatif
                    </a>

                    <a href="{{ route('admin.penilaian.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.penilaian.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-clipboard-check w-5 h-5 mr-3"></i>
                        Data Nilai Alternatif
                    </a>

                    <a href="{{ route('admin.saw.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.saw.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-calculator w-5 h-5 mr-3"></i>
                        Data Perhitungan SAW
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-user-cog w-5 h-5 mr-3"></i>
                        Kelola User
                    </a>
                @else
                    <!-- Guru Menu -->
                    <a href="{{ route('guru.dashboard') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('guru.dashboard') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('guru.hasil.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('guru.hasil.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        Hasil Penilaian
                    </a>

                    <a href="{{ route('guru.profile.index') }}"
                        class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('guru.profile.*') ? 'nav-link-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-user-edit w-5 h-5 mr-3"></i>
                        Kelola Profile
                    </a>
                @endif
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64">
        <!-- Top Navigation -->
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900">@yield('breadcrumb', 'Dashboard')</h1>

                <div class="flex items-center space-x-4">
                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 text-sm text-gray-700 hover:text-gray-900 transition-colors">
                            <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-medium">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            @if (auth()->user()->isGuru())
                                <a href="{{ route('guru.profile.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-user-edit w-4 h-4 mr-2"></i>
                                    Profile
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease-out';
                alert.style.opacity = '0';
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
                            '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';

                        // Re-enable after 3 seconds as fallback
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }, 3000);
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
