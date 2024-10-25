<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roles = [
            ['nama' => 'Admin'],
            ['nama' => 'Scenario Writer'],
            ['nama' => 'Tester'],
            ['nama' => 'Developer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $user = User::create([
            'name' => 'Admin UAT',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin12345'),
        ]);

        $role = Role::where('nama', 'Admin')->first();
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
            'project_id' => null,
        ]);

        DB::table('m_status')->insert([
            ['k_status' => 1, 'label' => 'Draft'],
            ['k_status' => 2, 'label' => 'NOK'],
            ['k_status' => 3, 'label' => 'OK'],
            ['k_status' => 4, 'label' => 'Resolved'],
            ['k_status' => 5, 'label' => 'Feedback'],
        ]);
    }
}
