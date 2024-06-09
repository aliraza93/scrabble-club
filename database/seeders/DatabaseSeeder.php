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

        Member::factory(100)->create()->each(function ($member) {
            // Create games with at least two players
            $gamesCount = rand(1, 5); // Random number of games for each member

            for ($i = 0; $i < $gamesCount; $i++) {
                $game = Game::factory()->create();

                // Determine the number of players for each game
                $playersCount = rand(2, $gamesCount);

                // Select random players from the previously created members
                $players = Member::inRandomOrder()->limit($playersCount)->get();

                // Attach players to the game
                foreach ($players as $player) {
                    // Make sure not to attach the same member multiple times
                    if ($player->id !== $member->id) {
                        $game->members()->attach($player->id, ['score' => rand(50, 300)]);
                    }
                }

                // Attach the current member to the game
                $game->members()->attach($member->id, ['score' => rand(50, 300)]);
            }
        });
    }
}
