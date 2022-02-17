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

//If the object is not include field
        if (!array_key_exists($fieldName, $object)) {
            $articles = OneArticleModel::query()->select(
                'article_title',
                'main_image',
                'article_preview_description',
                'article_description',
                'create_date',
                'video_maker',
                'video_maker_link',
                'id',
                'author_id',
                'slug',
            )->with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                    'slug',
                );
            }])->limit(6)
                ->orderByDesc('id')
                ->get();

            if ($articles->count() == 0) {
                $object[$fieldName] = 'Articles not found!';
                return $object;
            };

            switch ($fieldName){
                case 'hero_slider_articles':
                    $articles = array_slice($articles->all(), 0, 3);
                    foreach ($articles as $article){
                        $content[] = $article->getDataForMain();
                    }
                    $object[$fieldName] = $content;
                    break;
                case 'display_articles_2_block':
                case 'display_articles_4_block':
                    foreach ($articles as $article){
                        $content[] = $article->getDataForMain();
                    }
                    $object[$fieldName] = $content;
                    break;
            }
            return $object;
        }
// end block "If the object is not include field"


        $articleIds = [];
        foreach ($object[$fieldName] as $value){
            $articleIds[] = $value['article'];
        }

        $articles = OneArticleModel::query()->select(
            'article_title',
            'main_image',
            'article_description',
            'article_preview_description',
            'create_date',
            'id',
            'video_maker',
            'video_maker_link',
            'author_id',
            'slug',
        )->with(['oneCategory' => function($query) {
            $query->select(
                'one_category_models.id',
                'category_title',
                'slug'
            );
        }])->whereIn("id", $articleIds)->get();

        if ($articles !== null){
            foreach ($articleIds as $id){
                $res = $articles->where('id', $id)->first();
                if ($res !== null) {
                    $content[] = $res->getDataForMain();
                }
            }
        } else {
            $content[] = 'Articles not found!';
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
            $article = OneArticleModel::query()->select(
                'article_title',
                'main_image',
                'article_description',
                'article_preview_description',
                'create_date',
                'id',
                'video_maker',
                'video_maker_link',
                'author_id',
                'slug',
            )->with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                    'slug'
                );
            }])->orderByDesc('id')
                ->first();

            if ($article == null) {
                $object[$fieldName] = 'Articles not found!';
                return $object;
            } else {
                $object[$fieldName] = $article->getDataForMain();
            }
            return $object;
        }

        $article = OneArticleModel::query()
            ->select(
                'article_title',
                'article_description',
                'main_image',
                'article_preview_description',
                'video_maker',
                'video_maker_link',
                'create_date',
                'id',
                'slug',
            )->with(['oneCategory' => function($query) {
                $query->select(
                    'one_category_models.id',
                    'category_title',
                    'slug',
                );
            }])
            ->where("id", $object[$fieldName])->first();

        if ($article !== null) {
            $object[$fieldName] = $article->getDataForMain();
        } else {
            $defaultArticle = OneArticleModel::query()
                ->select(
                    'article_title',
                    'article_description',
                    'main_image',
                    'article_preview_description',
                    'video_maker',
                    'video_maker_link',
                    'create_date',
                    'id',
                    'slug',
                )->with(['oneCategory' => function($query) {
                    $query->select(
                        'one_category_models.id',
                        'category_title',
                        'slug',
                    );
                }])->first();
            if ($defaultArticle !== null) {
                $object[$fieldName] = $defaultArticle->getDataForMain();
            } else {
                $object[$fieldName] = "Article not found!";
            }
        }
        return $object;
    }

    public static function getSocialLinks($object){
        $footer = FooterModel::query()
            ->firstOrFail(['facebook', 'instagram', 'twitter', 'youtube', 'soundcloud']);
        $footer = $footer->getFullData(false);
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
