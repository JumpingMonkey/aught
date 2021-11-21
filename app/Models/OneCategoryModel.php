<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        'slug',
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

    public static function normalizeData($object)
    {

//        self::getNormalizedField($object, 'gallery', 'img', 'true', 'true');

        return $object;
    }



    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout([ 'created_at', 'updated_at']);
            $data = self::normalizeData($data);

            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

    public function getDataForCategoriesPage()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['created_at', 'updated_at', 'meta_title', 'meta_description', 'meta_keywords', 'slug', 'category_description']);
            return self::normalizeData($data);

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

}
