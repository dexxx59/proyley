<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'rayn',
            'email' => 'ray_ner15@hotmail.com',
            'password' => bcrypt('dexter59'),
            'admin' => true
        ]);
    }
}
