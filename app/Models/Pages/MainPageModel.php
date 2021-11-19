<?php

namespace App\Models\Pages;

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
