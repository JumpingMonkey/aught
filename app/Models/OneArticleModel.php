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
        'create_date' => 'date',
//        'main_image' => 'array'
    ];

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'visible',
        'create_date',
        'article_title',
        'article_preview_description',
        'slug',
        'author_id',
        'interview',
        'video_maker',
        'main_image',
        'social_label',
        'social_network',
        'blocks',
        'og_title',
        'og_description',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'article_title',
        'article_preview_description',
//        'author_id',
        'interview',
        'video_maker',
        'social_label',
        'social_network',
        'blocks',
        'og_title',
        'og_description',
    ];

    public $mediaToUrl = [
        'blocks',
        'img',
        'image',
        'video',
        'audio',
        'main_image',
        'og_img',
        'slide',
    ];

    public function oneCategory()
    {
        return $this->belongsToMany(OneCategoryModel::class, 'article_category', 'article_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(OneAuthorModel::class, 'author_id', 'id', 'articles');
    }

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'social_network', 'social', 'true', 'true', false);
        self::getNormalizedField($object, 'blocks', 'quote_label', 'true', 'true', true);

        return $object;
    }

    public static function getAuthor ($object, $fieldName, $getFullData = true) {

        if ($getFullData){
            $author = OneAuthorModel::query()->where("id", $fieldName)->firstOrFail();
        } else {
            $author = OneAuthorModel::query()->select('id', 'name', )->where("id", $fieldName)->firstOrFail();
        }

        $author = $author->getFullData();

        $object['author'] = $author;

        return $object;
    }

    public function getFullData($getAuthorFullData = true)
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['created_at', 'updated_at']);
            $data = self::normalizeData($data);
            if(array_key_exists('author_id', $data)){
                $data = self::getAuthor($data, $data['author_id'], $getAuthorFullData);
            }
            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

    public function getDataForMain()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['created_at', 'updated_at', 'meta_title',
                'meta_description', 'meta_keywords']);
            $data = self::normalizeData($data);
            if(array_key_exists('author_id', $data)){
                $data = self::getAuthor($data, $data['author_id']);
            }
            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

    public function getDataForCategory()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['created_at', 'updated_at', 'meta_title', 'meta_description', 'meta_keywords', 'author_id',
                'interview', 'video_maker', 'social_label', 'social_network', 'blocks', ]);
            $data = self::normalizeData($data);

            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

    public function getDataForBurger()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['created_at', 'updated_at', 'meta_title', 'meta_description', 'meta_keywords', 'author_id',
                'interview', 'video_maker', 'social_label', 'social_network', 'blocks', 'og_title', 'og_description', 'og_img', 'create_date',
                'main_image']);
            $data = self::normalizeData($data);

            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }



}
