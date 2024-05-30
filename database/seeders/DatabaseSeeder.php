<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'      => 'Developer',
            'email'     => 'developer@example.com',
            'password'  => 'developer123',
            'gender'    => 'female',
        ]);
        User::factory()->count(9)->create();
        Follower::factory()->count(40)->create();

    }
}
