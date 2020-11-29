<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function guru()
    {
        return $this->state([
            'role' => 'guru'
        ]);
    }

    public function admin()
    {
        return $this->state([
            'role' => 'admin'
        ]);
    }

    public function siswa()
    {
        return $this->state([
            'role' => 'siswa'
        ]);
    }
}
