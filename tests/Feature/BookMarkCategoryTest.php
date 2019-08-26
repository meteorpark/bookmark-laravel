<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookMarkCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function can_create_bookmark_category()
    {

        $faker = Factory::create();

        $request = [
            'name' => $faker->name,
        ];

        $headers = [];
        $user = $user = User::find(11);

        $token = auth()->guard('api')->login($user);
        $headers['Authorization'] = 'Bearer ' . $token;
        // When
        $response = $this->json('POST', '/api/v1/bookmarks/category', $request, $headers);


        $response->assertStatus(200);
    }
}
