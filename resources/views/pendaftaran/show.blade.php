{{-- resources/views/pendaftaran/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-user-graduate mr-2 text-green-500"></i>
                    Detail Pendaftaran
                </h2>
                {{-- <p class="text-gray-600 mt-1">{{ $pendaftaran->nama_anak }}</p> --}}
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('pendaftaran.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Data Pendaftaran --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-lime-500 text-white px-6 py-4">
                        <h3 class="text-lg font-semibold">
                            <i class="fas fa-user-friends mr-2"></i>
                            Data Pendaftaran
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        {{-- Nama Anak --}}
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-child text-green-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">Nama Anak</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $pendaftaran->nama_anak }}</div>
                            </div>
                        </div>

                        {{-- Nama Orang Tua --}}
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-blue-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">Nama Orang Tua</label>
                                <div class="text-lg font-semibold text-gray-900">{{ $pendaftaran->nama_ortu }}</div>
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-purple-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">No. HP</label>
                                <div class="text-lg font-semibold text-gray-900">
                                    <a href="tel:{{ $pendaftaran->no_hp }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $pendaftaran->no_hp }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Kelas TK --}}
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-graduation-cap text-orange-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">Kelas TK</label>
                                <div class="mt-1">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $pendaftaran->kelas_tk == 'TK A' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        <i class="fas fa-school mr-1"></i>
                                        {{ $pendaftaran->kelas_tk }}
                                        ({{ $pendaftaran->kelas_tk == 'TK A' ? '4-5 Tahun' : '5-6 Tahun' }})
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Tanggal Pendaftaran --}}
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar text-gray-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-500">Tanggal Pendaftaran</label>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $pendaftaran->created_at->format('d F Y, H:i') }} WIB
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $pendaftaran->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Status Card --}}
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            Status Pendaftaran
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="text-center">
                            <div class="mb-4">
                                {!! $pendaftaran->getStatusBadge() !!}
                            </div>

                            @if ($pendaftaran->catatan)
                                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Catatan:</label>
                                    <p class="text-sm text-gray-700">{{ $pendaftaran->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- File Dokumen --}}
                @if ($pendaftaran->hasFile())
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="bg-blue-50 px-6 py-4 border-b border-blue-200">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-file-alt mr-2 text-blue-600"></i>
                                Dokumen
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="{{ $pendaftaran->getFileTypeIcon() }} text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $pendaftaran->file_title }}</div>
                                    <div class="text-sm text-gray-500">{{ $pendaftaran->original_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $pendaftaran->getFormattedFileSize() }}</div>
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2">
                                {{-- Download Button --}}
                                <a href="{{ route('pendaftaran.download-file', $pendaftaran->id) }}"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center">
                                    <i class="fas fa-download mr-2"></i>
                                    Download File
                                </a>

                                {{-- View Button (for PDF/Images) --}}
                                @if ($pendaftaran->isPdf() || $pendaftaran->isImage())
                                    <a href="{{ route('pendaftaran.view-file', $pendaftaran->id) }}"
                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center"
                                        target="_blank">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat File
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-file-times mr-2 text-gray-600"></i>
                                Dokumen
                            </h3>
                        </div>

                        <div class="p-6 text-center">
                            <i class="fas fa-file-times fa-3x text-gray-300 mb-3"></i>
                            <p class="text-gray-500">Tidak ada dokumen yang diupload</p>
                        </div>
                    </div>
                @endif

                {{-- Dokumen Persyaratan --}}
                @if ($pendaftaran->hasDokumenPersyaratan())
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="bg-orange-50 px-6 py-4 border-b border-orange-200">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-folder-open mr-2 text-orange-600"></i>
                                Dokumen Persyaratan
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Kartu Keluarga, Akta Kelahiran, KTP Orang Tua</p>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="{{ $pendaftaran->getDokumenPersyaratanTypeIcon() }} text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $pendaftaran->dokumen_persyaratan_title }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $pendaftaran->getFormattedDokumenPersyaratanSize() }}</div>
                                    {{-- <div class="text-xs text-gray-400 mt-1">
                                        Tipe: {{ strtoupper($pendaftaran->dokumen_persyaratan_type) }}
                                    </div> --}}
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2">
                                {{-- Download Button --}}
                                <a href="{{ route('pendaftaran.download-dokumen-persyaratan', $pendaftaran->id) }}"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center">
                                    <i class="fas fa-download mr-2"></i>
                                    Download Dokumen Persyaratan
                                </a>

                                {{-- View Button (for PDF/Images) --}}
                                @if ($pendaftaran->isDokumenPersyaratanPdf() || $pendaftaran->isDokumenPersyaratanImage())
                                    <a href="{{ route('pendaftaran.view-dokumen-persyaratan', $pendaftaran->id) }}"
                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center"
                                        target="_blank">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat Dokumen Persyaratan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="bg-red-50 px-6 py-4 border-b border-red-200">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-folder-open mr-2 text-red-600"></i>
                                Dokumen Persyaratan
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Kartu Keluarga, Akta Kelahiran, KTP Orang Tua</p>
                        </div>

                        <div class="p-6 text-center">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-800 mb-2">Dokumen Persyaratan Belum Diupload</h4>
                            <p class="text-gray-600 mb-4">Silakan upload dokumen persyaratan yang diperlukan</p>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-left">
                                <h5 class="font-medium text-yellow-800 mb-2">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Dokumen yang Diperlukan:
                                </h5>
                                <ul class="text-sm text-yellow-700 space-y-1">
                                    <li>• Kartu Keluarga (KK)</li>
                                    <li>• Akta Kelahiran Anak</li>
                                    <li>• KTP Orang Tua/Wali</li>
                                </ul>
                                <p class="text-xs text-yellow-600 mt-2">
                                    <i class="fas fa-file-pdf mr-1"></i>
                                    Format yang diterima: PDF, JPG, PNG, DOC, DOCX (Max. 20MB)
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Quick Actions --}}
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-tools mr-2"></i>
                            Aksi Cepat
                        </h3>
                    </div>

                    <div class="p-6 space-y-3">
                        {{-- WhatsApp Contact --}}
                        <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $pendaftaran->no_hp) }}?text=Halo%20{{ urlencode($pendaftaran->nama_ortu) }},%20terkait%20pendaftaran%20{{ urlencode($pendaftaran->nama_anak) }}%20di%20TK%20ASY-SYIFA%202"
                            class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center"
                            target="_blank">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Hubungi via WhatsApp
                        </a>

                        {{-- Print --}}
                        {{-- <button onclick="window.print()"
                            class="w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-print mr-2"></i>
                            Cetak Detail
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Print Styles --}}
    <style>
        @media print {

            .bg-gradient-to-r,
            .shadow-md,
            .border,
            .rounded-lg {
                background: white !important;
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                border-radius: 0 !important;
            }

            .text-white {
                color: black !important;
            }

            nav,
            .flex.justify-between,
            button,
            a[href*="edit"],
            a[href*="whatsapp"],
            a[href*="tel:"] {
                display: none !important;
            }
        }
    </style>
@endsection
