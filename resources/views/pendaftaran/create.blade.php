{{-- resources/views/pendaftaran/create.blade.php --}}
@include('layout-lp.head')
@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Back Button --}}
        <div class="flex items-center justify-start mb-6">
            <a href="{{ route('landingpage') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition duration-200 group">
                <i class="fas fa-arrow-left mr-2 text-gray-500 group-hover:text-gray-700 transition duration-200"></i>
                <span class="font-medium">Kembali ke Beranda</span>
            </a>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Form Pendaftaran Terintegrasi --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-lime-200">
            <div class="bg-gradient-to-r from-green-500 to-lime-500 text-white p-6">
                <div class="flex items-center justify-center space-x-3">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <h2 class="text-2xl md:text-3xl font-bold text-center">Pendaftaran TK ASY-SYIFA 2</h2>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Data Pendaftaran --}}
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user-friends mr-2 text-green-500"></i>
                            Data Pendaftaran
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Orang Tua --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-user mr-2 text-green-500"></i>
                                    Nama Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ortu"
                                    class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 hover:border-lime-400 @error('nama_ortu') border-red-500 @enderror"
                                    placeholder="Masukkan nama orang tua" value="{{ old('nama_ortu') }}" required>
                                @error('nama_ortu')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- No HP --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-phone mr-2 text-green-500"></i>
                                    No. WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="no_hp" name="no_hp"
                                    class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 hover:border-lime-400 @error('no_hp') border-red-500 @enderror"
                                    placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Nama Anak --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-child mr-2 text-green-500"></i>
                                    Nama Lengkap Anak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_anak"
                                    class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 hover:border-lime-400 @error('nama_anak') border-red-500 @enderror"
                                    placeholder="Masukkan nama anak" value="{{ old('nama_anak') }}" required>
                                @error('nama_anak')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Pilih Kelas --}}
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-school mr-2 text-green-500"></i>
                                    Pilih Kelas TK <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label
                                        class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-lime-50 transition duration-200 @error('kelas_tk') border-red-500 @enderror">
                                        <input type="radio" name="kelas_tk" value="TK A" class="sr-only peer"
                                            {{ old('kelas_tk') == 'TK A' ? 'checked' : '' }}>
                                        <div
                                            class="w-5 h-5 border-2 border-lime-400 rounded-full mr-3 flex items-center justify-center peer-checked:bg-green-500 peer-checked:border-green-500 transition duration-200">
                                            <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">TK A</div>
                                            <div class="text-sm text-gray-600">Usia 4-5 Tahun</div>
                                        </div>
                                    </label>
                                    <label
                                        class="flex items-center p-4 border  rounded-lg cursor-pointer hover:bg-lime-50 transition duration-200 @error('kelas_tk') border-red-500 @enderror">
                                        <input type="radio" name="kelas_tk" value="TK B" class="sr-only peer"
                                            {{ old('kelas_tk') == 'TK B' ? 'checked' : '' }}>
                                        <div
                                            class="w-5 h-5 border-2 border-lime-400 rounded-full mr-3 flex items-center justify-center peer-checked:bg-green-500 peer-checked:border-green-500 transition duration-200">
                                            <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">TK B</div>
                                            <div class="text-sm text-gray-600">Usia 5-6 Tahun</div>
                                        </div>
                                    </label>
                                </div>
                                @error('kelas_tk')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Upload Dokumen Persyaratan (WAJIB) --}}
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-file-contract mr-2 text-blue-500"></i>
                            Upload Dokumen Persyaratan <span class="text-red-500">(WAJIB)</span>
                        </h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-blue-500 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold mb-2">Dokumen yang Wajib Diunggah:</h4>
                                    <ul class=" text-sm space-y-1">
                                        <li>• Fotocopy Kartu Keluarga (KK)</li>
                                        <li>• Fotocopy Akta Kelahiran Anak</li>
                                        <li>• Fotocopy KTP Orang Tua</li>
                                    </ul>
                                    <p class="text-gray-400 text-xs mt-2 font-medium">*Gabungkan semua dokumen dalam satu
                                        file (PDF) atau upload gambar yang jelas</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Judul Dokumen Persyaratan --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>
                                    Judul Dokumen Persyaratan
                                </label>
                                <input type="text" name="dokumen_persyaratan_title"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-blue-400 @error('dokumen_persyaratan_title') border-blue-500 @enderror"
                                    placeholder="Contoh: KK, Akta Kelahiran, KTP Ortu"
                                    value="{{ old('dokumen_persyaratan_title') }}">
                                @error('dokumen_persyaratan_title')
                                    <small class="text-blue-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- File Dokumen Persyaratan --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-upload mr-2 text-blue-500"></i>
                                    File Dokumen Persyaratan <span class="text-blue-500">*</span>
                                </label>
                                <input type="file" name="dokumen_persyaratan" required
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-blue-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('dokumen_persyaratan') border-blue-500 @enderror">
                                <div class="flex items-center space-x-2 text-sm text-gray-600 mt-1">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                    <span>PDF, Word, atau Gambar (Max: 20MB)</span>
                                </div>
                                @error('dokumen_persyaratan')
                                    <small class="text-blue-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- File Preview Dokumen Persyaratan --}}
                        <div id="dokumen-persyaratan-preview" class="hidden mt-4">
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-center space-x-4">
                                    <div id="dokumen-persyaratan-icon" class="text-3xl"></div>
                                    <div>
                                        <div id="dokumen-persyaratan-name" class="font-medium text-gray-800"></div>
                                        <div id="dokumen-persyaratan-info" class="text-sm text-gray-600"></div>
                                    </div>
                                </div>
                                <div id="dokumen-persyaratan-image-preview" class="mt-3 hidden">
                                    <img id="dokumen-persyaratan-preview-img" src="" alt="Preview"
                                        class="max-w-xs max-h-32 rounded border">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Upload Bukti Pembayaran (WAJIB) --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-file-upload mr-2 text-blue-500"></i>
                            Upload Bukti Pembayaran & Dokumen Lainnya <span class="text-gray-500">(WAJIB)</span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Judul Dokumen --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>
                                    Judul Dokumen
                                </label>
                                <input type="text" name="file_title"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-cyan-400 @error('file_title') border-red-500 @enderror"
                                    placeholder="Contoh: Bukti Pembayaran Pendaftaran" value="{{ old('file_title') }}">
                                @error('file_title')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- File Upload --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-upload mr-2 text-blue-500"></i>
                                    File Dokumen
                                </label>
                                <input type="file" name="file" required
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp"
                                    class="w-full px-4 py-3 border  rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-cyan-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('file') border-red-500 @enderror">
                                <div class="flex items-center space-x-2 text-sm text-gray-600 mt-1">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                    <span>PDF, Word, atau Gambar (Max: 20MB)</span>
                                </div>
                                @error('file')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- File Preview --}}
                        <div id="file-preview" class="hidden">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center space-x-4">
                                    <div id="file-icon" class="text-3xl"></div>
                                    <div>
                                        <div id="file-name" class="font-medium text-gray-800"></div>
                                        <div id="file-info" class="text-sm text-gray-600"></div>
                                    </div>
                                </div>
                                <div id="image-preview" class="mt-3 hidden">
                                    <img id="preview-img" src="" alt="Preview"
                                        class="max-w-xs max-h-32 rounded border">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-lime-500 hover:from-green-600 hover:to-lime-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Syarat Usia --}}
            <div class="bg-white rounded-xl p-6 shadow-lg border border-lime-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-clock text-green-600 text-xl"></i>
                    </div>
                    <h4 class="ml-3 text-lg font-semibold text-gray-800">Syarat Usia</h4>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>TK A: 4-5 Tahun</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>TK B: 5-6 Tahun</span>
                    </div>
                </div>
            </div>

            {{-- Dokumen Persyaratan --}}
            <div class="bg-white rounded-xl p-6 shadow-lg border border-red-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-red-600 text-xl"></i>
                    </div>
                    <h4 class="ml-3 text-lg font-semibold text-gray-800">Dokumen Persyaratan</h4>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        {{-- <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> --}}
                        <span class="font-semibold px-2">Fotocopy KK</span>
                    </div>
                    <div class="flex items-center">
                        {{-- <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> --}}
                        <span class="font-semibold px-2">Fotocopy KTP</span>
                    </div>
                    <div class="flex items-center">
                        {{-- <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> --}}
                        <span class="font-semibold px-2">Akta Kelahiran</span>
                    </div>
                </div>
            </div>

            {{-- Biaya Pendaftaran --}}
            <div class="bg-white rounded-xl p-6 shadow-lg border border-lime-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-orange-600 text-xl"></i>
                    </div>
                    <h4 class="ml-3 text-lg font-semibold text-gray-800">Biaya Pendaftaran</h4>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Formulir:</span>
                        <span class="font-semibold">Rp 75.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tes masuk:</span>
                        <span class="font-semibold">Rp 100.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Administrasi:</span>
                        <span class="font-semibold">Rp 25.000</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between font-bold text-orange-600">
                        <span>Total:</span>
                        <span>Rp 200.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="successModal" class="fixed inset-0 z-50">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Modal Content -->
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-auto">

                    <!-- Modal Header -->
                    <div class="text-center p-6">
                        <!-- Success Icon -->
                        <div class="mx-auto w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>

                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            Pendaftaran Berhasil!
                        </h2>

                        <!-- Message -->
                        <p class="text-gray-600 mb-6">
                            Terima kasih telah mendaftarkan anak Anda di TK ASY-SYIFA 2.
                            Kami akan segera menghubungi Anda.
                        </p>

                        <!-- Button -->
                        <button onclick="goToLandingPage()"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // File preview functionality untuk bukti pembayaran
            document.querySelector('input[name="file"]').addEventListener('change', function(e) {
                handleFilePreview(e.target.files[0], 'file-preview', 'file-icon', 'file-name', 'file-info',
                    'image-preview', 'preview-img');
            });

            // File preview functionality untuk dokumen persyaratan
            document.querySelector('input[name="dokumen_persyaratan"]').addEventListener('change', function(e) {
                handleFilePreview(e.target.files[0], 'dokumen-persyaratan-preview', 'dokumen-persyaratan-icon',
                    'dokumen-persyaratan-name', 'dokumen-persyaratan-info', 'dokumen-persyaratan-image-preview',
                    'dokumen-persyaratan-preview-img');
            });

            function handleFilePreview(file, previewId, iconId, nameId, infoId, imagePreviewId, previewImgId) {
                const previewDiv = document.getElementById(previewId);
                const fileIcon = document.getElementById(iconId);
                const fileName = document.getElementById(nameId);
                const fileInfo = document.getElementById(infoId);
                const imagePreview = document.getElementById(imagePreviewId);
                const previewImg = document.getElementById(previewImgId);

                if (file) {
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
                    const fileType = file.type;

                    // Set file name and info
                    fileName.textContent = file.name;
                    fileInfo.textContent = `Ukuran: ${fileSize} MB | Tipe: ${fileType}`;

                    // Set icon based on file type
                    if (fileType.startsWith('image/')) {
                        fileIcon.innerHTML = '<i class="fas fa-file-image text-green-500"></i>';

                        // Show image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImg.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.classList.add('hidden');

                        if (fileType === 'application/pdf') {
                            fileIcon.innerHTML = '<i class="fas fa-file-pdf text-red-500"></i>';
                        } else if (fileType.includes('word') || file.name.endsWith('.doc') || file.name.endsWith('.docx')) {
                            fileIcon.innerHTML = '<i class="fas fa-file-word text-blue-500"></i>';
                        } else {
                            fileIcon.innerHTML = '<i class="fas fa-file text-gray-500"></i>';
                        }
                    }

                    previewDiv.classList.remove('hidden');
                } else {
                    previewDiv.classList.add('hidden');
                }
            }

            // Radio button styling
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('input[name="' + this.name + '"]').forEach(r => {
                        r.closest('label').classList.remove('bg-green-50', 'border-green-500');
                    });

                    if (this.checked) {
                        this.closest('label').classList.add('bg-green-50', 'border-green-500');
                    }
                });
            });

            document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                radio.closest('label').classList.add('bg-green-50', 'border-green-500');
            });

            function closeModal() {
                document.getElementById('successModal').style.display = 'none';
            }

            function goToLandingPage() {
                // Redirect ke landing page
                window.location.href = "{{ route('landingpage') }}";
            }

            document.getElementById('successModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    goToLandingPage(); // Redirect ke landing page jika klik di luar modal
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    goToLandingPage(); // Redirect ke landing page jika tekan Escape
                }
            });

            // Auto format nomor HP (mengubah angka 0 diawal menjadi 62)
            document.getElementById('no_hp').addEventListener('blur', function() {
                let value = this.value.replace(/\D/g, ''); // Hapus non-digit

                if (value.startsWith('0')) {
                    value = '62' + value.substring(1); // Ganti 0 dengan 62
                    this.value = value;
                }
            });
        </script>
    @endif
@endsection
