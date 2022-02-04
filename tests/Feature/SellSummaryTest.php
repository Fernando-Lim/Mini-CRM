<?php

namespace Tests\Feature;

use App\Models\Companie;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Sell;
use App\Models\Employee;
use App\Models\SellSummary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class SellSummaryTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    //    public function testWhenNotLogginIn(){
    //        $response = $this->get('/');
    //        $response->assertRedirect(route('login'));
    //    }

    public function testAllowSellSummaryIndex()
    {
        $response = $this->get(route('sellSummaries.index'));
        $response->assertOk();
        $response->assertViewIs('sellSummary.index');
    }    

    public function testAllowSellSummaryStore()
    {
        Employee::factory()->create();
        Item::factory()->create();
        SellSummary::factory()->create();

        $params['employee_id'] = '1';
        $this->assertDatabaseHas('sell_summaries', $params);
    }



    public function testAllowSellSummaryShow()
    {
        Companie::factory()->create();
        Employee::factory()->create();
        Item::factory()->create();
        $sellSummary = SellSummary::factory()->create();

        $response = $this->get(route('sellSummaries.edit', $sellSummary->id));
        $response->assertOk();
        $response->assertViewIs('sellSummary.show');
    }

}
