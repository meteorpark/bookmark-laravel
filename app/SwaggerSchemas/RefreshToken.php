<?php


/**
 * @OA\Schema(required={"name", "token"}, @OA\Xml(name="RefreshToken"))
 */
class RefreshToken
{
    /**
     * @OA\Property()
     * @var string
     */
    public $token;

}
