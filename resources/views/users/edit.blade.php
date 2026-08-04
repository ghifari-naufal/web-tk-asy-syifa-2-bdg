@include('layout-lp.head')
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-user-edit text-orange-600 mr-3"></i>
            Edit User
        </h1>
        <a href="{{ route('users.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fa fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- User Info Badge -->
    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">{{ $user->name }}</h3>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if (count($errors) > 0)
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
            <div class="text-red-700">
                <strong>Gagal Mengupdate User</strong>
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
        <form method="POST" action="{{ route('users.update', $user->id) }}" id="user-edit-form">
            @csrf
            @method('PUT')
            
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user text-gray-500 mr-2"></i>
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email address" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- No HP -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-phone text-gray-500 mr-2"></i>
                    No. HP <span class="text-red-500">*</span>
                </label>
                <input type="tel" name="no_hp" value="{{ old('no_hp', $user->pendaftaran->no_hp) }}" placeholder="628xxxxxxxxx" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Format: 628xxxxxxxxx (dimulai dengan 62)
                </p>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock text-gray-500 mr-2"></i>
                    Password
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Leave blank to keep current password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 pr-10">
                    <button type="button" tabindex="-1" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none" id="toggle-password">
                        <i class="fas fa-eye" id="password-eye"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Biarkan kosong untuk mempertahankan kata sandi saat ini
                </p>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-shield-alt text-gray-500 mr-2"></i>
                    Confirm Password
                </label>
                <div class="relative">
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm new password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 pr-10">
                    <button type="button" tabindex="-1" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none" id="toggle-confirm-password">
                        <i class="fas fa-eye" id="confirm-password-eye"></i>
                    </button>
                </div>
                <span id="password-error" class="text-red-600 text-sm hidden">Password dan konfirmasi password tidak sama.</span>
            </div>

            <!-- Role -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user-tag text-gray-500 mr-2"></i>
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="roles[]" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="" disabled>-- Select Role --</option>
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}" 
                                {{ (collect(old('roles', isset($userRole) && array_key_exists($value, $userRole) ? array_keys($userRole) : []))->contains($value)) ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
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
                        class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:ring-2 focus:ring-orange-500">
                    <i class="fa-solid fa-save mr-2"></i>Update User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Client-side validation for password confirmation
    document.getElementById('user-edit-form').addEventListener('submit', function(e) {
        var password = document.getElementById('password').value;
        var confirm = document.getElementById('confirm-password').value;
        var errorSpan = document.getElementById('password-error');
        
        // Only validate if password is provided
        if(password !== '' && password !== confirm) {
            errorSpan.classList.remove('hidden');
            e.preventDefault();
        } else {
            errorSpan.classList.add('hidden');
        }
    });

    // Toggle password visibility
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
    document.querySelector('input[name="no_hp"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
        
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        
        e.target.value = value;
    });
</script>

@endsection