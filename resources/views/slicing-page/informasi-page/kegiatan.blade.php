@include('layout-lp.head')
@include('layout-lp.navbar')

<main class="pt-[7.5rem] bg-gray-100">

    <section class="relative h-[35vh] overflow-hidden flex items-center justify-center text-center">
        <img src="{{ asset('assets/kinder.png') }}"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-110 grayscale contrast-75"
            alt="Latar Belakang Galeri Kegiatan">

        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

        <div class="relative z-20 px-4">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg">Galeri Kegiatan</h1>
        </div>
    </section>

    <section class="py-8 sm:py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Perhatikan bahwa H1 di sini seharusnya H2 atau H3 jika H1 utama sudah ada di bagian hero --}}
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8 text-center">Kegiatan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/kegiatan/masak.png') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/kegiatan/masak.png') }}" alt="Kegiatan Memasak"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Memasak</h3>
                        <p class="text-gray-600 text-sm">Dokumentasi kegiatan Memasak siswa TK AS-SYIFA 2</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/harian4.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/harian4.jpg') }}" alt="Kegiatan Bermain"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Bermain</h3>
                        <p class="text-gray-600 text-sm">Aktivitas bermain sambil belajar anak-anak</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/harian2.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/harian2.jpg') }}" alt="Kegiatan Upacara"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Upacara</h3>
                        <p class="text-gray-600 text-sm">Aktivitas upacara untuk meningkatkan rasa nasionalisme</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/harian3.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/harian3.jpg') }}" alt="Kegiatan Mencintai Alam"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Mencintai Alam</h3>
                        <p class="text-gray-600 text-sm">Aktivitas mencintai alam agar bisa melestarikan alam sekitar</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/harian1.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/harian1.jpg') }}" alt="Kegiatan Membaca"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Membaca</h3>
                        <p class="text-gray-600 text-sm">Meningkatkan minat baca sejak dini</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/kakaren.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/kakaren.jpg') }}" alt="Kegiatan Berjualan"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Berjualan</h3>
                        <p class="text-gray-600 text-sm">Belajar berwirausaha sejak dini</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/harian5.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/harian5.jpg') }}" alt="Kegiatan Bercerita"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Bercerita</h3>
                        <p class="text-gray-600 text-sm">Belajar bercerita didepan banyak orang</p>
                    </div>
                </div>

                <!-- Card -->
                <div onclick="openModal('{{ asset('assets/outing6.jpg') }}')"
                    class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer">
                    <div class="relative h-48">
                        <img src="{{ asset('assets/outing6.jpg') }}" alt="Kegiatan Kemanusiaan"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Kegiatan Kemanusiaan</h3>
                        <p class="text-gray-600 text-sm">Meningkatkan kepedulian terhadap sesama sejak dini</p>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div class="relative">
                <!-- Tombol Close -->
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 bg-white text-black rounded-full px-3 py-1 font-bold shadow-lg">
                    ✕
                </button>
                <!-- Gambar Preview -->
                <img id="modalImage" src="" alt="Preview"
                    class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-2xl" />
            </div>
        </div>

    </section>
    <script>
        function openModal(src) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            modal.classList.remove("hidden");
            modalImg.src = src;
        }

        function closeModal() {
            document.getElementById("imageModal").classList.add("hidden");
        }

        // Tutup modal jika klik area luar gambar
        document.getElementById("imageModal").addEventListener("click", function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

</main>

@include('layout-lp.footer')
