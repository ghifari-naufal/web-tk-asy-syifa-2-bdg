@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-users mr-2 text-green-500"></i>
                    Data Pendaftaran TK
                </h2>
                <p class="text-gray-600 mt-1">Kelola data pendaftaran siswa baru</p>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Filter dan Search --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="p-6">
                <form method="GET" action="{{ route('pendaftaran.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status:</label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kelas:</label>
                            <select name="kelas"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Semua Kelas</option>
                                <option value="TK A" {{ request('kelas') == 'TK A' ? 'selected' : '' }}>TK A</option>
                                <option value="TK B" {{ request('kelas') == 'TK B' ? 'selected' : '' }}>TK B</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari:</label>
                            <input type="text" name="search"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="Nama anak atau orang tua..." value="{{ request('search') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i>
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-800">{{ $pendaftarans->total() }}</div>
                        <div class="text-sm text-gray-600">Total Pendaftar</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-800">
                            {{ $pendaftarans->where('status', 'pending')->count() }}</div>
                        <div class="text-sm text-gray-600">Menunggu</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-800">
                            {{ $pendaftarans->where('status', 'approved')->count() }}</div>
                        <div class="text-sm text-gray-600">Disetujui</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-times text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-800">
                            {{ $pendaftarans->where('status', 'rejected')->count() }}</div>
                        <div class="text-sm text-gray-600">Ditolak</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        @if ($pendaftarans->count() > 0)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data Pendaftar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dokumen Persyaratan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bukti Pembayaran</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persetujuan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pendaftarans as $key => $pendaftaran)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $key + $pendaftarans->firstItem() }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-green-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $pendaftaran->nama_anak }}</div>
                                                <div class="text-sm text-gray-500">Ortu: {{ $pendaftaran->nama_ortu }}
                                                </div>
                                                <div class="text-sm text-gray-500">HP: {{ $pendaftaran->no_hp }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $pendaftaran->kelas_tk == 'TK A' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            <i class="fas fa-graduation-cap mr-1"></i>
                                            {{ $pendaftaran->kelas_tk }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pendaftaran->hasDokumenPersyaratan())
                                            <div class="flex items-center space-x-2">
                                                <i class="{{ $pendaftaran->getDokumenPersyaratanTypeIcon() }}"></i>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ \Illuminate\Support\Str::limit($pendaftaran->dokumen_persyaratan_title ?: 'Dokumen Persyaratan', 20) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $pendaftaran->getFormattedDokumenPersyaratanSize() }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-red-400">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Belum upload
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pendaftaran->hasFile())
                                            <div class="flex items-center space-x-2">
                                                <i class="{{ $pendaftaran->getFileTypeIcon() }}"></i>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ \Illuminate\Support\Str::limit($pendaftaran->file_title ?: 'Bukti Pembayaran', 20) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $pendaftaran->getFormattedFileSize() }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400">
                                                <i class="fas fa-file-times mr-1"></i>
                                                Tidak ada file
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            {!! $pendaftaran->getStatusBadge() !!}
                                            @if ($pendaftaran->status == 'approved' && $pendaftaran->approvedBy)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-user-check mr-1"></i>
                                                    {{ $pendaftaran->approvedBy->name }}
                                                    <div class="text-xs text-gray-400">
                                                        {{ $pendaftaran->approved_at ? $pendaftaran->approved_at->format('d/m/Y H:i') : '' }}
                                                    </div>
                                                </div>
                                            @elseif($pendaftaran->status == 'rejected' && $pendaftaran->rejectedBy)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-user-times mr-1"></i>
                                                    {{ $pendaftaran->rejectedBy->name }}
                                                    <div class="text-xs text-gray-400">
                                                        {{ $pendaftaran->rejected_at ? $pendaftaran->rejected_at->format('d/m/Y H:i') : '' }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i') : '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            {{-- View Button --}}
                                            <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}"
                                                class="text-blue-600 hover:text-blue-900 transition duration-200 p-1 rounded hover:bg-blue-100"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>

                                            {{-- Edit Button --}}
                                            @can('pendaftaran-edit')
                                                <a href="{{ route('pendaftaran.edit', $pendaftaran->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition duration-200 p-1 rounded hover:bg-yellow-100"
                                                    title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </a>
                                            @endcan

                                            {{-- Delete Button --}}
                                            @can('pendaftaran-delete')
                                                <button type="button"
                                                    onclick="confirmDelete({{ $pendaftaran->id }}, '{{ addslashes($pendaftaran->nama_anak) }}')"
                                                    class="text-red-600 hover:text-red-900 transition duration-200 p-1 rounded hover:bg-red-100"
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{-- Approve/Reject Buttons (Only for Pending and Admin) --}}
                                        @can('pendaftaran-approve')
                                            @if ($pendaftaran->status == 'pending')
                                                <div class="flex items-center space-x-1">
                                                    <button type="button"
                                                        onclick="showApproveModal({{ $pendaftaran->id }}, '{{ addslashes($pendaftaran->nama_anak) }}')"
                                                        class="text-green-600 hover:text-green-900 transition duration-200 p-1 rounded hover:bg-green-100"
                                                        title="Setujui">
                                                        <i class="fas fa-check-circle text-sm"></i>
                                                    </button>

                                                    <button type="button"
                                                        onclick="showRejectModal({{ $pendaftaran->id }}, '{{ addslashes($pendaftaran->nama_anak) }}')"
                                                        class="text-red-600 hover:text-red-900 transition duration-200 p-1 rounded hover:bg-red-100"
                                                        title="Tolak">
                                                        <i class="fas fa-times-circle text-sm"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        @endcan
                                        {{-- Tombol Reject --}}
                                        @if ($pendaftaran->status === 'rejected')
                                            {{-- Tombol WhatsApp hanya muncul kalau sudah Reject --}}
                                            @php
                                                $nomorOrtu = preg_replace('/^0/', '62', $pendaftaran->no_hp);
                                                $pesan = urlencode(
                                                    "Halo, pendaftaran calon siswa yang bernama *{$pendaftaran->nama_anak}* ditolak.\nAlasan: {$pendaftaran->catatan}\n\n Kirim ulang bukti pembayaran anda melalui nomor ini : 083101154798",
                                                );
                                            @endphp
                                            <a href="https://wa.me/{{ $nomorOrtu }}?text={{ $pesan }}"
                                                target="_blank"
                                                class="flex items-center space-x-1 px-2 bg-[#bd0000] rounded-lg hover:bg-[#25D366]/10 transition group"
                                                title="Kirim WhatsApp">
                                                <i
                                                    class="fab fa-whatsapp text-lg text-white group-hover:text-[#25D366] transition"></i>
                                                <span
                                                    class="text-white group-hover:text-[#bd0000] transition font-semibold text-xs">Notif
                                                    Reject</span>
                                            </a>
                                        @endif
                                        {{-- Tombol Approve --}}
                                        @if ($pendaftaran->status === 'approved' && $pendaftaran->email_login && $pendaftaran->password_login)
                                            @php
                                                $pesan = urlencode(
                                                    "Pendaftaran atas nama {$pendaftaran->nama_anak} telah disetujui.\n Username: {$pendaftaran->email_login}\nPassword: {$pendaftaran->password_login}\n\nSilakan login ke sistem untuk melihat monitoring perkembangan siswa dan jangan lupa untuk ganti password.",
                                                );
                                                $wa_link = "https://wa.me/{$pendaftaran->no_hp}?text=$pesan";
                                            @endphp
                                            <a href="{{ $wa_link }}" target="_blank"
                                                class="flex items-center space-x-1 px-2 bg-[#25D366] rounded-lg hover:bg-[#25D366]/10 transition group"
                                                title="Kirim WhatsApp">
                                                <i
                                                    class="fab fa-whatsapp text-lg text-white group-hover:text-[#25D366] transition"></i>
                                                <span
                                                    class="text-white group-hover:text-[#25D366] transition font-semibold text-xs">Konfirmasi</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                    {{ $pendaftarans->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-12 text-center">
                <i class="fas fa-users fa-4x text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-600 mb-2">Belum ada data pendaftaran</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan data pendaftaran pertama</p>
                <a href="{{ route('pendaftaran.create') }}"
                    class="bg-gradient-to-r from-green-500 to-lime-500 hover:from-green-600 hover:to-lime-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Pendaftaran
                </a>
            </div>
        @endif
    </div>

    {{-- Approve Modal --}}
    <div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Setujui Pendaftaran</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menyetujui pendaftaran <strong
                        id="approveStudentName"></strong>?</p>
            </div>

            <form id="approveForm" method="POST">
                @csrf
                {{-- <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none"
                        placeholder="Tambahkan catatan untuk persetujuan..."></textarea>
                </div> --}}

                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="hideApproveModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 font-medium shadow-lg">
                        <i class="fas fa-check mr-2"></i>
                        Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Reject Modal --}}
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-times-circle text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tolak Pendaftaran</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menolak pendaftaran <strong
                        id="rejectStudentName"></strong>?</p>
            </div>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Penolakan
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea name="catatan" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 resize-none"
                        placeholder="Jelaskan alasan penolakan dengan jelas..."></textarea>
                    <small class="text-gray-500">Alasan penolakan akan dikirimkan kepada pendaftar</small>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideRejectModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200 font-medium shadow-lg">
                        <i class="fas fa-times mr-2"></i>
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Confirmation Form --}}
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function showApproveModal(id, studentName) {
            document.getElementById('approveStudentName').textContent = studentName;
            document.getElementById('approveForm').action = `/pendaftaran/${id}/approve`;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');

            // Focus on textarea
            // setTimeout(() => {
            //     document.querySelector('#approveModal textarea').focus();
            // }, 100);
        }

        function hideApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');

            // Clear form
            document.querySelector('#approveForm textarea').value = '';
        }

        function showRejectModal(id, studentName) {
            document.getElementById('rejectStudentName').textContent = studentName;
            document.getElementById('rejectForm').action = `/pendaftaran/${id}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');

            // Focus on textarea
            setTimeout(() => {
                document.querySelector('#rejectModal textarea').focus();
            }, 100);
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');

            // Clear form
            document.querySelector('#rejectForm textarea').value = '';
        }

        function confirmDelete(id, studentName) {
            if (confirm(
                    `Yakin ingin menghapus pendaftaran ${studentName}?\n\nData yang dihapus tidak dapat dikembalikan!`)) {
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/pendaftaran/${id}`;
                deleteForm.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('approveModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideApproveModal();
            }
        });

        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideRejectModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideApproveModal();
                hideRejectModal();
            }
        });

        // Form validation
        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            const catatan = this.querySelector('textarea[name="catatan"]').value.trim();
            if (!catatan) {
                e.preventDefault();
                alert('Alasan penolakan wajib diisi!');
                this.querySelector('textarea[name="catatan"]').focus();
            }
        });
    </script>

@endsection
