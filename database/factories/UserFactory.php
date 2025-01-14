<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $tagName = '@' . strtolower(
            trim(
                preg_replace(
                    '/-+/',
                    '-',
                    preg_replace(
                        '/[^a-z0-9-]/',
                        '',
                        preg_replace(
                            '/\s+/',
                            '-',
                            strtolower(
                                preg_replace(
                                    '/[^a-zA-Z0-9\s]/',
                                    '',
                                    preg_replace('/\s+/', ' ', $name)
                                )
                            )
                        )
                    )
                ),
                '-'
            )
        );

        return [
            'name' => $name,
            'tag_name' => $tagName,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
