<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoutesAcceptance()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/search');
        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(404);
    }
}
