<?php

namespace App\Http\Controllers;

use App\Models\OneArticleModel;
use App\Models\OneAuthorModel;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthorList()
    {
        $data = OneAuthorModel::query()->select('name', 'id', 'facebook', 'instagram', 'twitter', 'youtube')->get();
        $authorsData = [];
        foreach ($data as $author){
            $authorsData[] = $author->getFullData();
        }
        $content = $authorsData;
        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneAuthor(Request $request)
    {
        $data = OneAuthorModel::query()->where('id', $request->id)->firstOrFail();
        $content = $data->getFullData();

        $articles = OneArticleModel::query()->where('author_id', $content['id'])->select('id')->get();

        $articlesData = [];
        foreach ($articles as $article){
            $articlesData[] = $article->getDataForCategory();
        }



        foreach ($articlesData as $key => $article){
            $art = OneArticleModel::with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                );
            }])->findOrFail($article['id']);


            $content['articles'][$key] = $art->getDataForCategory();
        }

//        foreach ($articles as $article){
//            $article
//        }

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
