<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Sell;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'=> 2022-02-02,
            'item_id'=> '1',
            'price' => 20000,
            'discount' => 10,
            'employee_id' => '1'
        ];
    }
}
