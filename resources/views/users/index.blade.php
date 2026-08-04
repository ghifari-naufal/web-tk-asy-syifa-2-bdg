@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Users Management</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola dan atur pengguna</p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-4 sm:mt-0 py-5">
                @can('user-create')
                    <a href="{{ route('users.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Create New User
                    </a>
                @endcan
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Fullname</th>
                        <th class="py-3 px-4 text-left">Username</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse ($users as $key => $user)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 font-medium">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                {{-- Role dari Spatie --}}
                                @foreach ($user->getRoleNames() as $role)
                                    <span
                                        class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mr-1">{{ $role }}</span>
                                @endforeach

                                {{-- Role dari field users.role --}}
                                @if (!empty($user->role))
                                    <span
                                        class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">{{ ucfirst($user->role) }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2 flex-wrap">
                                    {{-- Show Button --}}
                                    @can('user-list')
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded transition-colors"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan

                                    {{-- Delete Button --}}
                                    @can('user-delete')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="" onsubmit="return confirmDelete('{{ $user->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded transition-colors"
                                                title="Hapus User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan

                                    {{-- Reset Password Button --}}
                                    <form action="{{ route('users.reset.auto', $user->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirmReset('{{ $user->name }}');">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-2 py-1 bg-purple-500 hover:bg-purple-600 text-white text-xs font-medium rounded transition-colors"
                                            title="Reset Password & Kirim WA">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-8 px-4 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg font-medium">Belum ada user</p>
                                    <p class="text-sm">Silakan tambah user baru untuk mulai mengelola data.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Apakah Anda yakin ingin menghapus user <span id="deleteUserName" class="font-semibold"></span>?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelDelete"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="button" id="confirmDelete"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Confirmation Modal -->
    <div id="resetModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-key text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Reset Password</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Apakah Anda yakin ingin mereset password untuk user <span id="resetUserName"
                            class="font-semibold"></span>?
                        Password baru akan digenerate otomatis dan dikirim melalui WhatsApp.
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelReset"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="button" id="confirmReset"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            Reset Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;

        // Delete confirmation function
        function confirmDelete(userName) {
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteModal').classList.remove('hidden');
            currentForm = event.target.closest('form');
            return false; // Prevent immediate form submission
        }

        // Reset confirmation function
        function confirmReset(userName) {
            document.getElementById('resetUserName').textContent = userName;
            document.getElementById('resetModal').classList.remove('hidden');
            currentForm = event.target.closest('form');
            return false; // Prevent immediate form submission
        }

        // Modal event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Delete modal events
            document.getElementById('cancelDelete').addEventListener('click', function() {
                document.getElementById('deleteModal').classList.add('hidden');
                currentForm = null;
            });

            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (currentForm) {
                    currentForm.submit();
                }
            });

            // Reset modal events
            document.getElementById('cancelReset').addEventListener('click', function() {
                document.getElementById('resetModal').classList.add('hidden');
                currentForm = null;
            });

            document.getElementById('confirmReset').addEventListener('click', function() {
                if (currentForm) {
                    currentForm.submit();
                }
            });

            // Close modal when clicking outside
            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    currentForm = null;
                }
            });

            document.getElementById('resetModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    currentForm = null;
                }
            });
        });

        // Auto-hide success message after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.bg-green-100');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.transition = 'opacity 0.5s ease-out';
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }
        });
    </script>

    <style>
        /* Custom badge styles */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            border-radius: 0.375rem;
            margin-right: 0.25rem;
        }

        .bg-primary {
            background-color: #3b82f6;
            color: white;
        }

        .bg-success {
            background-color: #10b981;
            color: white;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .overflow-x-auto {
                font-size: 0.875rem;
            }

            .py-3.px-4 {
                padding: 0.5rem;
            }
        }
    </style>
@endsection
