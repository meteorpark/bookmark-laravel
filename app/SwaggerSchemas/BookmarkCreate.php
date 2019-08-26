<?php


/**
 * @OA\Schema(required={"category_id", "token", "url"}, @OA\Xml(name="BookmarkCreate"))
 */
class BookmarkCreate
{
    /**
     * @OA\Property()
     * @var string
     */
    public $token;

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
