<?php

namespace EOA\Ability\Database\Factories;

use EOA\Ability\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;


class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
