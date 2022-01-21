<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Controller;
use App\Models\OneAuthorModel;
use App\Models\Parts\FooterModel;
use Illuminate\Http\Request;

class ContactsPageController extends Controller
{
    public function index() {
        $footer = FooterModel::query()
            ->firstOrFail(['contact_email', 'facebook', 'instagram', 'twitter', 'youtube']);
        $footer = $footer->getFullData();

        $data = OneAuthorModel::query()->select('name', 'id', 'facebook', 'instagram', 'twitter', 'youtube')->get();
        $authorsData = [];
        foreach ($data as $author){
            $authorsData[] = $author->getFullData();
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'contacts' => $footer,
                'authors' => $authorsData,
            ],
        ]);

    }
}
