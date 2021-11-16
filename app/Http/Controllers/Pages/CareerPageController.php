<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\CareerPageModel;
use Illuminate\Http\Request;

class CareerPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = CareerPageModel::firstOrFail();

        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
