<div class="bg-lime-600 text-zinc-100 fixed w-full top-0 z-50 font-bold">
    <div class="flex items-center justify-between h-10 px-4 text-sm">
        <div class="flex items-center">
            <i class="fas fa-graduation-cap mr-2"></i>
            <span class="sm:inline">Akreditasi A</span>
        </div>
        <div id="waktuWIB" class="text-xs sm:text-sm font-medium"></div>
    </div>
</div>

<nav class="bg-gray-100 fixed w-full top-10 z-40 border-b" id="navbar">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16 sm:h-20">
            <div class="flex items-center space-x-2 sm:space-x-3">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo TK ASY-SYIFA 2" class="h-10 sm:h-12 lg:h-16">
                <h1 class="font-bold text-base sm:text-lg lg:text-2xl text-gray-800">TK ASY-SYIFA 2</h1>
            </div>

            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="text-zinc-800 hover:text-lime-600 font-medium transition-colors">Beranda</a>

                <div class="dropdown relative">
                    <button class="text-zinc-800 hover:text-lime-600 font-medium flex items-center transition-colors">
                        Tentang <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden bg-white shadow-lg py-2 w-48 top-full left-0 border-t-2 border-lime-600">
                        <a href="{{ route('tentang.sejarah') }}" class="block px-4 py-2 text-zinc-800 hover:bg-gray-100 hover:text-lime-600">Sejarah</a>
                        <a href="{{ route('tentang.visimisi') }}" class="block px-4 py-2 text-zinc-800 hover:bg-gray-100 hover:text-lime-600">Visi dan Misi</a>
                    </div>
                </div>

                <div class="dropdown relative">
                    <button class="text-zinc-800 hover:text-lime-600 font-medium flex items-center transition-colors">
                        Informasi <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden bg-white shadow-lg py-2 w-56 top-full left-0 border-t-2 border-lime-600">
                        <a href="{{ route('informasi.kalender') }}" class="block px-4 py-2 text-zinc-800 hover:bg-gray-100 hover:text-lime-600">Kalender Kegiatan</a>

                        <div class="nested-dropdown">
                            <button class="w-full text-left px-4 py-2 text-zinc-800 hover:bg-gray-100 hover:text-lime-600 flex items-center justify-between">
                                Galeri <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                            <div class="nested-dropdown-menu absolute hidden bg-white shadow-lg py-2 border-t-2 border-lime-600">
                                <a href="{{ route('informasi.kegiatan') }}" class="block px-4 py-2 text-zinc-800 hover:bg-gray-100 hover:text-lime-600 whitespace-nowrap">Kegiatan</a>
                            </div>
                        </div>

                    </div>
                </div>

                <a href="{{ route('informasi.ppdb') }}" class="text-zinc-800 hover:text-lime-600 font-medium transition-colors">PPDB</a>
                <a href="#kontak" onclick="scrollToSection(event, 'kontak')" class="text-zinc-800 hover:text-lime-600 font-medium transition-colors">Kontak</a>
                {{-- ICON LOGIN BARU --}}
                <a href="{{ route('login') }}" class="text-zinc-800 hover:text-lime-600 font-medium transition-colors" aria-label="Login">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                </a>
            </div>

            <button id="mobileMenuBtn" class="lg:hidden p-2 text-zinc-800" aria-label="Toggle menu">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div id="mobileMenu" class="lg:hidden mobile-menu bg-white border-t">
            <div class="py-2">
                <a href="/" class="block px-4 py-3 text-zinc-800 hover:bg-gray-100">Beranda</a>

                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-btn w-full text-left px-4 py-3 text-zinc-800 hover:bg-gray-100 flex justify-between items-center">
                        Tentang <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="mobile-dropdown-content bg-gray-50">
                        <a href="{{ route('tentang.sejarah') }}" class="block px-8 py-2 text-gray-800 hover:bg-gray-100">Sejarah</a>
                        <a href="{{ route('tentang.visimisi') }}" class="block px-8 py-2 text-gray-800 hover:bg-gray-100">Visi dan Misi</a>
                    </div>
                </div>

                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-btn w-full text-left px-4 py-3 text-zinc-800 hover:bg-gray-100 flex justify-between items-center">
                        Informasi <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="mobile-dropdown-
                        <a href="{{ route('informasi.kalender') }}" class="block px-8 py-2 text-gray-800 hover:bg-gray-100">Kalender Kegiatan</a>

                        <div class="mobile-dropdown ml-4">
                            <button class="mobile-dropdown-btn w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 flex justify-between items-center">
                                Galeri <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="mobile-dropdown-content bg-gray-100">
                                <a href="{{ route('informasi.kegiatan') }}" class="block px-12 py-2 text-gray-800 hover:bg-gray-200">Kegiatan</a>
                            </div>
                        </div>

                    </div>
                </div>
                
                <a href="{{ route('informasi.ppdb') }}" class="block px-4 py-3 text-zinc-800 hover:bg-gray-100">PPDB</a>
                <a href="#kontak" onclick="scrollToSection(event, 'kontak')" class="block px-4 py-3 text-zinc-800 hover:bg-gray-100">Kontak</a>
                {{-- ICON LOGIN BARU UNTUK MOBILE --}}
                <a href="{{ route('login') }}" class="block px-4 py-3 text-zinc-800 hover:bg-gray-100 items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>