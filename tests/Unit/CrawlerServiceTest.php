<?php

namespace Tests\Unit;

use App\Services\CrawlerService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrawlerServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function crawler_with_url()
    {
        $crawler = new CrawlerService();
        $url = "https://www.raywenderlich.com/5359-firebase-tutorial-real-time-chat";
        $data = $crawler->crawler($url);
        $this->assertIsArray($data);
    }
}
