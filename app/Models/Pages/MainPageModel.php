<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MainPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'main_page_models';

    protected $fillable = [
        'logo',
        'hero_slider_articles',
        'hero_btn_title',
        'display_articles_2_block',
        'article_for_3_block',
        'display_articles_4_block',
    ];

    public $translatable = [
        'hero_slider_articles',
        'hero_btn_title',
        'display_articles_2_block',
        'article_for_3_block',
        'display_articles_4_block',
    ];

    public $mediaToUrl = [
        'logo',
    ];
}
