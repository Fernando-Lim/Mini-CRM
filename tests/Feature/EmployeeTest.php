<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Companie;

class EmployeeTest extends TestCase
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

    public function testAllowEmployeeIndex()
    {
        $response = $this->get(route('employees.index'));
        $response->assertOk();
        $response->assertViewIs('employee.index');
    }

    public function testAllowEmployeeCreate()
    {
        $response = $this->get(route('employees.create'));
        $response->assertOk();
        $response->assertViewIs('employee.create');
    }



    public function testAllowEmployeeStore()
    {
        Companie::factory()->create();
        $params = [
            'first_name' => 'izzan',
            'last_name' => 'ka',
            'email' => 'izzan@gmail.com',
            'companie_id' => 1,
            'phone' => 949494949494,
            'password' => bcrypt(123456),
            'created_by_id' => '1',
            'updated_by_id' => '1'
        ];

        $response = $this->post(route('employees.store', $params));
        $response->assertRedirect(route('employees.create'));

        // $this->assertDatabaseHas('employees', $params);
        $this->assertDatabaseHas('employees', [
            'email' => 'izzan@gmail.com'
        ]);
    }



    public function testAllowEmployeeEdit()
    {
        Companie::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->get(route('employees.edit', $employee->id));
        $response->assertOk();
        $response->assertViewIs('employee.edit');
    }

    public function testAllowEmployeeUpdate()
    {

        Companie::factory()->create();
        $employee = Employee::factory()->create();

        $params = [
            'first_name' => 'Updated',
            'last_name' => 'ka',
            'email' => 'izzan@gmail.com',
            'companie_id' => 1,
            'phone' => 949494949494,
            'password' => '654321',
            'created_by_id' => '1',
            'updated_by_id' => '1'
        ];

        $response = $this->put(route('employees.update', $employee->id), $params);
        $response->assertRedirect(route('employees.edit', $employee->id));

        $params['first_name'] = 'Updated';

        $this->assertDatabaseHas('employees', [
            'first_name' => $params
        ]);
    }

    public function testAllowEmployeeDelete()
    {
        Companie::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->get(route('employees.destroy', $employee->id));
        $response->assertRedirect(route('employees.index'));

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
