<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::whereEmail('superadmin@bquotes.com')->first()) {
            $user = User::create([
                'name' => 'Superadmin',
                'email' => "superadmin@bquotes.com",
                'password' => Hash::make('Ha2pp3y@#2357'),
                'email_verified_at' => Carbon::now(),
                'remember_token' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $role = Role::create(['name' => 'Superadmin']);
            $user->assignRole($role);
        }
    }
}
