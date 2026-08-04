@include('layout-lp.head')
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-4">
            <h2 class="text-xl font-semibold text-white flex items-center">
                <i class="fas fa-edit mr-3"></i> Edit Data Pendaftaran - {{ $pendaftaran->nama_anak }}
            </h2>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Data Dasar Pendaftaran --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-user-friends mr-2 text-orange-500"></i>
                        Data Pendaftaran
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Orang Tua -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-orange-500"></i>
                                Nama Orang Tua <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_ortu" value="{{ old('nama_ortu', $pendaftaran->nama_ortu) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200 hover:border-orange-400 @error('nama_ortu') border-red-500 @enderror">
                            @error('nama_ortu')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-phone mr-2 text-orange-500"></i>
                                No. HP <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200 hover:border-orange-400 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nama Anak -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-child mr-2 text-orange-500"></i>
                                Nama Anak <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_anak" value="{{ old('nama_anak', $pendaftaran->nama_anak) }}" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200 hover:border-orange-400 @error('nama_anak') border-red-500 @enderror">
                            @error('nama_anak')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Pilih Kelas -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-school mr-2 text-orange-500"></i>
                                Pilih Kelas TK <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-orange-50 transition duration-200 {{ $pendaftaran->kelas_tk == 'TK A' ? 'bg-orange-50 border-orange-500' : '' }}">
                                    <input type="radio" name="kelas_tk" value="TK A" class="sr-only peer" 
                                        {{ old('kelas_tk', $pendaftaran->kelas_tk) == 'TK A' ? 'checked' : '' }}>
                                    <div class="w-5 h-5 border-2 border-orange-400 rounded-full mr-3 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:border-orange-500 transition duration-200">
                                        <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800">TK A</div>
                                        <div class="text-sm text-gray-600">Usia 4-5 Tahun</div>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-orange-50 transition duration-200 {{ $pendaftaran->kelas_tk == 'TK B' ? 'bg-orange-50 border-orange-500' : '' }}">
                                    <input type="radio" name="kelas_tk" value="TK B" class="sr-only peer"
                                        {{ old('kelas_tk', $pendaftaran->kelas_tk) == 'TK B' ? 'checked' : '' }}>
                                    <div class="w-5 h-5 border-2 border-orange-400 rounded-full mr-3 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:border-orange-500 transition duration-200">
                                        <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
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

                {{-- Status dan Catatan (untuk Admin) --}}
                {{-- @can('pendaftaran-edit')
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-clipboard-check mr-2 text-purple-500"></i>
                        Status Pendaftaran
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-flag mr-2 text-purple-500"></i>
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" required
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="pending" {{ old('status', $pendaftaran->status) == 'pending' ? 'selected' : '' }}>
                                    Menunggu Review
                                </option>
                                <option value="approved" {{ old('status', $pendaftaran->status) == 'approved' ? 'selected' : '' }}>
                                    Disetujui
                                </option>
                                <option value="rejected" {{ old('status', $pendaftaran->status) == 'rejected' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                            @error('status')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-sticky-note mr-2 text-purple-500"></i>
                                Catatan
                            </label>
                            <textarea name="catatan" rows="3" placeholder="Catatan untuk orang tua..."
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('catatan') border-red-500 @enderror">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
                            @error('catatan')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                @endcan --}}

                {{-- Upload Dokumen Persyaratan (Update) --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-file-contract mr-2 text-red-500"></i>
                        Dokumen Persyaratan
                    </h3>

                    {{-- Current Dokumen Persyaratan --}}
                    @if ($pendaftaran->hasDokumenPersyaratan())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <i class="{{ $pendaftaran->getDokumenPersyaratanTypeIcon() }} text-3xl text-red-500"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            {{ $pendaftaran->dokumen_persyaratan_title }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Ukuran: {{ $pendaftaran->getFormattedDokumenPersyaratanSize() }} |
                                            Diupload: {{ $pendaftaran->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('pendaftaran.view-dokumen-persyaratan', $pendaftaran->id) }}"
                                        target="_blank"
                                        class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-100 transition"
                                        title="Lihat Dokumen">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pendaftaran.download-dokumen-persyaratan', $pendaftaran->id) }}"
                                        class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-100 transition"
                                        title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                                <span class="text-yellow-800">Belum ada dokumen persyaratan yang diunggah</span>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Judul Dokumen Persyaratan --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-tag mr-2 text-red-500"></i>
                                Judul Dokumen Persyaratan
                            </label>
                            <input type="text" name="dokumen_persyaratan_title"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 hover:border-red-400 @error('dokumen_persyaratan_title') border-red-500 @enderror"
                                placeholder="KK, Akta Kelahiran, KTP Ortu"
                                value="{{ old('dokumen_persyaratan_title', $pendaftaran->dokumen_persyaratan_title) }}">
                            @error('dokumen_persyaratan_title')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- File Dokumen Persyaratan --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-upload mr-2 text-red-500"></i>
                                File Dokumen Persyaratan Baru
                            </label>
                            <input type="file" name="dokumen_persyaratan" id="dokumen_persyaratan"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 hover:border-red-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 @error('dokumen_persyaratan') border-red-500 @enderror">
                            <div class="flex items-center space-x-2 text-sm text-gray-600 mt-1">
                                <i class="fas fa-info-circle text-red-500"></i>
                                <span>Kosongkan jika tidak ingin mengubah dokumen. PDF, Word, atau Gambar (Max: 20MB)</span>
                            </div>
                            @error('dokumen_persyaratan')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror

                            {{-- Preview Dokumen Persyaratan --}}
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
                    </div>
                </div>

                {{-- Upload Bukti Pembayaran (Update) --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-file-upload mr-2 text-blue-500"></i>
                        Bukti Pembayaran & Dokumen Lainnya
                    </h3>

                    {{-- Current File --}}
                    @if ($pendaftaran->hasFile())
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <i class="{{ $pendaftaran->getFileTypeIcon() }} text-3xl text-blue-500"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $pendaftaran->file_title }}</div>
                                        <div class="text-sm text-gray-500">
                                            Ukuran: {{ $pendaftaran->getFormattedFileSize() }} |
                                            Diupload: {{ $pendaftaran->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('pendaftaran.view-file', $pendaftaran->id) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-100 transition"
                                        title="Lihat File">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pendaftaran.download-file', $pendaftaran->id) }}"
                                        class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-100 transition"
                                        title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                                <span class="text-yellow-800">Belum ada file bukti pembayaran yang diunggah</span>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Judul Dokumen --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-tag mr-2 text-blue-500"></i>
                                Judul Dokumen
                            </label>
                            <input type="text" name="file_title"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-cyan-400 @error('file_title') border-red-500 @enderror"
                                placeholder="Bukti Pembayaran Pendaftaran"
                                value="{{ old('file_title', $pendaftaran->file_title) }}">
                            @error('file_title')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- File Upload --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-upload mr-2 text-blue-500"></i>
                                File Dokumen Baru
                            </label>
                            <input type="file" name="file" id="file"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 hover:border-cyan-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('file') border-red-500 @enderror">
                            <div class="flex items-center space-x-2 text-sm text-gray-600 mt-1">
                                <i class="fas fa-info-circle text-blue-500"></i>
                                <span>Kosongkan jika tidak ingin mengubah file. PDF, Word, atau Gambar (Max: 20MB)</span>
                            </div>
                            @error('file')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror

                            {{-- Preview File --}}
                            <div id="file-preview" class="hidden mt-4">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
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
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 pt-6">
                    <a href="{{ route('pendaftaran.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg shadow transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    
                    <button type="submit"
                        class="inline-flex items-center justify-center px-8 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Update Data Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript untuk Preview dan Radio Button Styling --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // File preview functionality untuk bukti pembayaran
    document.getElementById('file')?.addEventListener('change', function(e) {
        handleFilePreview(e.target.files[0], 'file-preview', 'file-icon', 'file-name', 'file-info', 'image-preview', 'preview-img');
    });

    // File preview functionality untuk dokumen persyaratan
    document.getElementById('dokumen_persyaratan')?.addEventListener('change', function(e) {
        handleFilePreview(e.target.files[0], 'dokumen-persyaratan-preview', 'dokumen-persyaratan-icon', 'dokumen-persyaratan-name', 'dokumen-persyaratan-info', 'dokumen-persyaratan-image-preview', 'dokumen-persyaratan-preview-img');
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
                r.closest('label').classList.remove('bg-orange-50', 'border-orange-500');
            });

            if (this.checked) {
                this.closest('label').classList.add('bg-orange-50', 'border-orange-500');
            }
        });
    });

    // Set initial radio button styling
    document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
        radio.closest('label').classList.add('bg-orange-50', 'border-orange-500');
    });
});
</script>
@endsection