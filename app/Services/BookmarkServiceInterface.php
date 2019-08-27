<?php


namespace App\Services;


/**
 * Interface BookmarkServiceInterface
 * @package App\Services
 */
interface BookmarkServiceInterface
{
    /**
     * @param array $bookmark_data
     * @return mixed
     */
    public function createBookmark(array $bookmark_data);

    /**
     * @param string $category_id
     * @return mixed
     */
    public function all(string $category_id);

    /**
     * @param string $category_id
     * @param string $bookmark_id
     * @return mixed
     */
    public function delete(string $category_id, string $bookmark_id);

}
