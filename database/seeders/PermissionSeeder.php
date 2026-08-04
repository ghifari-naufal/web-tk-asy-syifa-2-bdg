<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Roles terlebih dahulu
        $roles = [
            'Admin',
            'Guru', 
            'orangtua'
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        // 2. Buat Permissions
        $permissions = [
            // Role & User Management
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
            // Pendaftaran Management
            'pendaftaran-list',
            'pendaftaran-create',
            'pendaftaran-edit',
            'pendaftaran-delete',
            'pendaftaran-approve',
            
            // Monitoring Perkembangan
            'perkembangan-list',
            'perkembangan-create',
            'perkembangan-edit',
            'perkembangan-delete',
            
            // Daftar Ulang Management
            'daftar-ulang-list',
            'daftar-ulang-create',
            'daftar-ulang-edit',
            'daftar-ulang-delete',
            
            // Dashboard & Reports
            'dashboard-view',
            
            // Password Reset Management
            // 'password-reset-manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // 3. Assign Permissions ke Roles
        
        // Admin mendapat semua permission
        $adminRole = Role::findByName('Admin');
        $adminRole->syncPermissions(Permission::all());

        // Guru mendapat permission terbatas
        // $guruRole = Role::findByName('Guru');
        // $guruPermissions = [
        //     'pendaftaran-list',
        //     'perkembangan-list',
        //     'perkembangan-create',
        //     'perkembangan-edit',
        //     'perkembangan-delete',
        //     'dashboard-view',
        // ];
        // $guruRole->syncPermissions($guruPermissions);

        // Orang Tua mendapat permission sangat terbatas
        $ortuRole = Role::findByName('orangtua');
        $ortuPermissions = [
            'pendaftaran-create',
            'perkembangan-list', // hanya perkembangan anak sendiri
            'daftar-ulang-create',
            'dashboard-view',
        ];
        $ortuRole->syncPermissions($ortuPermissions);

        // 4. Assign role Admin ke user pertama (id = 1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('Admin');
        }

        // 5. (Opsional) Buat beberapa user contoh dengan role
        // $this->createSampleUsers();
    }

    // private function createSampleUsers()
    // {
    //     // Buat user Guru contoh
    //     $guru = User::firstOrCreate(
    //         ['email' => 'guru@tk.com'],
    //         [
    //             'name' => 'Guru Contoh',
    //             'password' => bcrypt('password123'),
    //             'role' => 'Guru'
    //         ]
    //     );
    //     $guru->assignRole('Guru');

    //     // Buat user Orang Tua contoh  
    //     $ortu = User::firstOrCreate(
    //         ['email' => 'ortu@gmail.com'],
    //         [
    //             'name' => 'Orang Tua Contoh',
    //             'password' => bcrypt('password123'),
    //             'role' => 'Orang Tua'
    //         ]
    //     );
    //     $ortu->assignRole('Orang Tua');
    // }
}