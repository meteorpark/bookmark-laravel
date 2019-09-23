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

    /**
     * @var array
     */
    private $tags = [];
    /**
     * @var
     */
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
     * @return array
     */
    public function crawler(string $url): array
    {
        $this->url = $url;
        if ($this->parsing()) {
            $this->parser();
        }
        dd($this->tags);
        return $this->tags;
    }


    /**
     * @return bool
     */
    private function parsing(): bool
    {
        $this->crawler_data = $this->client->request("GET", $this->url);
        return $this->client->getResponse()->getStatus() === 200;
    }

    /**
     * @return array
     */
    private function parser(): array
    {
        $this->tags['site_name'] = $this->siteName();
        $this->tags['title'] = $this->title();
        $this->tags['image'] = $this->image();
        $this->tags['url'] = $this->url();
        $this->tags['description'] = $this->description();
        return $this->tags;
    }

    /**
     * @return string
     */
    private function siteName(): string
    {
        try {
            $site_name = $this->crawler_data->filterXpath('//meta[@property="og:site_name"]')->attr('content');
            $this->tags['is_meta_tag'] = true;
        } catch (Exception $e) {
            $site_name = parse_url($this->crawler_data->getUri())['host'];
        }
        return $site_name;
    }

    /**
     * @return string
     */
    private function title(): string
    {
        try {
            $title = $this->crawler_data->filterXpath('//meta[@property="og:title"]')->attr('content');
            $this->tags['is_meta_tag'] = true;
        } catch (Exception $e) {
            $title = $this->crawler_data->filterXpath('//title')->text();

            if (!empty($title)) {
                $this->tags['is_meta_tag'] = true;
            }
        }

        return $title;
    }

    /**
     * @return string
     */
    private function image(): string
    {
        try {
            $image = $this->crawler_data->filterXpath('//meta[@property="og:image"]')->attr('content');
        } catch (Exception $e) {
            $image = "";
        }
        return $image;
    }

    /**
     * @return string
     */
    private function url(): string
    {
        return $this->tags['url'] = $this->crawler_data->getUri();
    }

    /**
     * @return string
     */
    private function description(): string
    {
        try {
            $description = $this->crawler_data->filterXpath('//meta[@property="og:description"]')->attr('content');
        } catch (Exception $e) {
            $description = "";
        }
        return $description;
    }
}
