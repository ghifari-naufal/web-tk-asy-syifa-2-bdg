@extends('layouts.app')

@section('content')
    {{-- Tombol kembali --}}
    <a href="{{ route('monitoringperkembangan.index') }}"
        class="inline-flex items-center px-2 py-2 rounded-md border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
        ← Kembali
    </a>
    <div class="max-w-5xl mx-auto px-4 py-6">
        <h3 class="text-2xl font-semibold mb-6">Tambah Perkembangan Siswa</h3>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            {{-- Filter kelas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label for="filterKelas" class="block text-sm font-medium text-gray-700 mb-1">Filter Kelas</label>
                    <select id="filterKelas"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                        <option value="">Semua</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari / Petunjuk</label>
                    <div class="text-sm text-gray-500">Pilih siswa dari tabel di bawah. Setelah memilih, isi kegiatan,
                        catatan, dan upload dokumentasi lalu klik <span
                            class="font-medium text-gray-700">Simpan</span>.</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Tabel daftar siswa --}}
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-lg shadow-sm p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Siswa</label>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="tabelSiswa">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Pilih</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Nama Anak</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Kelas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($pendaftaran as $p)
                                    <tr data-kelas="{{ $p->kelas_tk }}">
                                        <td class="px-3 py-2">
                                            <input type="radio" name="pendaftaran_id" value="{{ $p->id }}"
                                                form="formPerkembangan"
                                                class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        </td>
                                        <td class="px-3 py-2 text-sm text-gray-700">{{ $p->nama_anak }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $p->kelas_tk ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @error('pendaftaran_id')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Form tambah perkembangan --}}
                <div class="bg-white border border-gray-100 rounded-lg shadow-sm p-4">
                    <form id="formPerkembangan" action="{{ route('monitoringperkembangan.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label for="kegiatan" class="block text-sm font-medium text-gray-700">Kegiatan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="kegiatan" id="kegiatan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
                                required>
                            @error('kegiatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                            <textarea name="deskripsi" id="catatan" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="dokumentasi" class="block text-sm font-medium text-gray-700">Upload
                                Dokumentasi</label>
                            <input type="file" name="foto" id="dokumentasi"
                                class="mt-1 block w-full text-sm text-gray-700">
                            <p class="text-xs text-gray-400 mt-1">jpg, png, pdf (max 2MB).</p>
                            @error('foto')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Simpan</button>

                            <button type="button" id="btnReset"
                                class="px-3 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Riwayat terbaru --}}
            <div class="bg-white border border-gray-100 rounded-lg shadow-sm p-4">
                <h4 class="text-lg font-medium mb-4">Riwayat Terbaru</h4>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Nama Anak</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Kelas</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Kegiatan</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Catatan</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatBody">
                            @foreach ($riwayat as $r)
                                <tr data-kelas="{{ $r->pendaftaran->kelas_tk ?? '' }}">
                                    <td class="px-3 py-2 text-sm text-gray-600">{{ $r->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ $r->pendaftaran->nama_anak ?? '-' }}
                                    </td>
                                    <td class="px-3 py-2 text-sm text-gray-500">{{ $r->pendaftaran->kelas_tk ?? '-' }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ $r->kegiatan }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-600">{{ $r->deskripsi ?? '-' }}</td>
                                    <td class="px-3 py-2 text-sm">
                                        @if ($r->foto)
                                            <a href="{{ asset('storage/' . $r->foto) }}" target="_blank"
                                                class="text-green-600 hover:underline">Lihat</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- kecil: info jumlah --}}
                <div class="mt-3 text-xs text-gray-400">Menampilkan {{ $riwayat->count() }} data terbaru.</div>
            </div>
        </div>
    </div>

    {{-- Script filter kelas + utilitas kecil --}}
    <script>
        (function() {
            const filterEl = document.getElementById('filterKelas');
            const siswaRows = document.querySelectorAll('#tabelSiswa tbody tr');
            const riwayatRows = document.querySelectorAll('#riwayatBody tr');
            const btnReset = document.getElementById('btnReset');

            function applyFilter() {
                const filter = filterEl.value;

                // filter daftar siswa
                siswaRows.forEach(row => {
                    const kelas = (row.dataset.kelas || '').toString();
                    if (!filter || kelas === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                        const radio = row.querySelector('input[type="radio"]');
                        if (radio && radio.checked) radio.checked = false;
                    }
                });

                // filter riwayat
                riwayatRows.forEach(row => {
                    const kelas = (row.dataset.kelas || '').toString();
                    if (!filter || kelas === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // apply saat load agar state konsisten jika ada value default
            applyFilter();

            filterEl.addEventListener('change', applyFilter);

            // Reset kecil untuk form
            if (btnReset) {
                btnReset.addEventListener('click', () => {
                    document.getElementById('formPerkembangan').reset();
                    // juga reset radio selection
                    document.querySelectorAll('#tabelSiswa input[type="radio"]').forEach(r => r.checked =
                        false);
                });
            }
        })();
    </script>
@endsection
