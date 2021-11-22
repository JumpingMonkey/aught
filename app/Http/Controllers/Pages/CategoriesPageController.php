<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\OneArticleModel;
use App\Models\OneCategoryModel;
use App\Models\Pages\CategoriesPageModel;
use Illuminate\Http\Request;

class CategoriesPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        $data = CategoriesPageModel::firstOrFail();

        $content = $data->getFullData();

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
    public function getOneCategory(Request $request)
    {
        $data = OneCategoryModel::with(['articles' => function($query) {
            $query->select(
                'one_article_models.id',
                'visible',
                'create_date',
                'article_title',
                'article_preview_description',
                'main_image'
            );
        }])->findOrFail($request->id);



//        dd($data->articles);
//        $data = OneCategoryModel::query()->where('id', $request->id)->firstOrFail();

//        $articleIds = $data->articles->pluck('id');
//
//
//        $articles = OneArticleModel::query()->whereIn('id', $articleIds)
//            ->select(
//                'id',
//                'visible',
//                'create_date',
//                'article_title',
//                'article_preview_description',
//                'main_image'
//            )->get();

//        foreach ($articles as $article){
//            $artData[] = $article->getFullData();
//        }


//            ->with(['oneCategory' => function($query) {
//            $query->select(
//                'one_category_models.id',
//                'category_title',
//            );
//        }])->findOrFail($articleIds);

//        $artData = [];
//        foreach ($articles as $article){
//            $artData[] = $article->getFullData();
//        }

//dd($artData);
//        $articles = $articles->getFullData();

//        $articles[0]->oneCategory->pluck('category_title');

//        $categoriesData = [];

//        foreach ($articles as $key => $article){
//
//            $oneArticleCategories = [];
//            foreach ($article->oneCategory->pluck('id') as $item){
//                $oneArticleCategories[] = OneCategoryModel::query()->where('id', $item)->select('id', 'category_title')->firstOrFail();
//            }
//            $articles[$key]['categories'] = $oneArticleCategories;
//        }
//
//        dd($articles);
//        $content = $data->getFullData();

        $content = $data->getFullData();

        foreach ($content['articles'] as $key => $article){
            $art = OneArticleModel::with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                );
            }])->findOrFail($article['id']);


            $content['articles'][$key] = $art->getDataForCategory();
        }

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'category' => $content,

        ]);
    }
}
