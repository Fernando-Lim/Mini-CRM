<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExcelSeedTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed',['--class' => 'TestExcelSeeder']);
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllowCompanieSeed()
    {
        
        $this->assertDatabaseHas('companies', [
            'name' => 'suryakopi',
        ]);

        
        
    }
    public function testAllowEmployeeSeed()
    {
        
        $this->assertDatabaseHas('employees', [
            'first_name' => 'Fernando',
        ]);

        
        
    }
}
