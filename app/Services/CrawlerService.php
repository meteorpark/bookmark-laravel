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
     * @var
     */
    private $org_url;

    /**
     * @var array
     */
    private $tags = [];
    /**
     * @var
     */
    private $crawler_data;

    /**
     * @var array
     */
    private $iframe_src = [];
    /**
     * @var bool
     */
    private $iframe_stat = false;

    /**
     * CrawlerService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $guzzleClient = new GuzzleClient([
            'timeout' => 3,
            'verify' => getcwd().'/cacert-2019-08-28.pem',
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
     * @param string|null $redirect_url
     * @return array
     */
    public function crawler(string $url, string $redirect_url = null): array
    {
        $this->org_url = $url;
        $this->url = $redirect_url ?: $url; // 네이버블로그 같은 경우 iframe으로 탐색해야 하는데, 원본 url을 유지하여 돌려주기 위함.

        if ($this->parsing()) {
            $this->parser();
            if (!$this->hasTagsValue() && $this->hasIframeSrc() > 0 && $this->iframe_stat === false) {

                $this->iFrameSearch();
            }
        }
        return $this->tags;
    }

    /**
     * @return bool
     */
    private function hasTagsValue()
    {
        return $this->tags['title'] && $this->tags['image'];
    }

    /**
     * @return bool
     */
    private function parsing(): bool
    {

        try {
            $this->crawler_data = $this->client->request("GET", $this->url);
            return $this->client->getResponse()->getStatus() === 200;
        } catch (Exception $e) {
            return 0;
        }
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
     * @return int
     */
    private function hasIframeSrc(): int
    {
        $this->iframe_src = $this->crawler_data->filter('iframe')->each(function ($item) {
            return $item->attr('src');
        });
        $this->iframe_src = array_values(array_filter($this->iframe_src));

        return count($this->iframe_src);
    }

    /**
     *
     */
    private function iFrameSearch()
    {
        for ($i = 0; $i < count($this->iframe_src); $i++) {
            $this->iframe_stat = true;
            $this->crawler($this->org_url, $this->iframe_src[$i]);

            if ($this->tags['is_meta_tag']) break;
        }
        $this->iframe_stat = false;
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

            try {

                $title = $this->crawler_data->filterXpath('//title')->text();

                $this->tags['is_meta_tag'] = true;
            } catch (Exception $e) {
                $title = "";
                $this->tags['is_meta_tag'] = false;
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
        return $this->tags['url'] = $this->org_url;
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
