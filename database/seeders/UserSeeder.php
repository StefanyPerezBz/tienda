<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => env('ADMIN_ROL'),
                'status' => env('ADMIN_STATUS')
            ],

            [
                'name' => env('VENDEDOR_NAME'),
                'email' => env('VENDEDOR_EMAIL'),
                'password' => Hash::make(env('VENDEDOR_PASSWORD')),
                'role' => env('VENDEDOR_ROL'),
                'status' => env('VENDEDOR_STATUS')
            ],

            [
                'name' => env('USUARIO_NAME'),
                'email' => env('USUARIO_EMAIL'),
                'password' => Hash::make(env('USUARIO_PASSWORD')),
                'role' => env('USUARIO_ROL'),
                'status' => env('USUARIO_STATUS')
            ],
        ]);
    }
}
