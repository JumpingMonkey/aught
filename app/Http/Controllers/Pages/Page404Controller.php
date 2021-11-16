<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Page404Model;
use Illuminate\Http\Request;

class Page404Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Page404Model::firstOrFail();

        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
