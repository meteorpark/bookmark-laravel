<?php

namespace App\Http\Controllers;

use App\Http\Requests\{storeBookMarkCategoryRequest, updateBookMarkCategoryRequest};
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class BookMarkCategoryController
 * @package App\Http\Controllers
 */
class BookMarkCategoryController extends Controller
{

    /**
     * @var CategoryRepositoryInterface
     */
    private $bookmarkCategory;

    /**
     * BookMarkCategoryController constructor.
     * @param CategoryRepositoryInterface $bookmarkCategory
     */
    public function __construct(CategoryRepositoryInterface $bookmarkCategory)
    {
        $this->middleware('auth:api');
        $this->bookmarkCategory = $bookmarkCategory;
    }


    /**
     * @OA\Post(
     *      path="/api/v1/category",
     *      tags={"Category"},
     *      summary="카테고리 생성",
     *      description="카테고리 생성",
     *      operationId="store",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/BookmarkCategoryCreate"))
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     */

    /**
     * @param storeBookMarkCategoryRequest $request
     * @return JsonResponse
     */
    public function store(storeBookMarkCategoryRequest $request): JsonResponse
    {
        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        $categories = $this->bookmarkCategory->create($data);
        return response()->json($categories, 201);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/category",
     *      tags={"Category"},
     *      summary="카테고리 조회",
     *      description="카테고리 조회",
     *      operationId="show",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * @return mixed
     */
    public function show()
    {
        $categories = $this->bookmarkCategory->all(auth()->user()->id);
        return $categories;
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/category/{category_id}",
     *      tags={"Category"},
     *      summary="카테고리 삭제",
     *      description="카테고리 삭제",
     *      operationId="destroy",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="category_id",
     *          in="path",
     *          description="category_id",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Response(response=204, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * @param string $category_id
     * @return JsonResponse
     */
    public function destroy(string $category_id): JsonResponse
    {
        $this->bookmarkCategory->delete($category_id);
        return response()->json(null, 204);

    }

    /**
     * @OA\Post(
     *      path="/api/v1/category/{category_id}",
     *      tags={"Category"},
     *      summary="카테고리명 수정 ------- 이거는 하지 마세요!!!!!! 작업 중",
     *      description="카테고리명 수정",
     *      operationId="update",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="category_id",
     *          in="path",
     *          description="category_id",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/BookmarkCategoryUpdate"))
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * @param updateBookMarkCategoryRequest $request
     * @param string $category_id
     * @return JsonResponse
     */
    public function update(updateBookMarkCategoryRequest $request, string $category_id): JsonResponse
    {
        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        $categories = $this->bookmarkCategory->update($category_id, $data);
        return response()->json($categories, 200);
    }
}
