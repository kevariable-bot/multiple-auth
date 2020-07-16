<?php

use App\Admin;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Filasi',
            'email' => 'user@mail.com',
            'password' => Hash::make('laravel7')
        ]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('laravel7')
        ]);
    }
}
