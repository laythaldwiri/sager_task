<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');

        // ======================================================================
        // =========================== Admin Section ============================
        // ======================================================================
        User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@sager.com',
            'password' => $password,
            'status' => 1, // 1 => Active
        ]);
    }
}
