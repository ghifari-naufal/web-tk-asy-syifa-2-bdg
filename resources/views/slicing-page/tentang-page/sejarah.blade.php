@include('layout-lp.head')
@include('layout-lp.navbar')

<main class="pt-[7.5rem] bg-gray-100">

    <section class="relative h-[35vh] overflow-hidden flex items-center justify-center text-center">
        <img src="{{ asset('assets/kinder.png') }}"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-110 grayscale contrast-75"
            alt="Latar Belakang Halaman Sejarah">

        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

        <div class="relative z-20 px-4">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg">Sejarah</h1>
        </div>
    </section>

    <section class="py-8 sm:py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Latar Belakang</h2>
                <hr class="border-1 border-lime-600 w-24 mb-6">

                <p class="text-gray-800 mb-6 leading-relaxed text-base sm:text-lg">
                    TK ASY-SYIFA 2, sebuah taman kanak-kanak swasta yang berlokasi di Kecamatan Kiaracondong, Kota
                    Bandung, Jawa Barat, hadir sebagai lembaga pendidikan anak usia dini yang berkomitmen untuk mencetak
                    generasi cerdas, kreatif, dan berakhlak mulia. Berdiri sejak **25 Mei 2016** berdasarkan SK Pendirian
                    AHU-0025758.AH.01.04.Tahun 2016, sekolah ini berada di bawah naungan Kementerian Pendidikan dan
                    Kebudayaan, menjamin standar pendidikan yang berkualitas dan terpercaya. Dengan lingkungan belajar
                    yang aman, nyaman, dan penuh keceriaan, TK ASY-SYIFA 2 menawarkan pendekatan pendidikan holistik
                    yang mengintegrasikan perkembangan kognitif, motorik, sosial, dan spiritual anak. Kurikulum kami
                    dirancang untuk merangsang imajinasi dan kreativitas anak melalui kegiatan bermain sambil belajar,
                    seni, dan eksplorasi alam, didukung oleh tenaga pengajar yang profesional dan berpengalaman dalam
                    mendampingi tumbuh kembang anak usia dini.
                </p>
                <p class="text-gray-800 leading-relaxed text-base sm:text-lg">
                    Kami di TK ASY-SYIFA 2 percaya bahwa setiap anak adalah unik dan memiliki potensi luar biasa yang
                    perlu dikembangkan sejak dini. Oleh karena itu, fasilitas kami dirancang untuk mendukung proses
                    belajar yang menyenangkan, mulai dari ruang kelas yang interaktif, area bermain yang aman, hingga
                    program ekstrakurikuler seperti tari, musik, dan pengenalan nilai-nilai keagamaan yang membentuk
                    karakter anak. Berlokasi strategis di Kota Bandung, TK ASY-SYIFA 2 menjadi pilihan ideal bagi orang
                    tua yang ingin memberikan fondasi pendidikan terbaik bagi buah hati mereka. Bergabunglah bersama
                    kami untuk memberikan awal yang cerah bagi masa depan anak Anda, di mana mereka dapat belajar,
                    berkembang, dan bersinar dalam suasana penuh kasih sayang dan kebahagiaan.
                </p>
            </div>
        </div>
    </section>

</main>
@include('layout-lp.footer')