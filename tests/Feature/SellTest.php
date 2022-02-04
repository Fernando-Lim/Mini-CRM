<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Sell;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class SellTest extends TestCase
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

    public function testAllowSellIndex()
    {
        $response = $this->get(route('sells.index'));
        $response->assertOk();
        $response->assertViewIs('sell.index');
    }

    public function testAllowSellCreate()
    {
        $response = $this->get(route('sells.create'));
        $response->assertOk();
        $response->assertViewIs('sell.create');
    }

    

    public function testAllowSellStore()
    {
        Employee::factory()->create();
        Item::factory()->create();
        $params = [
            'date'=> Carbon::now()->toDateTimeString(),
            'item_id'=> '1',
            'price' => 20000,
            'discount' => 10,
            'employee_id' => '1'
        ];

        $response = $this->post(route('sells.store', $params));
        $response->assertRedirect(route('sells.create'));

        $this->assertDatabaseHas('sells', $params);
    }



    public function testAllowSellEdit()
    {
        Employee::factory()->create();
        Item::factory()->create();
        $sell = Sell::factory()->create();

        $response = $this->get(route('sells.edit', $sell->id));
        $response->assertOk();
        $response->assertViewIs('sell.edit');
    }

    public function testAllowSellUpdate()
    {
        Employee::factory()->create();
        Item::factory()->create();
        $sell = Sell::factory()->create();

        $params = [
            'date'=> Carbon::now()->toDateTimeString(),
            'item_id'=> '1',
            'price' => 20000,
            'discount' => 10,
            'employee_id' => '1'
        ];

        $response = $this->put(route('sells.update', $sell->id), $params);
        $response->assertRedirect(route('sells.edit', $sell->id));

        $params['item_id'] = '1';

        $this->assertDatabaseHas('sells', $params);
    }

    public function testAllowSellDelete()
    {
        Employee::factory()->create();
        Item::factory()->create();
        $sell = Sell::factory()->create();

        $response = $this->get(route('sells.destroy', $sell->id));
        $response->assertRedirect(route('sells.index'));

        $this->assertDatabaseMissing('sells', ['id' => $sell->id]);
    }
}
