@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-eye text-blue-600 mr-3"></i>
            Role Details
        </h1>
        <a href="{{ route('roles.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fa fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- Role Info Card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">Role Information</h2>
            <p class="text-blue-100 text-sm mt-1">Details and assigned permissions</p>
        </div>
        
        <!-- Card Body -->
        <div class="p-6 space-y-6">
            
            <!-- Role Name -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 flex items-center">
                    <i class="fas fa-tag text-gray-400 mr-2"></i>
                    Role Name
                </h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $role->name }}</p>
            </div>

            <!-- Permissions -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 flex items-center">
                    <i class="fas fa-key text-gray-400 mr-2"></i>
                    Permissions
                </h3>
                
                @if(!empty($rolePermissions) && count($rolePermissions) > 0)
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($rolePermissions as $v)
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">
                                {{ $v->name }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 mt-2 italic">No permissions assigned</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
