@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Daftar Ulang Saya</h2>
        <div class="flex space-x-3 mt-4 md:mt-0">
            {{-- <a href="{{ route('daftar-ulang.create') }}"
               class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold text-sm rounded-lg shadow transition">
                <i class="fa fa-plus mr-2"></i> Daftar Ulang Baru
            </a> --}}
            <a href="{{ route('daftar-ulang.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm rounded-lg shadow transition">
                <i class="fa fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Pesan Sukses --}}
    @if ($message = Session::get('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg shadow">
            {{ $message }}
        </div>
    @endif

    @if($daftarUlang->count() > 0)
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wide">
                        <tr>
                            <th class="px-4 py-3 border-b">No</th>
                            <th class="px-4 py-3 border-b">Tahun Ajaran</th>
                            <th class="px-4 py-3 border-b">Biaya</th>
                            <th class="px-4 py-3 border-b">Tanggal Daftar</th>
                            <th class="px-4 py-3 border-b">Bukti Pembayaran</th>
                            {{-- <th class="px-4 py-3 border-b text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($daftarUlang as $key => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $key + 1 }}</td>
                                <td class="px-4 py-3">{{ $item->tahun_ajaran }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($item->biaya_daftar_ulang, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $item->tanggal_daftar->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    @if($item->bukti_pembayaran)
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                            ✓ Uploaded
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-500 rounded-full">
                                            - Belum Upload
                                        </span>
                                    @endif
                                </td>
                                {{-- <td class="px-4 py-3 text-center">
                                    <a href="{{ route('daftar-ulang.show', $item->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-medium shadow transition">
                                        <i class="fa fa-eye mr-1"></i> Detail
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {!! $daftarUlang->links() !!}
            </div>
        </div>
    @else
        <div class="text-center bg-yellow-50 border border-yellow-200 p-6 rounded-xl shadow-md">
            <h5 class="text-lg font-semibold text-yellow-700 mb-2">Belum Ada Data Daftar Ulang</h5>
            <p class="text-sm text-gray-600 mb-4">
                Anda belum pernah melakukan daftar ulang. Silakan klik tombol di bawah untuk memulai.
            </p>
            <a href="{{ route('daftar-ulang.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg shadow transition">
                <i class="fa fa-plus mr-2"></i> Daftar Ulang Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
