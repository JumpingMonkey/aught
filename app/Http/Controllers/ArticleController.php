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
        if ($request->slug != null) {
            $data = OneArticleModel::query()
                ->with(['oneCategory'])
                ->where('slug', $request->slug)->firstOrFail();
            $content = $data->getFullData();
        } else {
            $data = OneArticleModel::query()
                ->with(['oneCategory'])
                ->where('id', $request->id)->firstOrFail();
            $content = $data->getFullData();
        }

        if (isset($content['oneCategory'])){
            $categoryIds = [];
            foreach ($content['oneCategory'] as $category){
                $categoryIds[] = $category['id'];
            }

            $randomData = OneArticleModel::query()->select('id', 'article_title', 'create_date',
                'author_id', 'main_image', 'slug', 'article_preview_description')
                ->whereHas('oneCategory', function ($q) use($categoryIds){
                    $q->whereIn('one_category_models.id', $categoryIds);
                })
                ->with(['oneCategory' => function($q) use ($categoryIds){
                    $q->select(
                        'one_category_models.id',
                        'category_title',
                        'slug',
                    );
                }])
                ->limit(5)
                ->where('id', '!=', $content['id'])
                ->get();

            $random = [];
            foreach ($randomData as $article){
                $random[] = $article->getFullData(false);
            }
        }
        $content['random'] = $random ?? 'у статьи нет категорий!';
        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content,
//            'random' => $random ?? 'у статьи нет категорий!',
        ])->setEncodingOptions('ass');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticleList(Request $request)
    {
        $data = OneArticleModel::query()->select('id', 'article_title', 'create_date', 'author_id', 'main_image', 'slug', 'article_preview_description')
            ->with(['oneCategory' => function($q){
                $q->select(
                    'one_category_models.id',
                    'category_title',
                    'slug',
                );
            }])
            ->get();
        $content = [];
        foreach ($data as $article){
            $content[] = $article->getFullData(false);
        }

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
    public function getArticleListSearchResponse(Request $request)
    {
        $data = OneArticleModel::query()->select('id', 'slug', 'article_title', 'main_image', 'create_date', 'author_id', 'article_preview_description')
            ->where('article_title', 'LIKE',  "%$request->search%")
            ->with(['oneCategory' => function($q){
                $q->select(
                    'one_category_models.id',
                    'category_title',
                    'slug',
                );
            }])
            ->get();

        $content = [];
        foreach ($data as $article){
            $content[] = $article->getFullData(false);
        }

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
