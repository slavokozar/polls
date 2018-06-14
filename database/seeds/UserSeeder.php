<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Richard',
            'email'    => 'richard@email.com',
            'password' => bcrypt('secret')
        ]);

        User::create([
            'name'     => 'Richard2',
            'email'    => 'richard2@email.com',
            'password' => bcrypt('secret')
        ]);
    }
}
