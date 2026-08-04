@include('layout-lp.head')
@include('layout-lp.navbar')

<main class="pt-[7.5rem] bg-gray-100">

    <!-- Hero Section -->
    <section class="relative h-[30vh] overflow-hidden flex items-center justify-center text-center">
        <img src="{{ asset('assets/kinder.png') }}"
            class="absolute top-0 left-0 w-full h-full object-cover z-0 brightness-110 grayscale contrast-75"
            alt="Latar Belakang Kalender Kegiatan">

        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>

        <div class="relative z-20 px-4">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">Kalender Kegiatan</h1>
        </div>
    </section>

    <!-- PDF Viewer Section -->
    <section class="py-6 sm:py-8 lg:py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <div class="bg-white p-4 rounded-lg shadow-md">

                <!-- PDF Viewer / Image -->
                <div class="w-full h-[600px]">
                    <embed src="{{ asset('assets/kaldik.pdf') }}" type="application/pdf"
                        class="w-full h-full rounded shadow" />
                </div>
            </div>
        </div>
    </section>


</main>

@include('layout-lp.footer')
