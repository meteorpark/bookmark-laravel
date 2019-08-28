<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookMarkCategoryRequest;
use App\Http\Requests\updateBookMarkCategoryRequest;
use App\Repositories\CategoryRepositoryInterface;

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
     * @return mixed
     */
    public function store(storeBookMarkCategoryRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $category_id)
    {
        $this->bookmarkCategory->delete($category_id);
        return response()->json(null, 204);

    }

    /**
     * @OA\Put(
     *      path="/api/v1/users/login",
     *      tags={"User"},
     *      summary="카테고리명 수정",
     *      description="카테고리명 수정",
     *      operationId="update",
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
     * @param updateBookMarkCategoryRequest $request
     * @param string $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(updateBookMarkCategoryRequest $request, string $category_id)
    {
        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        $categories = $this->bookmarkCategory->update($category_id, $data);
        return response()->json($categories, 201);
    }
}
