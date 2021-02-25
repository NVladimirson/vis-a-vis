<?php

namespace Database\Factories;

use App\Models\PhoneModel;
use App\Models\FirmModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(rand(0,3)){
            if(isset(FirmModel::all()->last()->id)){
                $firm_id = FirmModel::all()->last()->id;
            }
            else{
                $firm_id = FirmModel::factory();
            }
        }
        else{
            $firm_id = FirmModel::factory();
        }
        return [
            'firm_id' => $firm_id, //1 к 4 создание или id последнего
            'phone' => $this->faker->phoneNumber,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
