<?php


/**
 * @OA\Schema(required={"name"}, @OA\Xml(name="BookmarkCategoryUpdate"))
 */
class BookmarkCategoryUpdate
{

    /**
     * @OA\Property()
     * @var string
     */
    public $name;

    /**
     * @OA\Property()
     * @var string
     */
    public $_method;
}
