<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OneArticleModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'one_article_models';

    protected $casts = [
        'create_date' => 'date'
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'visible',
        'create_date',
        'article_title',
        'slug',
        'author_id',
        'interview',
        'video_maker',
        'main_image',
        'social_label',
        'social_network',
        'blocks',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'article_title',
//        'author_id',
        'interview',
        'video_maker',
        'social_label',
        'social_network',
        'blocks',
    ];

    public function oneCategory()
    {
        return $this->belongsToMany(OneCategoryModel::class, 'article_category', 'article_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(OneAuthorModel::class);
    }

}
