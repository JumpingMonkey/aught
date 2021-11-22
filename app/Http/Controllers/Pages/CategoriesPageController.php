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
                'slug',
                'article_title',
                'article_preview_description',
                'main_image'
            )->with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                );
            }]);
        }])->findOrFail($request->id);

        $content = $data->getFullData();


        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'category' => $content,

        ]);
    }
}
