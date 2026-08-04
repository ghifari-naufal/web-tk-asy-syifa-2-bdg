@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Daftar Ulang</h2>
        <a href="{{ route('daftar-ulang.index') }}" 
           class="mt-3 sm:mt-0 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-semibold">Whoops!</strong> Ada masalah dengan input Anda.
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h5 class="text-lg font-semibold text-gray-700">
                Form Edit Daftar Ulang - {{ $daftarUlang->user->name }}
            </h5>
        </div>
        <div class="p-6">
            <form action="{{ route('daftar-ulang.update', $daftarUlang->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Data Siswa -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" 
                               name="nama_user" 
                               value="{{ $daftarUlang->user->name }}" 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 text-gray-700" 
                               readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" 
                               name="email_user" 
                               value="{{ $daftarUlang->user->email }}" 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 text-gray-700" 
                               readonly>
                    </div>
                </div>

                <!-- Tahun Ajaran & Biaya -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                        <input type="text" 
                               name="tahun_ajaran" 
                               value="{{ old('tahun_ajaran', $daftarUlang->tahun_ajaran) }}" 
                               placeholder="Tahun Ajaran" 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biaya Daftar Ulang</label>
                        <input type="number" 
                               step="0.01" 
                               name="biaya_daftar_ulang" 
                               value="{{ old('biaya_daftar_ulang', $daftarUlang->biaya_daftar_ulang) }}" 
                               placeholder="Biaya" 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Upload Bukti -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran Baru (Opsional)</label>
                    <input type="file" 
                           name="bukti_pembayaran" 
                           accept="image/*" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Upload JPG/PNG maksimal 2MB. Kosongkan jika tidak ingin mengubah.</p>
                </div>

                <!-- Bukti Saat Ini -->
                @if($daftarUlang->bukti_pembayaran)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran Saat Ini</label>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" 
                             alt="Bukti Pembayaran" 
                             class="max-w-xs rounded-lg border shadow-sm">
                    </div>
                </div>
                @endif

                <!-- Submit -->
                <div class="flex justify-center">
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-lg shadow flex items-center gap-2">
                        <i class="fa fa-save"></i> Update Daftar Ulang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
