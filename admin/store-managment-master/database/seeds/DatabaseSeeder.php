<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin@admin.com',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        $user->givePermissionTo('super-admin');
        // $this->call(UserSeeder::class);

    }
}
