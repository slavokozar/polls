<?php

use App\Option;
use App\Poll;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user  = User::first();

        foreach (range(1, 20) as $_) {
            $poll = Poll::create([
                'user_id'       => $user->id,
                'code'          => uniqid(),
                'name'          => implode(' ', $faker->words()),
                'description'   => $faker->text(),
                'public'        => true,
                'single_option' => true
            ]);

            foreach (['Chrome', 'Firefox', 'NodeJS', 'TeX', 'Python'] as $option) {
                Option::create([
                    'poll_id' => $poll->id,
                    'name'    => $option
                ]);
            }
        }
    }
}
