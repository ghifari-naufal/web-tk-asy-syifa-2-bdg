@include('layout-lp.head')
@include('layout-lp.navbar')

<main class="pt-[7.5rem] bg-gray-100">

    <section class="relative h-[35vh] overflow-hidden flex items-center justify-center text-center">
        <img src="{{ asset('assets/kinder.png') }}"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-110 grayscale contrast-75"
            alt="Latar Belakang Visi dan Misi">

        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

        <div class="relative z-20 px-4">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg">Visi dan Misi</h1>
        </div>
    </section>

    <section class="py-8 sm:py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Visi dan Misi</h2>
                <hr class="border-1 border-lime-600 w-24 mb-6"> {{-- Lebar HR disesuaikan ke standar Tailwind --}}

                <div class="mt-8">
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3">Visi</h3> {{-- Menggunakan H3 untuk sub-judul Visi --}}
                    <p class="text-gray-800 mb-6 leading-relaxed text-base sm:text-lg">
                        Menjadi taman kanak-kanak terdepan di Kota Bandung dengan akreditasi A,
                        yang menghasilkan anak-anak cerdas, kreatif, mandiri, dan berakhlak mulia melalui penerapan
                        Kurikulum 2013 yang holistik,
                        berlandaskan nilai-nilai keislaman, serta didukung oleh lingkungan belajar yang inspiratif dan
                        berkualitas.
                    </p>

                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3">Misi</h3> {{-- Menggunakan H3 untuk sub-judul Misi --}}
                    <p class="text-gray-800 mb-6 leading-relaxed text-base sm:text-lg">
                        1. Melaksanakan Kurikulum 2013 secara optimal untuk mengembangkan potensi anak secara seimbang,
                        mencakup aspek kognitif, motorik, sosial, emosional, dan spiritual. <br>
                        2. Mendorong kreativitas dan daya pikir kritis anak melalui pendekatan bermain sambil belajar,
                        kegiatan seni, dan eksplorasi lingkungan.<br>
                        3. Menanamkan nilai-nilai keislaman dan akhlak mulia sejak dini untuk membentuk karakter anak yang
                        jujur, sopan, dan peduli.<br>
                        4. Menjalin kerja sama yang erat dengan orang tua dan komunitas untuk mendukung perkembangan anak
                        secara holistik.<br>
                        5. Menyediakan fasilitas belajar yang modern, aman, dan nyaman, didukung oleh guru-guru berkualitas
                        yang berdedikasi untuk menjaga standar akreditasi A.
                    </p>
                </div>
            </div>
        </div>
    </section>

</main>

@include('layout-lp.footer')