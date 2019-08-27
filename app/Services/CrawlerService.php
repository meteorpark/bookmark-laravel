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

        try {

            $data = $this->parsing();
            return $this->parser($data);

        } catch (Exception $e) {

            return $this->tags;
        }
    }

    /**
     * @return Crawler
     */
    private function parsing(): Crawler
    {
        return $this->client->request("GET", $this->url);
    }

    /**
     * @param Crawler $data
     * @return array
     */
    private function parser(Crawler $data): array
    {

        foreach (array_keys($this->tags) as $tag) {

            try {
                $this->tags[$tag] = $data->filterXpath('//meta[@property="og:' . $tag . '"]')->attr('content');
                $this->tags['is_meta_tag'] = true;

            } catch (Exception $e) {

                if ($tag !== "is_meta_tag") {

                    $this->tags[$tag] = "";
                }
            }
        }

        return $this->tags;
    }
}
