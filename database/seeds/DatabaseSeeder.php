<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        \Illuminate\Support\Facades\DB::table('users')->delete();

        $users = array(
            [
                'name' => 'Naveed',
                'email' => 'n@g.c',
                'password' => \Illuminate\Support\Facades\Hash::make('naveed'),
                'role' => 'Admin',
                'status' => 'Enabled'
            ],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            \Illuminate\Foundation\Auth\User::create($user);
        }

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
