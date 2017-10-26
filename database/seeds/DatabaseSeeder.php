<?php

use App\Option;
use App\Poll;
use App\User;
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
        $options = ['Chrome', 'Firefox', 'NodeJS', 'TeX', 'Python', 'Rails'];

        $userObj = User::create([
            'name' => 'Slavo Kozar',
            'email' => 'slavo.kozar@gmail.com',
            'password' => bcrypt('qwerty')
        ]);

        $pollObj = Poll::create([
            'user_id' => $userObj->id,
            'code' => uniqid(),
            'name' => 'Lorem Ipsum',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'public' => true,
            'single_option' => true
        ]);

        foreach($options as $option){
            Option::create(['poll_id' => $pollObj->id, 'name' => $option]);
        }

        $pollObj = Poll::create([
            'user_id' => $userObj->id,
            'code' => uniqid(),
            'name' => 'Finibus Bonorum',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'public' => true,
            'single_option' => true
        ]);

        foreach($options as $option){
            Option::create(['poll_id' => $pollObj->id, 'name' => $option]);
        }

        $pollObj = Poll::create([
            'user_id' => $userObj->id,
            'code' => uniqid(),
            'name' => 'Consequuntur Magni',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'public' => true,
            'single_option' => true
        ]);

        foreach($options as $option){
            Option::create(['poll_id' => $pollObj->id, 'name' => $option]);
        }

        $pollObj = Poll::create([
            'user_id' => $userObj->id,
            'code' => uniqid(),
            'name' => 'Facere Possimus',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'public' => true,
            'single_option' => true
        ]);

        foreach($options as $option){
            Option::create(['poll_id' => $pollObj->id, 'name' => $option]);
        }

    }
}
