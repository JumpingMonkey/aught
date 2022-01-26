<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\OneAuthorModel;
use App\Models\Pages\AboutPageModel;
use App\Models\Pages\PrivacyPolicyModel;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = AboutPageModel::firstOrFail();
        $content = $data->getFullData();

        $authors = OneAuthorModel::query()
            ->select('name', 'id', 'facebook', 'instagram', 'twitter', 'youtube', 'photo', 'position', 'description')
            ->limit(2)
            ->get();
        $authorsData = [];
        foreach ($authors as $author){
            $authorsData[] = $author->getFullData();
        }

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content,
            'author' => $authorsData,
        ]);
    }

}
