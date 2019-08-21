<?php


namespace App\Services;

use GuzzleHttp\Client as HttpClient;


class CrawlerService
{

    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
    }



    public function websiteParsing(string $url)
    {
        $response = $this->httpClient->get($url);

        return json_decode($response->getBody(), true);
    }
}
