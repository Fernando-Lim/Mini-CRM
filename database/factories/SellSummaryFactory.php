<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Sell;
use App\Models\SellSummary;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SellSummaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellSummary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => Carbon::now()->toDateTimeString(),
            'employee_id'=> '1',
            'price_total' => 123456,
            'discount_total'=> 123456,
            'total' => 123456
        ];
    }
}
