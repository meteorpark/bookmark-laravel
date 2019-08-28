<?php

namespace App\Http\Controllers;

use App\Http\Requests\moveBookmarkRequest;
use App\Http\Requests\storeBookmarkRequest;
use App\Http\Resources\BookmarkCollection;
use App\Jobs\ProcessBookmark;
use App\Services\BookmarkServiceInterface;
use App\Http\Resources\Bookmark as BookmarkResource;

/**
 * Class BookmarkController
 * @package App\Http\Controllers
 */
class BookmarkController extends Controller
{

    /**
     * @var BookmarkServiceInterface
     */
    public $bookmarkService;

    /**
     * BookmarkController constructor.
     * @param BookmarkServiceInterface $bookmarkService
     */
    public function __construct(BookmarkServiceInterface $bookmarkService)
    {
        $this->middleware('auth:api');
        $this->bookmarkService = $bookmarkService;
    }


    /**
     * @OA\Post(
     *      path="/api/v1/bookmarks",
     *      tags={"Bookmark"},
     *      summary="북마크 생성",
     *      description="북마크 생성",
     *      operationId="store",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/BookmarkCreate"))
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="bad request"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     */

    /**
     * @param storeBookmarkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(storeBookmarkRequest $request)
    {

        $data = $request->all();

        $bookmark = $this->bookmarkService->createBookmark($data);

        ProcessBookmark::dispatch($bookmark);

        return response()->json(new BookmarkResource($this->bookmarkService->getBookmark($bookmark->id)), 201);
    }


    /**
     * @OA\Get(
     *      path="/api/v1/bookmarks/{category_id}",
     *      tags={"Bookmark"},
     *      summary="북마크 리스트 가져오기",
     *      description="북마크 리스트 가져오기",
     *      operationId="index",
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
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */

    /**
     * @param string $category_id
     * @return BookmarkCollection
     */
    public function index(string $category_id)
    {
        $bookmarks = $this->bookmarkService->all($category_id);
        return new BookmarkCollection($bookmarks);
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/bookmarks/{category_id}/{bookmark_id}",
     *      tags={"Bookmark"},
     *      summary="북마크 삭제하기",
     *      description="북마크 삭제하기",
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
     *      @OA\Parameter(
     *          name="bookmark_id",
     *          in="path",
     *          description="bookmark_id",
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
     * @param string $bookmark_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $category_id, string $bookmark_id)
    {
        $this->bookmarkService->delete($category_id, $bookmark_id);

        return response()->json(null, 204);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/bookmarks/move",
     *      tags={"Bookmark"},
     *      summary="북마크 이동",
     *      description="북마크 이동",
     *      operationId="move",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/BookmarkMove"))
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * @param moveBookmarkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function move(moveBookmarkRequest $request)
    {

        $this->bookmarkService->move($request->category_id, $request->bookmark_id);

        return response()->json(null, 200);
    }
}
