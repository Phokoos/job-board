<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Mykola',
             'email' => 'hulkovskij@gmail.com',
         ]);

        User::factory(300)->create();

        $users = User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        $employers = Employer::all();

        for ($j = 0; $j < 100; $j++) {
            Job::factory()->create([
               'employer_id' =>  $employers->random()->id
            ]);
        }

        foreach ($users as $user){
            $jobs = Job::inRandomOrder()->take(rand(0,4))->get();

            foreach ($jobs as $job){
                JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }



//        Job::factory(100)->create();


        // \App\Models\User::factory(10)->create();
    }
}
