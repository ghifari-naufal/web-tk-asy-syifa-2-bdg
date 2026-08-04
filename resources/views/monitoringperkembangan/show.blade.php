@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-green-500 text-white px-6 py-4">
                <h4 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-eye mr-2"></i> Detail Monitoring Perkembangan
                </h4>
            </div>

            <div class="p-6">
                {{-- Informasi Siswa --}}
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h5 class="text-lg font-semibold text-gray-800 mb-3">Informasi Siswa</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Nama Anak:</label>
                            <p class="text-gray-800 font-semibold">{{ $monitoring->pendaftaran->nama_anak }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Kelas:</label>
                            <p class="text-gray-800">{{ $monitoring->pendaftaran->kelas_tk }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tanggal Pendaftaran:</label>
                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($monitoring->pendaftaran->created_at)->format('d-m-Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Nama Orang Tua:</label>
                            <p class="text-gray-800">{{ $monitoring->pendaftaran->nama_ortu }}</p>
                        </div>
                    </div>
                </div>

                {{-- Detail Monitoring --}}
                <div class="mb-6">
                    <h5 class="text-lg font-semibold text-gray-800 mb-3">Detail Monitoring Perkembangan</h5>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tanggal Monitoring:</label>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($monitoring->created_at)->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">Kegiatan:</label>
                            <p class="text-gray-800 bg-blue-50 p-3 rounded border">{{ $monitoring->kegiatan }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">Deskripsi/Keterangan:</label>
                            <div class="text-gray-800 bg-gray-50 p-3 rounded border">
                                {{ $monitoring->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}
                            </div>
                        </div>

                        @if ($monitoring->guru)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Guru Pengajar:</label>
                                <p class="text-gray-800">{{ $monitoring->guru->name ?? 'Tidak ada data guru' }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Dokumentasi Foto --}}
                @if ($monitoring->foto)
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold text-gray-800 mb-3">Dokumentasi Foto</h5>
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $monitoring->foto) }}"
                                alt="Foto Perkembangan {{ $monitoring->pendaftaran->nama_anak }}"
                                class="max-w-full max-h-96 rounded-lg shadow-lg border cursor-pointer hover:opacity-90 transition-opacity duration-200"
                                title="Klik untuk memperbesar foto">
                        </div>
                        <p class="text-center text-sm text-gray-500 mt-2">
                            <i class="fas fa-search-plus mr-1"></i> Klik foto untuk memperbesar
                        </p>
                    </div>
                @endif

                {{-- Buttons Action --}}
                <div class="flex justify-between items-center pt-4 border-t">
                    <a href="{{ route('monitoringperkembangan.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk zoom foto --}}
    @if ($monitoring->foto)
        <div id="photo-modal"
            class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-2 sm:p-4">
            <div class="relative w-full h-full flex items-center justify-center">
                <img src="{{ asset('storage/' . $monitoring->foto) }}" alt="Foto Perkembangan"
                    class="max-w-full max-h-full object-contain rounded shadow-2xl">
                <button onclick="closePhotoModal()"
                    class="absolute top-4 right-4 text-white bg-black bg-opacity-70 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-90 transition-all duration-200 text-lg">
                    <i class="fas fa-times"></i>
                </button>
                {{-- Tambahan info foto --}}
                <div class="absolute bottom-4 left-4 right-4 text-center">
                    <p class="text-white text-sm bg-black bg-opacity-50 rounded px-3 py-1 inline-block">
                        {{ $monitoring->pendaftaran->nama_anak }} - {{ $monitoring->kegiatan }}
                    </p>
                </div>
            </div>
        </div>

        <script>
            function openPhotoModal() {
                document.getElementById('photo-modal').classList.remove('hidden');
                document.getElementById('photo-modal').classList.add('flex');
                // Prevent body scroll when modal is open
                document.body.style.overflow = 'hidden';
            }

            function closePhotoModal() {
                document.getElementById('photo-modal').classList.add('hidden');
                document.getElementById('photo-modal').classList.remove('flex');
                // Restore body scroll
                document.body.style.overflow = 'auto';
            }

            // Tambahkan event listener untuk klik foto
            document.addEventListener('DOMContentLoaded', function() {
                const photoImg = document.querySelector('img[alt*="Foto Perkembangan"]');
                if (photoImg) {
                    photoImg.addEventListener('click', openPhotoModal);
                }

                // Tutup modal ketika klik di luar foto
                document.getElementById('photo-modal')?.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closePhotoModal();
                    }
                });

                // Tutup modal dengan tombol ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closePhotoModal();
                    }
                });

                // Prevent right click pada modal foto
                document.getElementById('photo-modal')?.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });
            });
        </script>
    @endif
@endsection
