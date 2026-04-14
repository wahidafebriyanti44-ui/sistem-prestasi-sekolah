<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Prestasi Siswa') - {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Top Navigation -->
        <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <!-- Left side -->
                    <div class="flex items-center justify-start">
                        <button id="toggleSidebar" class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold flex items-center ml-2 lg:ml-0">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-2 rounded-lg mr-2">
                                <i class="fas fa-medal"></i>
                            </div>
                            <span class="hidden sm:inline bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Sistem Prestasi Siswa</span>
                        </a>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center gap-3">
                        <!-- School Info -->
                        @if(isset($currentSchool))
                        <div class="hidden md:flex items-center bg-blue-50 px-4 py-2 rounded-full">
                            <i class="fas fa-school text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium text-blue-700">{{ $currentSchool->name }}</span>
                        </div>
                        @endif

                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 text-sm bg-white border border-gray-200 rounded-full p-1 pr-3 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center text-white font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:inline font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 z-50 border" x-cloak>
                                <div class="px-4 py-3 border-b">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->email }}</p>
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-medium rounded-full 
                                        @if(Auth::user()->role == 'super_admin') bg-purple-100 text-purple-800
                                        @elseif(Auth::user()->role == 'admin_sekolah') bg-blue-100 text-blue-800
                                        @elseif(Auth::user()->role == 'guru') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ str_replace('_', ' ', ucfirst(Auth::user()->role)) }}
                                    </span>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user w-5 text-gray-500 mr-3"></i>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed left-0 top-0 z-20 w-64 h-screen pt-16 bg-white border-r border-gray-200 transition-transform -translate-x-full lg:translate-x-0">
            <div class="h-full px-3 pb-4 overflow-y-auto">
                <!-- User Info Mobile -->
                <div class="lg:hidden p-4 mb-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                </div>

                <!-- Menu Items -->
                <ul class="space-y-2 font-medium">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-home w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->role == 'super_admin')
                    <!-- Super Admin Menu -->
                    <li class="pt-4 mt-2 border-t">
                        <span class="text-xs font-semibold text-gray-500 px-3">SUPER ADMIN</span>
                    </li>
                    <li>
                        <a href="{{ route('schools.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('schools.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-building w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Kelola Sekolah</span>
                        </a>
                    </li>
                    @endif

                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                    <!-- Admin Menu -->
                    <li class="pt-4 mt-2 border-t">
                        <span class="text-xs font-semibold text-gray-500 px-3">MANAJEMEN</span>
                    </li>
                    @endif

                    <!-- Kelas -->
                    <li>
                        <a href="{{ route('kelas.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('kelas.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-school w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Kelas</span>
                        </a>
                    </li>

                    <!-- Siswa -->
                    <li>
                        <a href="{{ route('siswa.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('siswa.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-users w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Siswa</span>
                            @if(isset($totalSiswa) && $totalSiswa > 0)
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">{{ $totalSiswa }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Prestasi -->
                    <li>
                        <a href="{{ route('prestasi.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('prestasi.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-trophy w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Prestasi</span>
                            @if(isset($pendingPrestasi) && $pendingPrestasi > 0)
                            <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded-full">{{ $pendingPrestasi }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Ekstrakurikuler -->
                    <li>
                        <a href="{{ route('eskul.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('eskul.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-futbol w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Ekstrakurikuler</span>
                        </a>
                    </li>

                    <!-- Minat Bakat -->
                    <li>
                        <a href="{{ route('minat-bakat.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-gray-100 group transition-all duration-200 {{ request()->routeIs('minat-bakat.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                            <i class="fas fa-heart w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                            <span class="ml-3">Minat & Bakat</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="lg:ml-64 pt-16 p-4 md:p-6 transition-all duration-200">
            <!-- Page Header -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-600 mt-1">@yield('page-subtitle', 'Selamat datang di Sistem Informasi Prestasi Siswa')</p>
                    </div>
                    <div>
                        @yield('page-actions')
                    </div>
                </div>
            </div>

            <!-- Breadcrumb -->
            @hasSection('breadcrumb')
            <div class="mb-4">
                @yield('breadcrumb')
            </div>
            @endif

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center justify-between" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center justify-between" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('toggleSidebar')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>

    <!-- Alpine.js for dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>
</html>