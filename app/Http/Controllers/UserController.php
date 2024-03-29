<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\storeUserCreateRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
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
        $this->middleware('auth:api', ['except' => ['login', 'store']]);
        $this->user = $user;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/auth/signup",
     *      tags={"Auth"},
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
     *      @OA\Response(response=400, description="input error"),
     * )
     *
     *
     * @param storeUserCreateRequest $request
     * @return JsonResponse
     */
    public function store(storeUserCreateRequest $request): JsonResponse
    {
        $data = $request->all();

        $user = $this->user->getSnsId($data['join_type'], $data['sns_id']);

        if (!$user) {

            $data['timezone'] = timezone();
            $user = $this->user->create($data);
        } else {

            $user->name = $data['name'];
            $user->profile_image = !empty($data['profile_image']) ? $data['profile_image'] : "";
            $user->timezone = timezone();
            $user->save();
        }

        $user->setAttribute('token', $this->generateToken($user));

        return response()->json(new UserResource($user), 201);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/auth/login",
     *      tags={"Auth"},
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
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     */
    /**
     * @param loginRequest $request
     * @return JsonResponse
     */
    public function login(loginRequest $request): JsonResponse
    {
        $user = User::where('sns_id', $request->input('sns_id'))->where('join_type', $request->input('join_type'))->first();

        if ($user) {
            if (!$token = auth()->fromUser($user)) {

                return response()->json(['status' => 'unauthorized', 'errors' => new \stdClass()], 401);
            }
        } else {

            return response()->json(['status' => 'unknown user', 'errors' => new \stdClass()], 409);
        }

        $user->setAttribute('token', $this->generateToken($user));

        return response()->json(new UserResource($user));
    }


    /**
     * @param $user
     * @return mixed
     */
    protected function generateToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/token",
     *      tags={"Token"},
     *      summary="토큰 재발행",
     *      description="토큰 재발행",
     *      operationId="refreshToken",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     */
    /**
     * @return JsonResponse
     */
    public function refreshToken()
    {
        $newToken = auth()->refresh();

        return response()->json([
            'token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => (string)auth()->factory()->getTTL() * 60
        ]);
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/auth/unregister",
     *      tags={"Auth"},
     *      summary="유저 삭제",
     *      description="유저 삭제",
     *      operationId="destroy",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=204, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy()
    {
        $this->user->delete();
        return response()->json(null, 204);
    }
}
