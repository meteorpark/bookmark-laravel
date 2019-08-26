<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create(string $model, array $attributes = [], $resource = true)
    {
        $resourceModel = factory("App\\Models\\$model")->create($attributes);
        $resourceClass = "App\\Http\\Resources\\$model";

        if (!$resource) return $resourceModel;

        return new $resourceClass($resourceModel);
    }


    public function login(int $user_id = 11)
    {
        $headers = [];
        $user = $user = User::find($user_id);
        $token = auth()->guard('api')->login($user);
        $headers['Authorization'] = 'Bearer ' . $token;

        return $headers;
    }
}
