<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page404Model extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'page404_models';

    protected $fillable = [
        'title',
        'sub_title',
        'articles',
    ];

    public $translatable = [
        'title',
        'sub_title',
        'articles',
    ];
}
