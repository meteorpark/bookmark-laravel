<?php


namespace App\Repositories;


use App\Models\BookmarkCategory;

/**
 * Class BookmarkCategoryRepository
 * @package App\Repositories
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param array $category_data
     * @return mixed
     */
    public function create(array $category_data)
    {
        $rank = $this->bookmarkCategoryIncrement($category_data['user_id']);

        BookmarkCategory::create([
            'user_id' => $category_data['user_id'],
            'name' => $category_data['name'],
            'rank' => $rank,
        ]);

        return $this->all($category_data['user_id']);
    }


    /**
     * @param string $user_id
     * @return mixed
     */
    public function all(string $user_id)
    {
        $defaultBookCategory = BookmarkCategory::where('user_id', $user_id)->where('rank', 1)->get();
        $otherBookCategory = BookmarkCategory::where('user_id', $user_id)->where('rank', '!=', 1)->orderBy('name', 'ASC')->get();

        return $defaultBookCategory->merge($otherBookCategory);
    }

    /**
     * @param string $category_id
     * @return mixed|void
     */
    public function delete(string $category_id)
    {
        return BookmarkCategory::where('id', $category_id)->where('user_id', auth()->user()->id)->delete();
    }

    /**
     * @param string $category_id
     * @param array $category_data
     * @return mixed|void
     */
    public function update(string $category_id, array $category_data)
    {
        $bookmarkCategory = BookmarkCategory::where('id', $category_id)->where('user_id', $category_data['user_id'])->first();
        if ($bookmarkCategory) {
            $bookmarkCategory->name = $category_data['name'];
            $bookmarkCategory->save();
        }
    }

    /**
     * @param string $user_id
     * @return int
     */
    public function bookmarkCategoryIncrement(string $user_id): int
    {
        return BookmarkCategory::where('user_id', $user_id)->count() + 1;
    }
}
