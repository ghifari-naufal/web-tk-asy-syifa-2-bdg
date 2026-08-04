@include('layout-lp.head')
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-shield-alt text-orange-600 mr-3"></i>
            Edit Role
        </h1>
        <a href="{{ route('roles.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fa fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- Role Info Badge -->
    <div class="mb-6 bg-orange-50 border border-orange-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-orange-600 text-white rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">{{ $role->name }}</h3>
                <p class="text-sm text-gray-600">Saat ini memiliki {{ count($rolePermissions) }} izin yang diberikan</p>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if (count($errors) > 0)
        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
            <div class="text-red-700">
                <strong>Gagal Mengupdate Role</strong>
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
        <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">Role Information</h2>
            <p class="text-orange-100 text-sm mt-1">Update role details and permissions</p>
        </div>

        <!-- Form Body -->
        <form method="POST" action="{{ route('roles.update', $role->id) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Role Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag text-gray-500 mr-2"></i>
                    Role Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Enter role name (e.g., Admin, Guru, Orang Tua)" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Gunakan nama yang deskriptif seperti "Admin", "Guru", atau "Orang Tua"
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
                                class="text-sm text-orange-600 hover:text-orange-800 font-medium">
                            Select All
                        </button>
                        <span class="text-gray-300">|</span>
                        <button type="button" id="select-none" 
                                class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                            Select None
                        </button>
                    </div>
                </div>

                <!-- Current vs New Permissions Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <div class="text-sm font-medium text-blue-800 mb-1">Current Permissions</div>
                        <div class="text-2xl font-bold text-blue-600" id="current-count">{{ count($rolePermissions) }}</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="text-sm font-medium text-green-800 mb-1">Selected Permissions</div>
                        <div class="text-2xl font-bold text-green-600" id="selected-count">{{ count($rolePermissions) }}</div>
                    </div>
                </div>

                <!-- Permissions Grid -->
                <div class="border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto bg-gray-50">
                    @if(count($permission) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($permission as $perm)
                                @php
                                    $isChecked = in_array($perm->id, old('permission', $rolePermissions));
                                    $isNewlyAdded = in_array($perm->id, old('permission', [])) && !in_array($perm->id, $rolePermissions);
                                    $isOriginal = in_array($perm->id, $rolePermissions);
                                @endphp
                                
                                <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:bg-orange-50 hover:border-orange-200 cursor-pointer transition-colors duration-200 
                                       {{ $isOriginal ? 'ring-2 ring-blue-200 bg-blue-50' : '' }}">
                                    <input type="checkbox" 
                                           name="permission[{{$perm->id}}]" 
                                           value="{{$perm->id}}" 
                                           {{ $isChecked ? 'checked' : '' }}
                                           data-original="{{ $isOriginal ? 'true' : 'false' }}"
                                           class="permission-checkbox form-checkbox h-4 w-4 text-orange-600 rounded focus:ring-orange-500 border-gray-300">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-900">{{ $perm->name }}</span>
                                            @if($isOriginal)
                                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full ml-2">Current</span>
                                            @endif
                                        </div>
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
                    Izin yang di-highlight biru saat ini ditugaskan untuk peran ini
                </p>
            </div>

            <!-- Changes Summary -->
            <div class="mb-6 p-3 bg-yellow-50 border border-yellow-200 rounded-lg" id="changes-summary" style="display: none;">
                <div class="text-sm text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="font-medium">Changes detected:</span>
                    <span id="changes-text"></span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('roles.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:ring-2 focus:ring-orange-500">
                    <i class="fa-solid fa-save mr-2"></i>Update Role
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.permission-checkbox');
    const selectAllBtn = document.getElementById('select-all');
    const selectNoneBtn = document.getElementById('select-none');
    const selectedCount = document.getElementById('selected-count');
    const currentCount = document.getElementById('current-count');
    const changesSummary = document.getElementById('changes-summary');
    const changesText = document.getElementById('changes-text');
    
    const originalPermissions = Array.from(checkboxes)
        .filter(cb => cb.dataset.original === 'true')
        .map(cb => cb.value);

    // Function to update counters and detect changes
    function updateCountersAndChanges() {
        const currentlySelected = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        
        selectedCount.textContent = currentlySelected.length;
        
        // Detect changes
        const added = currentlySelected.filter(id => !originalPermissions.includes(id));
        const removed = originalPermissions.filter(id => !currentlySelected.includes(id));
        
        if (added.length > 0 || removed.length > 0) {
            let changes = [];
            if (added.length > 0) changes.push(`${added.length} added`);
            if (removed.length > 0) changes.push(`${removed.length} removed`);
            
            changesText.textContent = changes.join(', ');
            changesSummary.style.display = 'block';
        } else {
            changesSummary.style.display = 'none';
        }
    }

    // Select all permissions
    selectAllBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        updateCountersAndChanges();
    });

    // Select no permissions
    selectNoneBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        updateCountersAndChanges();
    });

    // Update counters when individual checkboxes are clicked
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCountersAndChanges);
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked');
        if (checkedPermissions.length === 0) {
            e.preventDefault();
            alert('Please select at least one permission for this role.');
            return false;
        }
    });

    // Initial update
    updateCountersAndChanges();
});
</script>

@endsection