<?php


namespace App\Repositories;


/**
 * Interface BookmarkCategoryInterface
 * @package App\Repositories
 */
interface BookmarkCategoryRepositoryInterface
{

    /**
     * @param array $bookCategory_data
     * @return mixed
     */
    public function create(array $bookCategory_data);


    /**
     * @param int $user_id
     * @return mixed
     */
    public function all(int $user_id);

    /**
     * @param int $bookCategory_id
     * @return mixed
     */
    public function delete(int $bookCategory_id);

    /**
     * @param int $bookCategory_id
     * @param array $bookCategory_data
     * @return mixed
     */
    public function update(int $bookCategory_id, array $bookCategory_data);

    /**
     * @param int $user_id
     * @return mixed
     */
    public function bookmarkCategoryIncrement(int $user_id);
}
