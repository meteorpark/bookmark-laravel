<?php


/**
 * @OA\Schema(required={"category_id", "url"}, @OA\Xml(name="BookmarkCreate"))
 */
class BookmarkCreate
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
    public $url;


}
