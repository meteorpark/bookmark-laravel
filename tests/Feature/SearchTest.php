<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    /**
     * @test
     */
    public function can_select_bookmarks()
    {
        $query = "배워";

        $response = $this->json('GET', '/api/v1/search?query=' . $query, [], $this->login());
//        dd($response);
        // Then
        $response->assertStatus(200);
    }
}
