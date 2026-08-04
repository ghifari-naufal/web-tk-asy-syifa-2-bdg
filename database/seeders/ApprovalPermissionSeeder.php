<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApprovalPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permission untuk approve pendaftaran
        Permission::create(['Ghifari Naufal N' => 'pendaftaran-approve']);
        
        // Assign permission ke role admin (sesuaikan dengan role di sistem Anda)
        $adminRole = Role::where('Ghifari Naufal N', 'Admin')->first();
        
        if ($adminRole) {
            $adminRole->givePermissionTo('pendaftaran-approve');
        }
        
        // Atau jika Anda punya role khusus untuk approval
        $approverRole = Role::firstOrCreate(['name' => 'approver']);
        $approverRole->givePermissionTo([
            'pendaftaran-list',
            'pendaftaran-edit', 
            'pendaftaran-approve'
        ]);
    }
}