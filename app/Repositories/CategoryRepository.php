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
     * @param array $bookCategory_data
     * @return mixed
     */
    public function create(array $bookCategory_data)
    {
        $rank = $this->bookmarkCategoryIncrement($bookCategory_data['user_id']);

        BookmarkCategory::create([
            'user_id' => $bookCategory_data['user_id'],
            'name' => $bookCategory_data['name'],
            'rank' => $rank,
        ]);

        return $this->all($bookCategory_data['user_id']);
    }


    /**
     * @param string $user_id
     * @return mixed
     */
    public function all(string $user_id)
    {
        return BookmarkCategory::where('user_id', $user_id)->get();
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
        // TODO: Implement update() method.
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
