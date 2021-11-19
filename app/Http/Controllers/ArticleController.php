<?php

namespace App\Http\Controllers;

use App\Models\OneArticleModel;
use App\Models\OneAuthorModel;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneArticle(Request $request)
    {
        $data = OneArticleModel::query()->where('id', $request->id)->firstOrFail();
        $content = $data->getFullData();

//        $author = OneAuthorModel::query()->where('id', $content['author_id'])->firstOrFail();
//        $authorContent = $author->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
