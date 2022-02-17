<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Controller;
use App\Models\OneAuthorModel;
use App\Models\Pages\ContactsPageModel;
use App\Models\Parts\FooterModel;
use Illuminate\Http\Request;

class ContactsPageController extends Controller
{
    public function index() {

        $footer = FooterModel::query()
            ->firstOrFail(['contact_email', 'facebook', 'instagram', 'twitter', 'youtube', 'soundcloud']);
        $footer = $footer->getFullData(false);

        $data = OneAuthorModel::query()
            ->select('name', 'slug', 'id', 'facebook', 'instagram', 'twitter', 'youtube', 'position')
            ->limit(2)
            ->get();
        $authorsData = [];
        foreach ($data as $author){
            $authorsData[] = $author->getFullData();
        }

        $data = ContactsPageModel::query()->firstOrFail();
        $data = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => [
                'data' => $data,
                'contacts' => $footer,
                'authors' => $authorsData,
            ],
        ]);

    }
}
