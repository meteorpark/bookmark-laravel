<?php

namespace Tests\Unit;

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
    public function websiteParsing()
    {

        $crawler = new \App\Services\CrawlerService();

        $url = "http://www.zdnet.co.kr/view/?no=20190821142500";

        \Log::info($crawler->websiteParsing($url));
    }
}
