@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Monitoring Perkembangan Anak</h2>

            @hasanyrole('Guru|Admin')
                <a href="{{ route('monitoringperkembangan.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg shadow hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Perkembangan
                </a>
            @endhasanyrole
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3 border-b text-left">Nama Anak</th>
                        <th class="px-4 py-3 border-b text-left">Nama Guru</th>
                        <th class="px-4 py-3 border-b text-left">Tanggal</th>
                        <th class="px-4 py-3 border-b text-left">Kegiatan</th>
                        <th class="px-4 py-3 border-b text-left">Keterangan</th>
                        <th class="px-4 py-3 border-b text-left">Foto</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($perkembangan as $monitoring)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $monitoring->pendaftaran->nama_anak }}</td>
                            <td class="px-4 py-3">{{ $monitoring->guru->name ?? 'Tidak ada data guru' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($monitoring->created_at)->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">{{ Str::limit($monitoring->kegiatan, 75) }}</td>
                            <td class="px-4 py-3">{{ Str::limit($monitoring->deskripsi, 75) }}</td>
                            <td class="px-4 py-3">
                                @if ($monitoring->foto)
                                    <img src="{{ asset('storage/' . $monitoring->foto) }}" alt="Foto Perkembangan"
                                        class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                @else
                                    <span class="text-gray-400 italic">Belum ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                                    <a href="{{ route('monitoringperkembangan.show', $monitoring->id) }}"
                                        class="w-full sm:w-auto px-3 py-1 bg-blue-500 text-white rounded-md text-xs font-medium hover:bg-blue-600 transition">
                                        Detail
                                    </a>

                                    @can('perkembangan-edit')
                                        <a href="{{ route('monitoringperkembangan.edit', $monitoring->id) }}"
                                            class="w-full sm:w-auto px-3 py-1 bg-orange-500 text-white rounded-md text-xs font-medium hover:bg-orange-600 transition">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('perkembangan-delete')
                                        <form action="{{ route('monitoringperkembangan.destroy', $monitoring->id) }}"
                                            method="POST" class="w-full sm:w-auto"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data monitoring ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full sm:w-auto px-3 py-1 bg-red-500 text-white rounded-md text-xs font-medium hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500 italic">
                                Belum ada data monitoring perkembangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
