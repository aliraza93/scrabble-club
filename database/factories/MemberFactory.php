<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->customPhoneNumberFormat(),
            'joined_at' => $this->faker->date(),
        ];
    }

    private function customPhoneNumberFormat(): string
    {
        // Generate the first two digits
        $firstTwoDigits = $this->faker->numberBetween(10, 99);

        // Generate the next four digits
        $middleDigits = $this->faker->numberBetween(1000, 9999);

        // Generate the last four digits
        $lastFourDigits = $this->faker->numberBetween(1000, 9999);

        // Return the formatted phone number
        return "($firstTwoDigits) $middleDigits-$lastFourDigits";
    }
}
