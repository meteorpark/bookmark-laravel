<?php

namespace App\Jobs;

use App\Models\Bookmark;
use App\Services\CrawlerService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessBookmark implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bookmark;

    /**
     * Create a new job instance.
     *
     * @param Bookmark $bookmark
     */
    public function __construct(Bookmark $bookmark)
    {
        $this->bookmark = $bookmark;
    }

    /**
     * Execute the job.
     *
     * @param CrawlerService $crawlerService
     * @return void
     */
    public function handle(CrawlerService $crawlerService)
    {
        $bookmark = $this->bookmark;
        $data = $crawlerService->crawler($bookmark->url);

        if(!empty($data['site_name'])){
            $bookmark->site_name = $data['site_name'];
            $bookmark->title = $data['title'];
            $bookmark->image = $data['image'];
            $bookmark->description = $data['description'];
            $bookmark->is_failed = 'N';
            $bookmark->save();

        }else{

            $bookmark->is_failed = 'Y';
            $bookmark->save();
        }

    }
}
