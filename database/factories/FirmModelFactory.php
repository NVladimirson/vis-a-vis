<?php

namespace Database\Factories;
use App\Models\FirmModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FirmModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FirmModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
