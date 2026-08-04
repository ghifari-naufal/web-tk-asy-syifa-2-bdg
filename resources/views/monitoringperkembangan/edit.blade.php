@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-orange-600 text-white px-6 py-4">
            <h4 class="text-lg font-semibold flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit Perkembangan Siswa
            </h4>
        </div>
        <div class="p-6">
            <form action="{{ route('monitoringperkembangan.update', $monitoring->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Filter Kelas --}}
                <div>
                    <label for="kelas_filter" class="block font-medium text-gray-700">Filter Berdasarkan Kelas</label>
                    <select id="kelas_filter" name="kelas_filter" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <option value="">-- Semua Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k }}" {{ $monitoring->pendaftaran->kelas_tk == $k ? 'selected' : '' }}>
                                Kelas {{ $k }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Siswa --}}
                <div>
                    <label for="pendaftaran_id" class="block font-medium text-gray-700">Nama Siswa <span class="text-red-500">*</span></label>
                    <select name="pendaftaran_id" id="pendaftaran_id" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 @error('pendaftaran_id') border-red-500 @enderror">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $s)
                            <option value="{{ $s->id }}" data-kelas="{{ $s->kelas_tk }}"
                                {{ old('pendaftaran_id', $monitoring->pendaftaran_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_anak }} - Kelas {{ $s->kelas_tk }}
                            </option>
                        @endforeach
                    </select>
                    @error('pendaftaran_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kegiatan --}}
                <div>
                    <label for="kegiatan" class="block font-medium text-gray-700">Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan" id="kegiatan" 
                           value="{{ old('kegiatan', $monitoring->kegiatan) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 @error('kegiatan') border-red-500 @enderror">
                    @error('kegiatan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $monitoring->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto --}}
                <div>
                    <label for="foto" class="block font-medium text-gray-700">Upload Foto</label>
                    
                    {{-- Preview foto yang sudah ada --}}
                    @if($monitoring->foto)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $monitoring->foto) }}" 
                                 alt="Foto perkembangan" 
                                 id="current-image"
                                 class="max-h-48 rounded border shadow">
                        </div>
                    @endif
                    
                    <input type="file" name="foto" id="foto" accept="image/*"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 @error('foto') border-red-500 @enderror">
                    <small class="text-gray-500">Format: JPG, JPEG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                    @error('foto')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Preview foto baru --}}
                    <div id="preview-container" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview foto baru:</p>
                        <img id="preview-image" class="max-h-48 rounded border shadow">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between">
                    <a href="{{ route('monitoringperkembangan.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-700 text-white px-5 py-2 rounded shadow transition">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Filtering & Preview --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script untuk filter kelas
    document.getElementById('kelas_filter').addEventListener('change', function() {
        let selectedKelas = this.value;
        let siswaSelect = document.getElementById('pendaftaran_id');
        let options = siswaSelect.querySelectorAll('option');

        options.forEach(function(option) {
            if (option.value === '') {
                option.style.display = '';
                return;
            }
            option.style.display = (selectedKelas === '' || option.dataset.kelas === selectedKelas) ? '' : 'none';
        });
        
        // Jika siswa yang dipilih tidak sesuai filter, reset pilihan
        let selectedOption = siswaSelect.querySelector('option:checked');
        if (selectedOption && selectedOption.value !== '' && selectedKelas !== '' && selectedOption.dataset.kelas !== selectedKelas) {
            siswaSelect.value = '';
        }
    });

    // Script untuk preview foto
    document.getElementById('foto')?.addEventListener('change', function(e) {
        let file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview-image').src = ev.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                
                // Sembunyikan foto lama jika ada
                let currentImage = document.getElementById('current-image');
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            }
            reader.readAsDataURL(file);
        } else {
            // Jika file dihapus, sembunyikan preview dan kembalikan foto lama
            document.getElementById('preview-container').classList.add('hidden');
            let currentImage = document.getElementById('current-image');
            if (currentImage) {
                currentImage.style.opacity = '1';
            }
        }
    });
});
</script>
@endsection