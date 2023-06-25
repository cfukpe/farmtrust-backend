<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utilities\AppConstants;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = "admin@123";
        $data = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'phone_number' => '081000000000',
            'password' => Hash::make($password),
            'role' => AppConstants::$ADMIN,
            'status' => AppConstants::$ACTIVE,
            'email_verified_at' => Carbon::now()
        ];

        User::firstOrCreate(['email' => $data['email']], $data);
    }
}