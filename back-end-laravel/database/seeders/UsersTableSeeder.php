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
      $users = config('users');

      foreach($users as $user){

        $new_user = new User();
        $new_user->name = $user;
        $new_user->email = $user . '@gmail.com';
        $new_user->password = Hash::make('12341234');
        $new_user->save();

        }

    }
}
