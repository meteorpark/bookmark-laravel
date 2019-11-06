<?php


/**
 * @OA\Schema(required={"join_type", "sns_id", "name"}, @OA\Xml(name="UserCreate"))
 */
class UserCreate
{

    /**
     * @OA\Property(enum={"kakao", "facebook", "google", "apple"})
     * @var string
     */
    public $join_type;
    /**
     * @OA\Property()
     * @var string
     */
    public $sns_id;
    /**
     * @OA\Property()
     * @var string
     */
    public $name;

}
