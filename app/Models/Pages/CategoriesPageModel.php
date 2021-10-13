<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CategoriesPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'categories_page_models';

    protected $fillable = [
        'sort_title',
        'grid_title',
        'list_title',
        'display_category',
    ];

    public $translatable = [
        'sort_title',
        'grid_title',
        'list_title',
        'display_category',
    ];
}
