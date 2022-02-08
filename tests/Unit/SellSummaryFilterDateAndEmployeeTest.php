<?php

namespace Tests\Unit;

use App\Models\Companie;
use Tests\TestCase;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Sell;
use App\Models\Item;
use App\Models\SellSummary;

class SellSummaryFilterDateAndEmployeeTest extends TestCase
{
    use RefreshDatabase;


    public function testAllowSellSummaryFilterDateAndEmployee()
    {
        Companie::factory()->create();
        Employee::factory()->create();
        Item::factory()->create();
        Sell::factory()->create();
        $sellSummary = SellSummary::factory()->create();

        $sellSummary = $sellSummary->whereBetween('created_at', array('2019-01-23 04:30:42', '2023-02-23 04:30:42'))->where('employee_id',1)
        ->get('');

        $this->assertNotEmpty($sellSummary);
    }


}
