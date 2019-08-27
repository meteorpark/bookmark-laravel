<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookMarkCategoryRequest;
use App\Repositories\BookmarkCategoryRepositoryInterface;

/**
 * Class BookMarkCategoryController
 * @package App\Http\Controllers
 */
class BookMarkCategoryController extends Controller
{

    /**
     * @var BookmarkCategoryRepositoryInterface
     */
    private $bookmarkCategory;

    /**
     * BookMarkCategoryController constructor.
     * @param BookmarkCategoryRepositoryInterface $bookmarkCategory
     */
    public function __construct(BookmarkCategoryRepositoryInterface $bookmarkCategory)
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
     *      @OA\Response(response=201, description="successful operation"),
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
        return $categories;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/category",
     *      tags={"Category"},
     *      summary="카테고리 조회",
     *      description="카테고리 조회",
     *      operationId="show",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=201, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
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


//    public function destroy(int $id)
//    {
//
//    }
//    public function update(updateBookMarkCategoryRequest $request)
//    {
//
//    }
}
