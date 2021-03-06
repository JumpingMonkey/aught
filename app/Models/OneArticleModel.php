<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public $mediaToUrl = [
        'blocks',
        'img',
        'image',
        'video',
        'audio',

    ];

    public function oneCategory()
    {
        return $this->belongsToMany(OneCategoryModel::class, 'article_category', 'article_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(OneAuthorModel::class);
    }

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'social_network', 'social', 'true', 'true', false);
        self::getNormalizedField($object, 'blocks', 'quote_label', 'true', 'true', true);

        return $object;
    }



    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

}
