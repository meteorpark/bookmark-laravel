<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserCreate;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

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
//        $this->middleware('api', ['except' => ['login']]);
        $this->user = $user;
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
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/UserCreate"))
     *      ),
     *      @OA\Response(response=201, description="successful operation"),
     *      @OA\Response(response=401, description="input error"),
     * )
     *
     *
     * @param storeUserCreate $request
     * @return JsonResponse
     */
    public function store(storeUserCreate $request): JsonResponse
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
     * @OA\Post(
     *      path="/api/v1/users/login",
     *      tags={"User"},
     *      summary="로그인",
     *      description="로그인",
     *      operationId="login",
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/UserLogin"))
     *      ),
     *      @OA\Response(response=201, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     *
     * @param storeUserCreate $request
     * @return JsonResponse
     */
    /**
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('sns_id', $request->sns_id)->first();

        if ($user) {
            if (!$token = auth()->fromUser($user)) {

                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {

            return response()->json(['error' => 'Unknown user'], 409);
        }

        $user->setAttribute('token', $this->respondWithToken($token));
        return response()->json(new UserResource($user), 200);
    }

    /**
     * @param string $token
     * @return string
     */
    protected function respondWithToken(string $token): string
    {
        auth()->factory()->getTTL() * 60;
        return $token;
    }


    /**
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
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
