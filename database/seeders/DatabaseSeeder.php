<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Member;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Member::factory(10)->create()->each(function ($member) {
            $games = Game::factory(5)->create();
            foreach ($games as $game) {
                $member->games()->attach($game->id, ['score' => rand(50, 300)]);
            }
        });
    }
}
