<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserCreate;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * @OA\Post(
     *      path="/api/v1/users",
     *      tags={"user"},
     *      summary="유저생성",
     *      description="유저를 만들어 봅시다..",
     *      operationId="store",
     *      @OA\Parameter(
     *          name="join_type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"kakao", "google", "facebook"},
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sns_id",
     *          required=true,
     *          in="query",
     *          description="SNS unique id",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="query",
     *          description="Nickname or User's name",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="profile_image",
     *          required=true,
     *          in="path",
     *          description="profile image url",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Response(response=201, description="successful operation"),
     *      @OA\Response(response=400, description="input error"),
     *  )
     * @param storeUserCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(storeUserCreate $request)
    {
        $data = $request->all();
        $user = $this->user->getSnsId($data['sns_id']);
        if (!$user) {

            $user = $this->user->create($data);
        }

        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
