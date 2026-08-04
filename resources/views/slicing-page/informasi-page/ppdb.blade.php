@include('layout-lp.head')
@include('layout-lp.navbar')

<!-- Content with proper spacing for fixed navbar -->
<div class="pt-28 pb-8">
    <!-- PPDB Requirements Section -->
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 border-4 border-lime-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">Persyaratan Pendaftaran</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Usia -->
                <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-400">
                    <div class="flex items-center mb-4">
                        <i class="fa-solid fa-user text-blue-500 mr-3 text-xl"></i>
                        <h2 class="text-lg font-semibold text-gray-800">Syarat Usia</h2>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Kelompok Playgroup : 3-4 Tahun</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Kelompok A : 4-5 Tahun</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Kelompok B : 5-6 Tahun</span>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Wajib -->
                <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-400">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-file-alt text-blue-500 mr-3 text-xl"></i>
                        <h2 class="text-lg font-semibold text-gray-800">Dokumen Wajib</h2>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Fotocopy Kartu Keluarga (FC KK)</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Fotocopy KTP Orang Tua (FC KTP)</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Fotocopy Akta Kelahiran</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biaya Pendaftaran - Berada di tengah -->
            <div class="flex justify-center mt-8">
                <div class="bg-orange-50 rounded-xl p-6 border-l-4 border-orange-400 w-full max-w-md">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-money-bill-wave text-orange-500 mr-3 text-xl"></i>
                        <h2 class="text-lg font-semibold text-gray-800">Biaya Pendaftaran</h2>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Formulir pendaftaran: Rp 75.000</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Tes masuk: Rp 100.000</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Biaya administrasi: Rp 25.000</span>
                        </div>
                        <div class="bg-orange-100 rounded-lg p-3 mt-4">
                            <div class="flex items-center">
                                <i class="fas fa-calculator text-orange-600 mr-2"></i>
                                <span class="font-semibold text-gray-800">Total Rp 200.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="bg-orange-100 border-l-4 border-orange-500 p-6 mt-8 rounded-r-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-orange-500 mr-3 text-xl"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-orange-800 mb-2">Penting!</h3>
                        <p class="text-orange-700">
                            Semua dokumen harus sudah dilengkapi dan dilegalisir oleh pihak sekolah asal. Dokumen yang
                            tidak lengkap akan menunda proses verifikasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information Section -->
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h1 class="text-xl font-semibold text-gray-800">Informasi Pembayaran</h1>
            </div>

            <div class="p-6">
                <!-- Official Payment Account Section -->
                <div class="bg-gradient-to-r from-lime-500 to-lime-100 rounded-xl p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-credit-card text-white text-xl mr-3"></i>
                        <h2 class="text-white text-lg font-semibold">Rekening Pembayaran Resmi</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Bank BRI -->
                        <div class="bg-lime-700 bg-opacity-40 rounded-lg p-4">
                            <div class="text-white">
                                <div class="font-semibold mb-1">Bank BSI</div>
                                <div class="text-sm mb-1">No. Rekening: 7777000629</div>
                                <div class="text-sm">Atas Nama: YPHB (TK ASY-SYIFA 2)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two Column Section -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Payment Method -->
                    <div class="bg-blue-50 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-info-circle text-blue-500 text-lg mr-3"></i>
                            <h3 class="text-gray-800 font-semibold">Cara Pembayaran</h3>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Transfer ke salah satu rekening di atas</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Tulis kode unik: PPDB-NAMA SISWA</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Simpan bukti transfer</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Upload bukti transfer saat daftar online</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Konfirmasi pembayaran via WhatsApp</span>
                            </div>
                        </div>
                    </div>

                    <!-- Time Limit -->
                    <div class="bg-red-50 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-clock text-red-500 text-lg mr-3"></i>
                            <h3 class="text-gray-800 font-semibold">Batas Waktu</h3>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Pembayaran paling lambat 3 hari setelah
                                    mendaftar</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Pendaftaran akan dibatalkan jika melewati
                                    batas</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Uang pendaftaran tidak dapat dikembalikan</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check text-green-500 text-sm mt-1 mr-3"></i>
                                <span class="text-gray-700 text-sm">Konfirmasi pembayaran dalam 1x24 jam</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Section -->
                <div class="bg-gradient-to-r from-orange-400 to-orange-500 rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-white text-xl mr-3"></i>
                        <h3 class="text-white font-semibold text-lg">PERINGATAN!</h3>
                    </div>
                    <p class="text-white text-sm leading-relaxed">
                        Hanya transfer ke rekening yang tertera di atas. Hati-hati penipuan! Sekolah tidak bertanggung
                        jawab atas pembayaran ke rekening lain.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <a href="{{ route('pendaftaran.create') }}" class="bg-lime-600 hover:bg-gray-400 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl">
            <i class="fas fa-arrow-right mr-2"></i>
            Lanjut Daftar
        </a>
    </div>
</div>

@include('layout-lp.footer')
