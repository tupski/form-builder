<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\AdminUserSeeder::class);
    }

    public function test_user_can_create_form(): void
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)->post('/forms', [
            'title' => 'Test Form',
            'description' => 'This is a test form',
            'success_message' => 'Thank you for your submission!'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('forms', [
            'title' => 'Test Form',
            'user_id' => $user->id
        ]);
    }

    public function test_user_can_view_their_forms(): void
    {
        $user = User::where('role', 'user')->first();
        $form = Form::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/forms');

        $response->assertStatus(200);
        $response->assertSee($form->title);
    }

    public function test_user_cannot_view_other_users_forms(): void
    {
        $user1 = User::where('role', 'user')->first();
        $user2 = User::factory()->create(['role' => 'user']);
        $form = Form::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get("/forms/{$form->id}");

        $response->assertStatus(403);
    }

    public function test_admin_can_view_all_forms(): void
    {
        $admin = User::where('role', 'admin')->first();
        $user = User::where('role', 'user')->first();
        $form = Form::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($admin)->get('/admin/forms');

        $response->assertStatus(200);
        $response->assertSee($form->title);
    }

    public function test_public_can_view_active_form(): void
    {
        $form = Form::factory()->create(['is_active' => true]);

        $response = $this->get("/form/{$form->slug}");

        $response->assertStatus(200);
        $response->assertSee($form->title);
    }

    public function test_public_cannot_view_inactive_form(): void
    {
        $form = Form::factory()->create(['is_active' => false]);

        $response = $this->get("/form/{$form->slug}");

        $response->assertStatus(404);
    }

    public function test_form_submission_works(): void
    {
        $form = Form::factory()->create(['is_active' => true]);
        $field = FormField::factory()->create([
            'form_id' => $form->id,
            'type' => 'text',
            'name' => 'test_field',
            'required' => true
        ]);

        $response = $this->post("/form/{$form->slug}", [
            'test_field' => 'Test Value'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('form_submissions', [
            'form_id' => $form->id
        ]);
    }
}
