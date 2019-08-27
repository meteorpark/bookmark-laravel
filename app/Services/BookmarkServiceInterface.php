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
     * @param int $category_id
     * @return mixed
     */
    public function all(int $category_id);

}
