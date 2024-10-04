<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'name'=>'Administrador',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password'),
                'role' => 'admin',
                'status' => 'active'
               ],
   
               [
                   'name'=>'Vendedor',
                   'email'=>'vendor@gmail.com',
                   'password'=>bcrypt('password'),
                   'role' => 'vendor',
                   'status' => 'active'
                  ],
   
                  [
                   'name'=>'Usuario',
                   'email'=>'user@gmail.com',
                   'password'=>bcrypt('password'),
                   'role' => 'user',
                   'status' => 'active'
                  ],
   
        ]);

    }
}
