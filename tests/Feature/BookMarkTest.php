<?php

namespace Tests\Feature;

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
            'category_id' => 1,
            'url' => 'https://www.youtube.com/watch?v=vJ4i8AJBBGM',
        ];

        // When
        $response = $this->json('POST', '/api/v1/bookmarks', $request, $this->login());

        // Then
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function select_category_in_bookmarks()
    {
        $path_category_id = 1;

        $response = $this->json('GET', '/api/v1/bookmarks/category/'.$path_category_id, [], $this->login());

        // Then
        $response->assertStatus(200);
    }
}
