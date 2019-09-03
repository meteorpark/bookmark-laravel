<?php


namespace App\Services;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Exception;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class CrawlerService
 * @package App\Services
 */
class CrawlerService
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $url;

    private $tags = [];

    private $crawler_data;

    /**
     * CrawlerService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $guzzleClient = new GuzzleClient([
            'timeout' => 3,
        ]);
        $this->client->setClient($guzzleClient);
        $this->client->setHeader('User-Agent', "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");

        $this->tags = [
            'site_name' => '',
            'title' => '',
            'image' => '',
            'url' => '',
            'description' => '',
            'is_meta_tag' => false,
        ];
    }


    /**
     * @param string $url
     * @param bool $recursion
     * @return array
     */
    public function crawler(string $url, bool $recursion = false): array
    {
        $this->url = $url;
        $this->parsing();
        $this->parser();

        if (!$this->tags['is_meta_tag'] && $recursion === false) { // short url 인경우 한번더 체크

            return $this->crawler($this->tags['url'], true);
        }
        print_r($this->tags);
        exit;
        return $this->tags;
    }

    private function parsing()
    {
        $this->crawler_data = $this->client->request("GET", $this->url);
    }

    /**
     * @param Crawler $data
     * @return array
     */
    private function parser(): array
    {

//        foreach (array_keys($this->tags) as $tag) {
//
//            try {
//                $this->tags[$tag] = $data->filterXpath('//meta[@property="og:' . $tag . '"]')->attr('content');
//                $this->tags['is_meta_tag'] = true;
//
//            } catch (Exception $e) {
//
//                if ($tag !== "is_meta_tag") {
//                    $this->tags[$tag] = "";
//                }
//
//                if ($tag === "site_name") {
//                    $this->tags[$tag] = parse_url($this->url)['host'];
//                }
//            }
//        }

        $this->tags['site_name'] = $this->siteName();
        $this->tags['title'] = $this->title();
        $this->tags['image'] = $this->image();
        $this->tags['url'] = $this->url();
        $this->tags['description'] = $this->description();

        $this->iframe();

        exit;

        return $this->tags;
    }

    private function iframe()
    {
        foreach ($this->crawler_data as $iframe) {

            if($iframe->name === "src"){
                echo $iframe->value."@@@";
            }
        }
    }

    private function siteName(): string
    {
        try {
            $site_name = $this->crawler_data->filterXpath('//meta[@property="og:site_name"]')->attr('content');
            $this->tags['is_meta_tag'] = true;

        } catch (Exception $e) {

            $site_name = parse_url($this->url)['host'];
        }
        return $site_name;
    }

    private function title(): string
    {
        try {
            $title = $this->crawler_data->filterXpath('//meta[@property="og:title"]')->attr('content');
            $this->tags['is_meta_tag'] = true;

        } catch (Exception $e) {

            $title = $this->crawler_data->filterXpath('//title')->text();
        }

        return $title;
    }

    private function image(): string
    {
        try {
            $image = $this->crawler_data->filterXpath('//meta[@property="og:image"]')->attr('content');
            $this->tags['is_meta_tag'] = true;

        } catch (Exception $e) {

            $image = "";
        }
        return $image;
    }

    private function url(): string
    {
        return $this->tags['url'] = $this->crawler_data->getUri();
    }

    private function description(): string
    {
        try {
            $description = $this->crawler_data->filterXpath('//meta[@property="og:description"]')->attr('content');
            $this->tags['is_meta_tag'] = true;

        } catch (Exception $e) {

            $description = "";
        }

        return $description;
    }
}
