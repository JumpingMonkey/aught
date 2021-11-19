<?php

namespace App\Models\Pages;

use App\Models\OneArticleModel;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'hero_slider_articles', 'article', 'true', 'true' );
        self::getNormalizedField($object, 'display_articles_2_block', 'article', 'true', 'true' );
        self::getNormalizedField($object, 'display_articles_4_block', 'article', 'true', 'true' );


        return $object;
    }

    public static function getArticles ($object, $fieldName) {
        $articleIds = [];
        foreach ($object[$fieldName] as $value){
            $articleIds[] = $value['article'];
        }

        $articles = OneArticleModel::query()->whereIn("id", $articleIds)->get();

        foreach ($articles as $article){
            $content[] = $article->getDataForMain();
        }

        $object[$fieldName] = $content;

        return $object;
    }

    public static function getOneArticle ($object, $fieldName) {

        $article = OneArticleModel::query()->where("id", $object[$fieldName])->firstOrFail();

        $object[$fieldName] = $article->getDataForMain();

        return $object;
    }

    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            $data = self::normalizeData($data);

                $data = self::getArticles($data, 'hero_slider_articles');
                $data = self::getArticles($data, 'display_articles_2_block');
                $data = self::getArticles($data, 'display_articles_4_block');
                $data = self::getOneArticle($data, 'article_for_3_block');


            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }
}
