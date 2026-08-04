@include('layout-lp.head')
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-shield-alt text-purple-600 mr-3"></i>
            Create New Role
        </h1>
        <a href="{{ route('roles.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fa fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- Error Messages -->
    @if (count($errors) > 0)
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
            <div class="text-red-700">
                <strong>Gagal Membuat Role</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">Role Information</h2>
            <p class="text-purple-100 text-sm mt-1">Create a new role with specific permissions</p>
        </div>

        <!-- Form Body -->
        <form method="POST" action="{{ route('roles.store') }}" class="p-6">
            @csrf
            
            <!-- Role Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag text-gray-500 mr-2"></i>
                    Role Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter role name (e.g., Admin, Guru, Orang Tua)" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Use descriptive names like "Admin", "Guru", or "Orang Tua"
                </p>
            </div>

            <!-- Permissions Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-key text-gray-500 mr-2"></i>
                        Permissions <span class="text-red-500">*</span>
                    </label>
                    
                    <!-- Select All/None Controls -->
                    <div class="flex space-x-2">
                        <button type="button" id="select-all" 
                                class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                            Select All
                        </button>
                        <span class="text-gray-300">|</span>
                        <button type="button" id="select-none" 
                                class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                            Select None
                        </button>
                    </div>
                </div>

                <!-- Permissions Grid -->
                <div class="border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto bg-gray-50">
                    @if(count($permission) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($permission as $perm)
                                <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-purple-50 hover:border-purple-200 cursor-pointer transition-colors duration-200">
                                    <input type="checkbox" 
                                           name="permission[{{$perm->id}}]" 
                                           value="{{$perm->id}}" 
                                           {{ in_array($perm->id, old('permission', [])) ? 'checked' : '' }}
                                           class="form-checkbox h-4 w-4 text-purple-600 rounded focus:ring-purple-500 border-gray-300">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">{{ $perm->name }}</span>
                                        @if($perm->description ?? false)
                                            <p class="text-xs text-gray-500">{{ $perm->description }}</p>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                            <p>No permissions available</p>
                        </div>
                    @endif
                </div>

                <p class="text-sm text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Select permissions that this role should have access to
                </p>
            </div>

            <!-- Selected Permissions Counter -->
            <div class="mb-6 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center text-sm text-blue-700">
                    <i class="fas fa-list-check mr-2"></i>
                    Selected Permissions: <span id="permission-count" class="font-bold ml-1">0</span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('roles.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Create Role
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="permission"]');
    const selectAllBtn = document.getElementById('select-all');
    const selectNoneBtn = document.getElementById('select-none');
    const permissionCount = document.getElementById('permission-count');

    // Function to update permission counter
    function updatePermissionCount() {
        const checkedCount = document.querySelectorAll('input[type="checkbox"][name^="permission"]:checked').length;
        permissionCount.textContent = checkedCount;
    }

    // Select all permissions
    selectAllBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        updatePermissionCount();
    });

    // Select no permissions
    selectNoneBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        updatePermissionCount();
    });

    // Update counter when individual checkboxes are clicked
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updatePermissionCount);
    });

    // Initial count
    updatePermissionCount();

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const checkedPermissions = document.querySelectorAll('input[type="checkbox"][name^="permission"]:checked');
        if (checkedPermissions.length === 0) {
            e.preventDefault();
            alert('Please select at least one permission for this role.');
            return false;
        }
    });
});
</script>

@endsection