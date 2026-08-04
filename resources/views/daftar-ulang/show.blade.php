@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Daftar Ulang</h2>
        <a href="{{ route('daftar-ulang.index') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            ← Kembali
        </a>
    </div>

    {{-- Card Detail --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <strong>Nama:</strong> {{ $daftarUlang->user->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $daftarUlang->user->email }}
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <strong>Tahun Ajaran:</strong> {{ $daftarUlang->tahun_ajaran }}
            </div>
            <div>
                <strong>Biaya:</strong> Rp {{ number_format($daftarUlang->biaya_daftar_ulang, 0, ',', '.') }}
            </div>
        </div>

        <div class="mb-4">
            <strong>Tanggal Daftar:</strong> {{ $daftarUlang->tanggal_daftar->format('d/m/Y H:i') }}
        </div>

        @if($daftarUlang->bukti_pembayaran)
        <div class="mb-6">
            <strong>Bukti Pembayaran:</strong>
            <div class="mt-2">
                <img src="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" 
                     alt="Bukti Pembayaran" 
                     class="max-w-md rounded-lg border">
            </div>
            <div class="mt-2">
                <a href="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" 
                   target="_blank" 
                   class="px-3 py-2 border rounded-lg text-blue-600 hover:bg-blue-50 text-sm">
                    Lihat
                </a>
            </div>
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex gap-2">
            @can('daftar-ulang-edit')
            <a href="{{ route('daftar-ulang.edit', $daftarUlang->id) }}" 
               class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                Edit
            </a>
            @endcan
            @can('daftar-ulang-delete')
            <form action="{{ route('daftar-ulang.destroy', $daftarUlang->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                        onclick="return confirm('Yakin ingin menghapus?')">
                    Delete
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
@endsection
