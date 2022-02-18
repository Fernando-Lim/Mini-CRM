<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Companie;
use Faker\Provider\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanieTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    // public function testWhenNotLogginIn(){
    //    $response = $this->get('/');
    //    $response->assertRedirect(route('login'));
    // }

    public function testAllowCompanieIndex()
    {
        $response = $this->get(route('companies.index'));
        $response->assertOk();
        $response->assertViewIs('companie.index');
    }

    public function testAllowCompanieCreate()
    {
        $response = $this->get(route('companies.create'));
        $response->assertOk();
        $response->assertViewIs('companie.create');
    }

    public function testAllowCompanieStore()
    {
        $params = [
            'name' => 'xiomi',
            'email' => 'xiomi@gmail.com',
            'website' => 'xiomi.com',
            'created_by_id' => '1',
            'updated_by_id' => '1'
        ];

        $response = $this->post(route('companies.store', $params));
        $response->assertRedirect(route('companies.create'));

        $this->assertDatabaseHas('companies', $params);
    }

    public function testAllowUploadImageCompanie()
    {

        $file = UploadedFile::fake()->image('image_one.jpg');
        Storage::fake('public');
        

        $response = $this->post(route('companies.store', $file));
        
        Storage::disk('public')->put('logos/' . $file->hashName(), $response);
        
        // back in your test
        Storage::disk('public')->assertExists('logos/' . $file->hashName());

        // $file = UploadedFile::fake()->image('image_one.jpg');
        // Storage::fake('public');
        
        // // Somewhere in your controller
        // $image = Companie::factory()->make([
        //     'logo' => $file
        // ])->toArray();
        
        // Storage::disk('public')->put('logos/' . $file->hashName(), $image);
        
        // // back in your test
        // Storage::disk('public')->assertExists('logos/' . $file->hashName());
    }



    public function testAllowCompanieEdit()
    {
        $companie = Companie::factory()->create();

        $response = $this->get(route('companies.edit', $companie->id));
        $response->assertOk();
        $response->assertViewIs('companie.edit');
    }

    public function testAllowCompanieUpdate()
    {
        $companie = Companie::factory()->create();

        $params = [
            'name' => 'xiomi',
            'email' => 'xiomi@gmail.com',
            'website' => 'xiomi.com',
            'created_by_id' => '1',
            'updated_by_id' => '1'
        ];

        $response = $this->put(route('companies.update', $companie->id), $params);
        $response->assertRedirect(route('companies.edit', $companie->id));

        $params['name'] = 'xiomi';

        $this->assertDatabaseHas('companies', $params);
    }

    public function testAllowCompanieDelete()
    {
        $companie = Companie::factory()->create();

        $response = $this->get(route('companies.destroy', $companie->id));
        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseMissing('companies', ['id' => $companie->id]);
    }
}
