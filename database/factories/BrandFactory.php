<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Brand::class;

    public function definition(): array
    {
        $brands = [
            'Audi', 'BMW', 'Mercedes-Benz', 'Volkswagen', 'Porsche', 'Opel',
            'Ford', 'Chevrolet', 'Tesla', 'Dodge', 'Jeep', 'Cadillac',
            'Toyota', 'Honda', 'Nissan', 'Mazda', 'Subaru', 'Lexus',
            'Hyundai', 'Kia',
            'Fiat', 'Alfa Romeo', 'Ferrari', 'Lamborghini', 'Maserati',
            'Volvo', 'Saab',
            'Peugeot', 'Renault', 'Citroën',
            'Skoda', 'SEAT',
            'Suzuki', 'Mitsubishi',
            'Land Rover', 'Jaguar',
        ];

        return [
             'name' => $this->faker->unique()->randomElement($brands)
        ];
    }
}
