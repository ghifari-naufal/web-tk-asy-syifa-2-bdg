<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    public function up()
    {
        // HANYA buat role orangtua
        Role::firstOrCreate(['name' => 'orangtua', 'guard_name' => 'web']);

        // Sinkronkan HANYA user dengan role orangtua
        $orangtuaUsers = User::where('role', 'orangtua')->get();
        foreach ($orangtuaUsers as $user) {
            $user->assignRole('orangtua');
        }
    }

    public function down()
    {
        // Hapus role orangtua (akan otomatis hapus assignments juga)
        Role::where('name', 'orangtua')->delete();
    }
};
