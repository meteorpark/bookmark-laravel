<?php


/**
 * @OA\Schema(required={"sns_id", "join_type"}, @OA\Xml(name="UserCreate"))
 */
class UserLogin
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
}
