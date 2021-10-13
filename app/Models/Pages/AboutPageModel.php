<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'about_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'based',
        'big_img',
        'small_img',
        'title_to_the_left_of_the_img',
        'text_to_the_left_of_the_img',
        'large_text',
        'left_small_text',
        'right_small_text',
        'gallery',
        'creeping_line',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'based',
        'title_to_the_left_of_the_img',
        'text_to_the_left_of_the_img',
        'large_text',
        'left_small_text',
        'right_small_text',
        'creeping_line',
    ];

    public $mediaToUrl = [
        'big_img',
        'small_img',
    ];
}
