<?php

namespace Tests\Unit;


use Tests\TestCase;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageDatabaseTest extends TestCase
{
    use RefreshDatabase;
    protected function createLanguageLine(string $group, string $key, array $text): LanguageLine
    {
        return LanguageLine::create(compact('group', 'key', 'text'));
    }
    /**
     * A basic test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed',['--class' => 'TestLanguageDatabaseSeeder']);
    }

    public function testAllowTranslationSeed()
    {
        $this->assertDatabaseHas('language_lines', [
            'group' => 'companie',
        ]);    
    }


    public function testAllowGetTranslation()
    {
        $languageLine = $this->createLanguageLine('group', 'new', ['en' => 'english', 'nl' => 'nederlands']);

        $this->assertEquals('english', $languageLine->getTranslation('en'));
        $this->assertEquals('nederlands', $languageLine->getTranslation('nl'));
    }

    public function testAllowSetTranslation()
    {
        $languageLine = $this->createLanguageLine('group', 'new', ['en' => 'english']);

        $languageLine->setTranslation('nl', 'nederlands');

        $this->assertEquals('english', $languageLine->getTranslation('en'));
        $this->assertEquals('nederlands', $languageLine->getTranslation('nl'));
    }
    public function testAllowGetFallbackLocale()
    {
        $languageLine = $this->createLanguageLine('group', 'new', ['en' => 'English']);
        $this->assertEquals('English', $languageLine->getTranslation('es'));
    }
}
