<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


/**
 * Class UserTest
 * @package Tests\Feature
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

//  ./vendor/bin/phpunit --filter create_user


    /**
     * @test
     */
    public function a_user_can_create_return()
    {
        // Given
        $faker = Factory::create();
        $sns = [
            'kakao',
            'facebook',
            'google',
        ];
        $request = [
            'join_type' => $join_type = $sns[rand(0, count($sns))],
            'sns_id' => $sns_id = Str::random(10),
            'name' => $name = $faker->name,
            'profile_image' => $profile_image = $faker->imageUrl(),
        ];

        // When
        $response = $this->json('POST', '/api/v1/users', $request);

        // Then
        $response->assertJsonStructure([ // 응답이 주어진 JOSN 구조를 가지고 있는지 확인
            'join_type',
            'name',
            'profile_image',
            'created_at',
        ])->assertJson([ // 응답에 주어진 JSON 데이터가 포함되어 있는지 확인:
            'join_type' => $join_type,
            'name' => $name,
            'profile_image' => $profile_image,
        ])->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'join_type' => $join_type,
            'sns_id' => $sns_id,
            'name' => $name,
            'profile_image' => $profile_image,
        ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
