@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Daftar Ulang</h2>
        <div class="flex gap-2 mt-3 md:mt-0">
            {{-- @can('daftar-ulang-create')
                <a href="{{ route('daftar-ulang.create') }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Daftar Ulang Baru
                </a>
            @endcan --}}
            {{-- <a href="{{ route('my-registration') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Lihat Data Saya
            </a> --}}
        </div>
    </div>

    {{-- Alert --}}
    @if ($message = Session::get('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
            {{ $message }}
        </div>
    @endif

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('daftar-ulang.index') }}" class="flex flex-col md:flex-row gap-3">
            <select name="tahun_ajaran" class="w-full md:w-1/2 border rounded-lg px-3 py-2">
                <option value="">Semua Tahun Ajaran</option>
                @foreach($tahunAjaranList as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>
                <a href="{{ route('daftar-ulang.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Tahun Ajaran</th>
                    <th class="px-4 py-2 border">Biaya</th>
                    <th class="px-4 py-2 border">Tanggal Daftar</th>
                    <th class="px-4 py-2 border">Bukti</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ ++$i }}</td>
                    <td class="px-4 py-2 border">{{ $item->user->name }}</td>
                    <td class="px-4 py-2 border">{{ $item->user->email }}</td>
                    <td class="px-4 py-2 border">{{ $item->tahun_ajaran }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($item->biaya_daftar_ulang, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal_daftar->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 border">
                        @if($item->bukti_pembayaran)
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">✓ Uploaded</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-600">- Tidak Ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border space-x-2">
                        <a href="{{ route('daftar-ulang.show',$item->id) }}" 
                           class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                           Detail
                        </a>
                        {{-- @can('daftar-ulang-edit')
                        <a href="{{ route('daftar-ulang.edit',$item->id) }}" 
                           class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600">
                           Edit
                        </a>
                        @endcan --}}
                        @can('daftar-ulang-delete')
                        <form action="{{ route('daftar-ulang.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {!! $data->withQueryString()->links() !!}
    </div>
</div>
@endsection
