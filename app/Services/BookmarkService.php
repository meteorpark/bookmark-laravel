<?php


namespace App\Services;


use App\Models\Bookmark;

/**
 * Class BookmarkService
 * @package App\Services
 */
class BookmarkService implements BookmarkServiceInterface
{

    /**
     * @param array $bookmark_data
     * @return mixed
     */
    public function bookmark(array $bookmark_data)
    {
        return Bookmark::create([
            'user_id' => $bookmark_data['user_id'],
            'category_id' => $bookmark_data['category_id'],
            'url' => $bookmark_data['url'],
        ]);
    }
}
