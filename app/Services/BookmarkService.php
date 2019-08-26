<?php


namespace App\Services;


use App\Exceptions\MeteoException;
use App\Models\Bookmark;
use App\Models\BookmarkCategory;

/**
 * Class BookmarkService
 * @package App\Services
 */
class BookmarkService implements BookmarkServiceInterface
{


    /**
     * @param array $bookmark_data
     * @return mixed
     * @throws MeteoException
     */
    public function bookmark(array $bookmark_data)
    {
        $this->hasCategory($bookmark_data['category_id'], $bookmark_data['user_id']);

        return Bookmark::create([
            'user_id' => $bookmark_data['user_id'],
            'category_id' => $bookmark_data['category_id'],
            'url' => $bookmark_data['url'],
        ]);
    }

    /**
     * @param int $category_id
     * @param int $user_id
     * @throws MeteoException
     */
    private function hasCategory(int $category_id, int $user_id)
    {
        $bookCategory = BookmarkCategory::where('id', $category_id)->where('user_id', $user_id)->first();

        if (!$bookCategory) {

            throw new MeteoException("존재하지 않는 카테고리 입니다.");
        }
    }
}
