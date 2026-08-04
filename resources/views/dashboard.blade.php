@extends('layouts.app')

@section('content')
    @hasanyrole('Admin')
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard TK Asy-Syifa 2 Kota Bandung</h1>
                <p class="text-gray-600"></p>
            </div>

            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Pendaftar -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Pendaftar</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalPendaftar }}</p>
                            <p class="text-xs text-green-600 mt-1">
                                <i class="fas fa-arrow-up"></i> {{ $approvalRate }}% disetujui
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pendaftar Disetujui -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Sudah Disetujui</p>
                            <p class="text-3xl font-bold text-green-600">{{ $pendaftarApproved }}</p>
                            <p class="text-xs text-gray-500 mt-1">Siswa aktif</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Persetujuan</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendaftarPending }}</p>
                            <p class="text-xs text-red-500 mt-1">{{ $pendaftarRejected }} ditolak</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Daftar Ulang -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Daftar Ulang</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $totalDaftarUlang }}</p>
                            <p class="text-xs text-green-600 mt-1">{{ $daftarUlangTahunIni }} tahun ini</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-redo text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Users Stats -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-users text-blue-500 mr-2"></i>Pengguna Sistem
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Admin</span>
                            <span
                                class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">{{ $totalAdmin }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Guru</span>
                            <span
                                class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">{{ $totalGuru }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Orang Tua</span>
                            <span
                                class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">{{ $totalOrtu }}</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between items-center font-medium">
                            <span class="text-sm text-gray-700">Total</span>
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">{{ $totalUsers }}</span>
                        </div>
                    </div>
                </div>

                <!-- Monitoring Stats -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>Monitoring Perkembangan
                    </h3>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-green-600 mb-2">{{ $totalMonitoring }}</p>
                        <p class="text-sm text-gray-600 mb-4">Total Laporan</p>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-sm text-green-700">
                                <i class="fas fa-calendar text-green-500 mr-1"></i>
                                {{ $monitoringBulanIni }} laporan bulan ini
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Financial Stats -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-money-bill-wave text-purple-500 mr-2"></i>Keuangan
                    </h3>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600 mb-2">Rp
                            {{ number_format($totalBiayaDaftarUlang, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mb-4">Total Biaya Daftar Ulang</p>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <p class="text-sm text-purple-700">
                                <i class="fas fa-users text-purple-500 mr-1"></i>
                                Dari {{ $totalDaftarUlang }} pendaftaran ulang
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Pendaftaran -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-clock text-blue-500 mr-2"></i>Pendaftaran Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach ($recentPendaftaran as $pendaftaran)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">{{ $pendaftaran->nama_anak }}</p>
                                    <p class="text-xs text-gray-500">{{ $pendaftaran->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    {!! $pendaftaran->getStatusBadge() !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Monitoring -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>Monitoring Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach ($recentMonitoring as $monitoring)
                            <div class="py-2 border-b border-gray-100 last:border-b-0">
                                <p class="text-sm font-medium text-gray-700">{{ Str::limit($monitoring->kegiatan, 25) }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $monitoring->guru->name ?? 'Unknown' }} •
                                    {{ $monitoring->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Daftar Ulang -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        <i class="fas fa-redo text-purple-500 mr-2"></i>Daftar Ulang Terbaru
                    </h3>
                    <div class="space-y-3">
                        @foreach ($recentDaftarUlang as $daftarUlang)
                            <div class="py-2 border-b border-gray-100 last:border-b-0">
                                <p class="text-sm font-medium text-gray-700">{{ $daftarUlang->user->name ?? 'Unknown' }}</p>
                                <div class="flex justify-between items-center mt-1">
                                    <p class="text-xs text-gray-500">{{ $daftarUlang->tahun_ajaran }}</p>
                                    <span class="text-xs font-medium text-green-600">
                                        Rp {{ number_format($daftarUlang->biaya_daftar_ulang, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endhasanyrole

    {{-- Jika role Guru --}}
    @hasrole('Guru')
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Guru</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Card Siswa Approved --}}
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <h2 class="text-lg font-semibold text-blue-600 mb-3">Siswa yang Sudah Di-approve</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Nama Anak</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Orang Tua</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Kelas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if (isset($approvedSiswa) && $approvedSiswa->count() > 0)
                                    @foreach ($approvedSiswa as $siswa)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2">{{ $siswa->nama_anak }}</td>
                                            <td class="px-4 py-2">{{ $siswa->nama_ortu }}</td>
                                            <td class="px-4 py-2">{{ $siswa->kelas ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- Data Dummy --}}
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">Andi</td>
                                        <td class="px-4 py-2">Bapak Budi</td>
                                        <td class="px-4 py-2">TK A</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">Siti</td>
                                        <td class="px-4 py-2">Ibu Rina</td>
                                        <td class="px-4 py-2">TK B</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if (!isset($approvedSiswa) || $approvedSiswa->count() == 0)
                        <p class="text-gray-400 text-xs mt-2">*Contoh data (belum ada siswa yang di-approve).</p>
                    @endif
                </div>

                {{-- Card Monitoring Perkembangan --}}
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <h2 class="text-lg font-semibold text-green-600 mb-3">Monitoring Perkembangan Siswa</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Nama Anak</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Perkembangan</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if (isset($monitoring) && $monitoring->count() > 0)
                                    @foreach ($monitoring as $m)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2">{{ $m->siswa->nama_anak ?? '-' }}</td>
                                            <td class="px-4 py-2">{{ $m->catatan }}</td>
                                            <td class="px-4 py-2">{{ $m->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- Data Dummy --}}
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">Andi</td>
                                        <td class="px-4 py-2">Sudah bisa mengenal huruf A - D</td>
                                        <td class="px-4 py-2">20-08-2025</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">Siti</td>
                                        <td class="px-4 py-2">Aktif dalam kegiatan menggambar</td>
                                        <td class="px-4 py-2">21-08-2025</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if (!isset($monitoring) || $monitoring->count() == 0)
                        <p class="text-gray-400 text-xs mt-2">*Contoh data monitoring (belum ada data asli).</p>
                    @endif
                </div>
            </div>
        </div>
    @endhasrole
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Konfigurasi warna yang konsisten
        const colors = {
            primary: '#3b82f6',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            purple: '#8b5cf6',
            indigo: '#6366f1'
        };

        
    </script>
@endsection
