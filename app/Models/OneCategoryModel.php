<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OneCategoryModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'one_category_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_title',
        'category_description',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_title',
        'category_description',
    ];

    public function articles()
    {
        return $this->belongsToMany(OneArticleModel::class, 'article_category', 'category_id', 'article_id');
    }

}
