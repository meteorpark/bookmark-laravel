<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserCreate;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;

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
     *      tags={"User"},
     *      summary="회원가입",
     *      description="회원가입",
     *      operationId="store",
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data", @OA\Schema(ref="#/components/schemas/User"))
     *      ),
     *      @OA\Response(response=201, description="successful operation"),
     *      @OA\Response(response=401, description="input error"),
     * )
     *
     *
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

        $user->setAttribute('token', JWTAuth::fromUser($user));

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
