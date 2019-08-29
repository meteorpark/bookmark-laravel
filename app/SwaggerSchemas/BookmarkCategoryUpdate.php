<?php


/**
 * @OA\Schema(required={"name", "_method"}, @OA\Xml(name="BookmarkCategoryUpdate"))
 */
class BookmarkCategoryUpdate
{

    /**
     * @OA\Property()
     * @var string
     */
    public $name;

    /**
     * @OA\Property(enum={"PUT"})
     * @var string
     */
    public $_method;
}
