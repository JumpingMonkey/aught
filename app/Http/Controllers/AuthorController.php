<?php

namespace App\Http\Controllers;

use App\Models\OneAuthorModel;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneAuthor(Request $request)
    {
        $data = OneAuthorModel::query()->where('id', $request->id)->firstOrFail();
        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
