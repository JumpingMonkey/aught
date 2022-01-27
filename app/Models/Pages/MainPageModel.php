<?php

namespace App\Models\Pages;

use App\Models\OneArticleModel;
use App\Models\Parts\FooterModel;
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
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_img',
        'logo',
        'hero_slider_articles',
        'hero_btn_title',
        'display_articles_2_block',
        'article_for_3_block',
        'display_articles_4_block',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'hero_slider_articles',
        'hero_btn_title',
        'display_articles_2_block',
        'article_for_3_block',
        'display_articles_4_block',
    ];

    public $mediaToUrl = [
        'logo',
        'og_img',
    ];

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'hero_slider_articles', 'article', 'true', 'true' );
        self::getNormalizedField($object, 'display_articles_2_block', 'article', 'true', 'true' );
        self::getNormalizedField($object, 'display_articles_4_block', 'article', 'true', 'true' );


        return $object;
    }

    public static function getArticles ($object, $fieldName) {

        if (!array_key_exists($fieldName, $object)) {
            return $object;
        }

        $articleIds = [];
        foreach ($object[$fieldName] as $value){
            $articleIds[] = $value['article'];
        }

        $articles = OneArticleModel::query()->select(
            'article_title',
            'main_image',
            'article_preview_description',
            'create_date',
            'id',
            'author_id',
        )->with(['oneCategory' => function($query) {
            $query->select(
                'one_category_models.id',
                'category_title',
            );
        }])->whereIn("id", $articleIds, '', '',)->get();

        foreach ($articleIds as $id){
            $content[] = $articles->where('id', $id)->firstOrFail()->getDataForMain();
        }
//        foreach ($articles as $article){
//
//            $content[] = $article->getDataForMain();
//        }

        $object[$fieldName] = $content;

        return $object;
    }

    public static function getOneArticle ($object, $fieldName) {

        if (!array_key_exists($fieldName, $object)) {
            return $object;
        }

        $article = OneArticleModel::query()
            ->select(
                'article_title',
                'main_image',
                'article_preview_description',
                'create_date',
                'id'
            )->with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                );
            }])
            ->where("id", $object[$fieldName])->firstOrFail();

        $object[$fieldName] = $article->getDataForMain();

        return $object;
    }

    public static function getSocialLinks($object){
        $footer = FooterModel::query()
            ->firstOrFail(['facebook', 'instagram', 'twitter', 'youtube']);
        $footer = $footer->getFullData();
        $object['social'] = $footer;
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
                $data = self::getSocialLinks($data);


            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }
}
