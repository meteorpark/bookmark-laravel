<?php


/**
 * @OA\Schema(required={"name"}, @OA\Xml(name="BookmarkCategoryCreate"))
 */
class BookmarkCategoryCreate
{

    /**
     * @OA\Property()
     * @var string
     */
    public $name;

}
