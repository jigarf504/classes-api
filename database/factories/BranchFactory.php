<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;
use Illuminate\Support\Str;
class BranchFactory extends Factory
{
    protected $model = Branch::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'branch_code' => Str::random(5),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => random_int(900000000,9999999999),
            'phone' => random_int(900000000,9999999999),
            'address' => 'new india colony nikol',
            'contact_person_name' => $this->faker->name(),
            'contact_person_email' => $this->faker->unique()->safeEmail(),
            'contact_person_mobile' => random_int(900000000,9999999999),
        ];
    }
}
