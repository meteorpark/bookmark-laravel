<?php

namespace App\Http\Controllers;

use App\Services\CrawlerService;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;
use DomC

class ShareController extends Controller
{
    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }


    public function index()
    {
        $response = $this->client->get("https://www.naver.com");

        $html = $response->getBody()->getContents();


//        echo json_decode($response->getHeaders(), true);
    }
}
