<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
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

    public function testAllowItemIndex()
    {
        $response = $this->get(route('items.index'));
        $response->assertOk();
        $response->assertViewIs('item.index');
    }

    public function testAllowItemCreate()
    {
        $response = $this->get(route('items.create'));
        $response->assertOk();
        $response->assertViewIs('item.create');
    }

    

    public function testAllowItemStore()
    {
        $params = [
            'name' => 'espresso',
            'price' => 20000
        ];

        $response = $this->post(route('items.store', $params));
        $response->assertRedirect(route('items.create'));

        $this->assertDatabaseHas('items', $params);
    }



    public function testAllowItemEdit()
    {
        $item = Item::factory()->create();

        $response = $this->get(route('items.edit', $item->id));
        $response->assertOk();
        $response->assertViewIs('item.edit');
    }

    public function testAllowItemUpdate()
    {
        $item = Item::factory()->create();

        $params = [
            'name' => 'xiomi',
            'price' => '30000'
        ];

        $response = $this->put(route('items.update', $item->id), $params);
        $response->assertRedirect(route('items.edit', $item->id));

        $params['name'] = 'xiomi';

        $this->assertDatabaseHas('items', $params);
    }

    public function testAllowItemDelete()
    {
        $item = Item::factory()->create();

        $response = $this->get(route('items.destroy', $item->id));
        $response->assertRedirect(route('items.index'));

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
