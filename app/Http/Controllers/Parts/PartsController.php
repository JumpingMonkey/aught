<?php

namespace App\Http\Controllers\Parts;

use App\Http\Controllers\Controller;
use App\Models\Parts\BurgerModel;
use App\Models\Parts\FooterModel;
use App\Models\Parts\HeaderModel;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $header = HeaderModel::firstOrFail()->getFullData();
        $footer = FooterModel::firstOrFail()->getFullData();
        $burger = BurgerModel::firstOrFail()->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'header' => $header,
            'footer' => $footer,
            'burger' => $burger,
        ]);
    }
}
