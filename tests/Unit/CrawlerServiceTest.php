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
        $url = "http://www.zdnet.co.kr/view/?no=20190822082224";
        $data = $crawler->crawler($url);
        dd($data);
        $this->assertIsArray($data);
    }
}
