@include('layout-lp.head')

<div id="app" class="flex h-screen">
    <!-- Sidebar -->
    @auth
        <div id="sidebar"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-sm transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:static md:inset-0">
            <!-- Hamburger Menu -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center space-x-2">
                    <a href=""><img src="{{ asset('assets/logo.png') }}" alt="" class="w-8 h-8"></a>
                    <span class="text-xl font-semibold text-gray-800">TK ASY-SYIFA 2</span>
                </div>
                <button id="close-sidebar" class="md:hidden text-gray-700 focus:outline-none" aria-label="Close sidebar">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <!-- Navigation -->
            <aside class="w-64 bg-white p-5">
                <nav class="flex flex-col gap-4     ">
                    @hasanyrole('Admin')
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-tachometer-alt w-6 text-center"></i>
                        <span class="flex-1">Dashboard</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-users-cog w-6 text-center"></i>
                        <span class="flex-1">Manage Users</span>
                    </a>
                    <a href="{{ route('roles.index') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-user-shield w-6 text-center"></i>
                        <span class="flex-1">Manage Role</span>
                    </a>
                    <a href="{{ route('pendaftaran.index') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-file-alt w-6 text-center"></i>
                        <span class="flex-1">Manage Pendaftaran</span>
                    </a>
                    <a href="{{ route('daftar-ulang.index') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-file-alt w-6 text-center"></i>
                        <span class="flex-1">Manage Daftar Ulang</span>
                    </a>
                    @endhasanyrole
                    <a href="{{ route('monitoringperkembangan.index') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-chart-line w-6 text-center"></i>
                        <span class="flex-1">Monitoring Perkembangan</span>
                    </a>
                    @unlessrole('Admin|Guru')
                    <a href="{{ route('daftar-ulang.create') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-clipboard-list w-6 text-center"></i>
                        <span class="flex-1">Daftar Ulang</span>
                    </a>
                    @endunlessrole
                    <!-- <a href="{{ route('change.password.form') }}" class="flex items-center gap-4 text-gray-700 hover:text-blue-500 py-2">
                        <i class="fas fa-key w-6 text-center"></i>
                        <span class="flex-1">Ganti Password</span>
                    </a> -->
                    @auth
                        <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="flex items-center gap-4 w-full text-left text-red-600 hover:text-red-800 py-2">
                                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                                <span class="flex-1">Logout</span>
                            </button>
                        </form> -->
                    @endauth
                </nav>
            </aside>
        </div>
    @endauth

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex items-center justify-between relative">
            <!-- Hamburger (Mobile) -->
            <div class="md:hidden">
                <button id="open-sidebar" aria-label="Open sidebar">
                    <i class="fas fa-bars text-gray-700 text-xl"></i>
                </button>
            </div>
            <div class="text-lg font-semibold"></div>
            @auth
                <!-- User Dropdown -->
                <div class="relative">
                    <button id="user-menu-btn" class="flex items-center space-x-2 text-sm text-gray-600 focus:outline-none"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle text-xl text-gray-500"></i>
                        <span>Selamat Datang, {{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div id="user-dropdown"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-40 hidden">
                        <a href="{{ route('change.password.form') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-key mr-2"></i> Ganti Password
                        </a>
                        <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

<!-- JS -->
<script>
    // Hamburger menu
    const sidebar = document.getElementById('sidebar');
    const openSidebar = document.getElementById('open-sidebar');
    const closeSidebar = document.getElementById('close-sidebar');

    openSidebar?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
    });
    closeSidebar?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
    });

    // Tutup sidebar kalau klik di luar (mobile)
    document.addEventListener('click', function (e) {
        if (window.innerWidth < 768 && sidebar && !sidebar.contains(e.target) && !openSidebar.contains(e.target)) {
            sidebar.classList.add('-translate-x-full');
        }
    });

    // User dropdown
    const userBtn = document.getElementById('user-menu-btn');
    const userDropdown = document.getElementById('user-dropdown');

    userBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target) && !userBtn.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });
</script>