<?php


namespace App\Repositories;


/**
 * Interface BookmarkCategoryInterface
 * @package App\Repositories
 */
interface CategoryRepositoryInterface
{

    /**
     * @param array $category_data
     * @return mixed
     */
    public function create(array $category_data);


    /**
     * @param string $user_id
     * @return mixed
     */
    public function all(string $user_id);

    /**
     * @param string $category_id
     * @return mixed
     */
    public function delete(string $category_id);

    /**
     * @param string $category_id
     * @param array $category_data
     * @return mixed
     */
    public function update(string $category_id, array $category_data);

    /**
     * @param string $user_id
     * @return mixed
     */
    public function bookmarkCategoryIncrement(string $user_id);
}
