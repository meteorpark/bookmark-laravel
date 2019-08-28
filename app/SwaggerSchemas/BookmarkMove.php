<?php


/**
 * @OA\Schema(required={"category_id", "bookmark_id"}, @OA\Xml(name="BookmarkMove"))
 */
class BookmarkMove
{
    /**
     * @OA\Property()
     * @var string
     */
    public $category_id;

    /**
     * @OA\Property()
     * @var string
     */
    public $bookmark_id;


}
