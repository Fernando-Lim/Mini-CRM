<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployeeTokenTest extends TestCase
{
    use RefreshDatabase;

    const AUTH_PASSWORD = 'password';

    public function setUp() : void
    {
        parent::setUp();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function getTokenForUser(User $user) : string
    {
        return JWTAuth::fromUser($user);
    }


    public function user() : User
    {
        return User::create([
            'name' => ('admin'),
            'email' => ('admin@admin.com'),
            'password' => ('password'),
        ]);

    }

    public function testAllowGetEmployeePermission()
    {
        $token = $this->getTokenForUser($this->user());


        $this->postJson(route('loadEmployeesTestPermissions'), [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure(['employee']);
    }
    public function testAllowGetEmployeeFromCompanyId()
    {
        $token = $this->getTokenForUser($this->user());


        $this->postJson(route('loadEmployeesTest'), [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure(['employee']);
    }


}
