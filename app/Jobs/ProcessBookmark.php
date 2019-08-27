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

        if ($data['is_meta_tag']) {
            $bookmark->site_name = $data['site_name'];
            $bookmark->title = $data['title'];
            $bookmark->image = $data['image'];
            $bookmark->description = $data['description'];
            $bookmark->is_failed = 'N';
            $bookmark->save();

        } else {

            $bookmark->is_failed = 'Y';
            $bookmark->save();
        }

        /*
            [program:laravel-worker]
            command=php /var/www/html/bookmark-laravel/artisan queue:work
            process_name=%(program_name)s_%(process_num)02d
            numprocs=8
            priority=999
            autostart=true
            autorestart=true
            startsecs=1
            startretries=3
            user=apache
            redirect_stderr=true
            stdout_logfile=/var/log/worker.log
         */

    }
}
