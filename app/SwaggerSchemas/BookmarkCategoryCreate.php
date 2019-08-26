<?php


/**
 * @OA\Schema(required={"name", "token"}, @OA\Xml(name="BookmarkCategoryCreate"))
 */
class BookmarkCategoryCreate
{
    /**
     * @OA\Property()
     * @var string
     */
    private $token;

    /**
     * @OA\Property()
     * @var string
     */
    private $name;


}
