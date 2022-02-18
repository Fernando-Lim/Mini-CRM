<?php

namespace Tests\Feature;

use App\Models\Companie;
use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class AppTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    public $user;


    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/{company}/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = Employee::factory()->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');
    }

    public function test_user_cannot_login_with_default_company()
    {
        $user = Employee::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('companyerror');
    }


    public function test_user_can_login_with_correct_credentials()
    {
        $this->user = Employee::factory()->create();
        $this->actingAs($this->user);
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_user_after_login_can_access_employee_view()
    {

        $this->user = Employee::factory()->create();
        $this->actingAs($this->user);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get(route('employees.index'));
        $response->assertOk();
        $response->assertViewIs('home');
    }

    public function test_user_can_logout()
    {

        $this->user = Employee::factory()->create();
        $this->actingAs($this->user);
        $this->assertAuthenticatedAs($this->user);
        $this->post('/logout');
        $response = $this->get('/{company}/login');
        $response->assertViewIs('auth.login');
    }
}
