<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['username' => 'admin@polban.ac.id', 'password' => app('hash')->make('admin')],
            ['username' => 'konselor@polban.ac.id', 'password' => app('hash')->make('konselor')],
            ['username' => 'mahasiswasatu@polban.ac.id', 'password' => app('hash')->make('mahasiswasatu')],
            ['username' => 'mahasiswadua@polban.ac.id', 'password' => app('hash')->make('mahasiswadua')],
            ['username' => 'pd3@polban.ac.id', 'password' => app('hash')->make('pd3')],
        ];
        foreach($users as $user){
        		User::create($user);
    		}
    }
}
