<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $new_user = new User();
      $new_user->name = 'Alessandro';
      $new_user->email = 'alessandro@gmail.com';
      $new_user->password = Hash::make('12341234');

      $new_user->save();

    }
}
