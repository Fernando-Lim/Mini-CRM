<?php

namespace Tests\Unit;


use Tests\TestCase;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Companie;

class CompanieFilterDateTest extends TestCase
{
    use RefreshDatabase;

    public function testAllowCompaniesFilterDate()
    {
        $companie = Companie::factory()->create();

        $companie = $companie->whereBetween('created_at', array('2019-01-23 04:30:42', '2023-01-23 04:30:42'))->get('');

        $this->assertNotEmpty($companie);
    }


}
