<main class="pt-[7.5rem]">
    <section class="hero-section relative overflow-hidden">
        <video class="absolute w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="assets/bg1.mp4" type="video/mp4">
        </video>
        <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
            <div class=" text-gray-800 max-w-4xl">
                <img src="assets/logo.png" alt="Logo" class="h-16 sm:h-20 md:h-24 lg:h-28 mx-auto mb-6">
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 drop-shadow-lg leading-tight">
                    Selamat Datang di TK ASY-SYIFA 2
                </h1>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-8 drop-shadow max-w-2xl mx-auto">
                    Membentuk Generasi Cerdas, Kreatif dan Berakhlak Mulia
                </p>
                <a href="{{ route('informasi.ppdb') }}"
                    class="bg-lime-600 text-gray-50 px-4 sm:px-6 py-2 sm:py-3 rounded-full hover:bg-lime-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-sm sm:text-base inline-block">
                    Penerimaan Peserta Didik Baru
                </a>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12 lg:py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-0 bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-lime-800 p-6 lg:p-8 flex flex-col items-center justify-center">
                        <img src="assets/kepsek.jpg" alt="Sri Sektipanchaswati., S. Psi"
                            class="w-full max-w-sm rounded-lg shadow-lg mb-6">
                        <h3 class="text-gray-50 font-bold text-lg text-center">Sri Sektipanchaswati., S. Psi</h3>
                        <p class="text-gray-50 text-center text-sm mt-1">Kepala Sekolah</p>
                    </div>
                    <div class="p-6 lg:p-10">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-6">
                            Sambutan<br>Kepala Sekolah
                        </h2>
                        <div class="w-32 h-1 bg-lime-600 mb-6"></div>
                        <p class="text-gray-800 mb-6 leading-relaxed text-sm sm:text-base">
                            TK ASY-SYIFA 2 menyediakan lingkungan pembelajaran yang aman, nyaman dan mendukung
                            perkembangan anak.
                            Dengan kurikulum yang komprehensif dan tenaga pengajar yang berpengalaman, kami berkomitmen
                            untuk
                            membantu setiap anak mencapai potensi terbaiknya.
                        </p>
                        <p class="text-gray-800 leading-relaxed text-sm sm:text-base">
                            Program kami dirancang untuk mengembangkan aspek kognitif, sosial, emosional, dan motorik
                            anak melalui
                            berbagai aktivitas menarik dan edukatif.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program-sekolah" class="py-8 sm:py-12 lg:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Program Sekolah</h2>
                    <div class="w-24 h-1 bg-lime-600 mx-auto mb-4"></div>
                    <p class="text-gray-800 text-base sm:text-lg max-w-2xl mx-auto">
                        Beberapa Program unggulan kami untuk mengembangkan potensi anak secara optimal
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="h-32 sm:h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                            <img src="assets/aljabar.jpg" alt="Icon Ibadah"
                                class="sm:w-100 object-contain cursor-pointer" onclick="openModal(this)" />
                        </div>
                        <div class="bg-blue-900 text-gray-50 p-3 sm:p-4">
                            <span class="text-xs font-semibold opacity-75">#PBI</span>
                            <h3 class="font-bold text-xs sm:text-sm leading-tight mt-1">
                                Pembiasaan dan Bimbingan Ibadah
                            </h3>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="h-32 sm:h-48 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center overflow-hidden">
                            <img src="assets/otbon2.jpg" alt="Icon Ibadah"
                                class="w-full h-full object-cover cursor-pointer" onclick="openModal(this)" />
                        </div>
                        <div class="bg-purple-800 text-gray-50 p-3 sm:p-4">
                            <span class="text-xs font-semibold opacity-75">#PBI</span>
                            <h3 class="font-bold text-xs sm:text-sm leading-tight mt-1">
                                Outing Class
                            </h3>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="h-32 sm:h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center overflow-hidden">
                            <img src="assets/market1.jpg" alt="Icon Ibadah"
                                class="w-full h-full object-cover cursor-pointer" onclick="openModal(this)" />
                        </div>
                        <div class="bg-blue-600 text-gray-50 p-3 sm:p-4">
                            <span class="text-xs font-semibold opacity-75">#MD</span>
                            <h3 class="font-bold text-xs sm:text-sm leading-tight mt-1">
                                Market Day
                            </h3>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="h-32 sm:h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center overflow-hidden">
                            <img src="assets/outing1.jpg" alt="Icon Ibadah"
                                class="w-full h-full object-cover cursor-pointer" onclick="openModal(this)" />
                        </div>
                        <div class="bg-green-600 text-gray-50 p-3 sm:p-4">
                            <span class="text-xs font-semibold opacity-75">#CC</span>
                            <h3 class="font-bold text-xs sm:text-sm leading-tight mt-1">
                                Cooking Class
                            </h3>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div class="relative">
                <!-- Tombol Close -->
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 bg-white text-black rounded-full px-2 py-1 text-sm font-bold shadow-lg">
                    ✕
                </button>
                <!-- Gambar Preview -->
                <img id="modalImage" src="" alt="Preview"
                    class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-2xl" />
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12 lg:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                        Fasilitas
                    </h2>
                    <div class="w-24 h-1 bg-lime-600 mx-auto mb-4"></div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div
                        class="bg-blue-900 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-blue-800 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-school text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">3 Ruang Kelas</span>
                    </div>
                    <div
                        class="bg-purple-700 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-purple-600 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-book-open-reader text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">1 Ruang Perpustakaan</span>
                    </div>
                    <div
                        class="bg-blue-600 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-blue-500 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-user-tie text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">1 Ruang Pimpinan</span>
                    </div>
                    <div
                        class="bg-green-500 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-green-400 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-users text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">1 Ruang Guru</span>
                    </div>
                    <div
                        class="bg-blue-900 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-blue-800 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-mosque text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">1 Ruang Ibadah</span>
                    </div>
                    <div
                        class="bg-purple-700 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-purple-600 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-hospital text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">1 Ruang UKS</span>
                    </div>
                    <div
                        class="bg-blue-600 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-blue-500 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-toilet text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">2 Ruang Toilet</span>
                    </div>
                    <div
                        class="bg-green-500 text-gray-50 p-3 sm:p-4 lg:p-6 rounded-lg flex flex-col items-center justify-center text-center min-h-[80px] sm:min-h-[100px] hover:bg-green-400 transition-colors duration-300 cursor-pointer">
                        <i class="fas fa-building text-lg sm:text-2xl mb-1 sm:mb-2"></i>
                        <span class="font-medium text-xs sm:text-sm">Ruang Bangunan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function openModal(img) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            modal.classList.remove("hidden");
            modalImg.src = img.src;
        }

        function closeModal() {
            document.getElementById("imageModal").classList.add("hidden");
        }

        // Tutup modal jika klik background
        document.getElementById("imageModal").addEventListener("click", function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</main>
