<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Patient::class;

    public function definition()
    {
        return [
                'name'=> $this->faker->name(),
                'phone'=> $this->faker->phoneNumber(),
                'bloodـtype'=> $this->faker->randomElement(["O+","O-","A","A+","B+","C+","AB+","AB-"]),
                'gender'=>$this->faker->randomElement([0,1]),
                'nat_num'=>$this->faker->numberBetween(119943443489000,199943443489000),
                'allergies'=>$this->faker->slug,
                'birth_date'=>$this->faker->date("Y-m-d")
        ];
    }
}
