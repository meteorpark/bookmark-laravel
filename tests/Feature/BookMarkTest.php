<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookMarkTest extends TestCase
{

    /**
     * @test
     */
    public function can_bookmark_and_queue()
    {
        $request = [
            'user_id' => 1,
            'category_id' => 1,
            'url' => 'https://www.youtube.com/watch?v=vJ4i8AJBBGM',
        ];

        // When
        $response = $this->json('POST', '/api/v1/bookmark', $request);

        // Then
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
