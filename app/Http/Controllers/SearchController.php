<?php

namespace App\Http\Controllers;

use App\Http\Requests\indexSearchRequest;
use App\Http\Resources\BookmarkCollection;
use App\Models\Bookmark;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *      path="/api/v1/search",
     *      tags={"Search"},
     *      summary="검색",
     *      description="검색",
     *      operationId="index",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="query",
     *          in="query",
     *          description="검색어",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="bad request"),
     *      @OA\Response(response=401, description="unauthorized token"),
     * )
     */
    /**
     * @param indexSearchRequest $request
     * @return BookmarkCollection
     */
    public function index(indexSearchRequest $request)
    {

        $query = $request->input('query');

        $searchBookmarks = Bookmark::where('user_id', auth()->user()->id)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            })->orderBy('created_at', 'DESC')->paginate();

        return new BookmarkCollection($searchBookmarks);
    }
}
