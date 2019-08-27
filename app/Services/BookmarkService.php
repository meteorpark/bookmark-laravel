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

    /**
     * @param array $bookmark_data
     * @return mixed
     * @throws MeteoException
     */
    public function createBookmark(array $bookmark_data)
    {
        $user_id = auth()->user()->id;
        $this->hasCategory($bookmark_data['category_id'], $user_id);

        return Bookmark::create([
            'user_id' => $user_id,
            'category_id' => $bookmark_data['category_id'],
            'url' => $bookmark_data['url'],
        ]);
    }

    /**
     * @param string $category_id
     * @return mixed
     */
    public function all(string $category_id)
    {
        return BookmarkCategory::find($category_id)->bookmarks()->paginate();
    }

    /**
     * @param string $category_id
     * @param string $bookmark_id
     * @return mixed
     */
    public function destroy(string $category_id, string $bookmark_id)
    {
        Bookmark::where('category_id', $category_id)->where('id', $bookmark_id)->where('user_id', auth()->user()->id)->delete();
    }
}
