@include('layout-lp.head')
@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-8 px-4">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-plus text-blue-600 mr-3"></i>
                Create New User
            </h1>
            <a href="{{ route('users.index') }}"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fa fa-arrow-left mr-2"></i>Back
            </a>
        </div>

        <!-- Error Messages -->
        @if (count($errors) > 0)
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
                <div class="text-red-700">
                    <strong>Gagal Menambahkan User</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>
                                @if (strpos($error, 'The password confirmation does not match') !== false)
                                    Password dan konfirmasi password tidak sama.
                                @elseif (strpos($error, 'The no hp field must start with 62') !== false)
                                    No HP harus dimulai dengan 62 (format Indonesia).
                                @elseif (strpos($error, 'The no hp field must be at least 10 characters') !== false)
                                    No HP minimal 10 karakter.
                                @else
                                    {{ $error }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('users.store') }}" id="user-create-form">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-500 mr-2"></i>
                        Fullname <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-500 mr-2"></i>
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter username"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-500 mr-2"></i>
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Enter password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10">
                        <button type="button" tabindex="-1"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none"
                            id="toggle-password">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-shield-alt text-gray-500 mr-2"></i>
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10">
                        <button type="button" tabindex="-1"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none"
                            id="toggle-confirm-password">
                            <i class="fas fa-eye" id="confirm-password-eye"></i>
                        </button>
                    </div>
                    <span id="password-error" class="text-red-600 text-sm hidden">Password dan konfirmasi password tidak
                        sama.</span>
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-tag text-gray-500 mr-2"></i>
                        Role <span class="text-red-500">*</span>
                    </label>
                    <select name="roles[]" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled {{ empty(old('roles')) ? 'selected' : '' }}>-- Select Role --
                        </option>
                        @foreach ($roles as $value => $label)
                            @if (strtolower($label) !== 'orangtua')
                                <option value="{{ $value }}"
                                    {{ in_array($value, old('roles', [])) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Create User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Client-side validation for password confirmation
        document.getElementById('user-create-form').addEventListener('submit', function(e) {
            var password = document.getElementById('password').value;
            var confirm = document.getElementById('confirm-password').value;
            var errorSpan = document.getElementById('password-error');
            if (password !== confirm) {
                errorSpan.classList.remove('hidden');
                e.preventDefault();
            } else {
                errorSpan.classList.add('hidden');
            }
        });

        // Mata untuk password
        document.getElementById('toggle-password').addEventListener('click', function() {
            var input = document.getElementById('password');
            var eye = document.getElementById('password-eye');
            if (input.type === "password") {
                input.type = "text";
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', function() {
            var input = document.getElementById('confirm-password');
            var eye = document.getElementById('confirm-password-eye');
            if (input.type === "password") {
                input.type = "text";
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        });

        // Format no_hp input - auto add 62 if starts with 0
        // document.querySelector('input[name="no_hp"]').addEventListener('input', function(e) {
        //     let value = e.target.value.replace(/\D/g, ''); // Remove non-digits

        //     if (value.startsWith('0')) {
        //         value = '62' + value.substring(1);
        //     }

        //     e.target.value = value;
        // });
    </script>

@endsection
