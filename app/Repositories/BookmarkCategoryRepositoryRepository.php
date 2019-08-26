<?php


namespace App\Repositories;


use App\Models\BookmarkCategory;

/**
 * Class BookmarkCategoryRepository
 * @package App\Repositories
 */
class BookmarkCategoryRepositoryRepository implements BookmarkCategoryRepositoryInterface
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
     * @param int $user_id
     * @return mixed
     */
    public function all(int $user_id)
    {
        return BookmarkCategory::where('user_id', $user_id)->paginate();
    }

    /**
     * @param int $bookCategory_id
     * @return mixed|void
     */
    public function delete(int $bookCategory_id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param int $bookCategory_id
     * @param array $bookCategory_data
     * @return mixed|void
     */
    public function update(int $bookCategory_id, array $bookCategory_data)
    {
        // TODO: Implement update() method.
    }


    /**
     * @param int $user_id
     * @return int
     */
    public function bookmarkCategoryIncrement(int $user_id): int
    {
        return BookmarkCategory::find($user_id)->count() + 1;
    }
}
