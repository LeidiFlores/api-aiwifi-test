<?php

namespace Database\Factories\Api;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            "estimates_gender" => fake()->randomElement(['male', 'female']),
            "probability_gender" => rand(0,10),
            "estimates_age" => rand(1,99),
            "estimates_nationality" => fake()->country(),
            "probability_nationality" => rand(0,10),
            "mail_smtp_check" => rand(0,1),
            "mail_role" => rand(0,1),
            "mail_disposable" => rand(0,1),
            "mail_free" => rand(0,1),
        ];
    }
}
