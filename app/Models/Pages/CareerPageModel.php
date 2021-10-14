<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CareerPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'career_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'description',
        'vacancies',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'description',
        'vacancies',
    ];

    public $mediaToUrl = [
        'img',
    ];
}
