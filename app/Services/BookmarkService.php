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
        return BookmarkCategory::find($category_id)->bookmarks()->orderBy('id', 'DESC')->paginate();
    }

    /**
     * @param string $category_id
     * @param string $bookmark_id
     * @return mixed
     */
    public function delete(string $category_id, string $bookmark_id)
    {
        Bookmark::where('category_id', $category_id)->where('id', $bookmark_id)->where('user_id', auth()->user()->id)->delete();
    }

    /**
     * @param string $bookmark_id
     * @return mixed
     */
    public function getBookmark(string $bookmark_id)
    {
        return Bookmark::find($bookmark_id);
    }

    /**
     * @param string $category_id
     * @param string $bookmark_id
     * @return mixed
     */
    public function move(string $category_id, string $bookmark_id)
    {
        $bookmark = Bookmark::where('id', $bookmark_id)->where('user_id', auth()->user()->id)->first();
        $category = BookmarkCategory::where('id', $category_id)->where('user_id', auth()->user()->id)->first();

        if ($bookmark && $category) {
            $bookmark->category_id = $category_id;
            $bookmark->save();
        }
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return Bookmark::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate();
    }
}
