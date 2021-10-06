<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\PrivacyPolicyModel;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function privacy()
    {
        $data = PrivacyPolicyModel::firstOrFail();

        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
