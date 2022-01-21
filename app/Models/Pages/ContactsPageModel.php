<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class ContactsPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'contacts_page_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_img',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];

    public $mediaToUrl = [
        'og_img',
    ];

    public static function normalizeData($object)
    {
//        self::getNormalizedField($object, 'hero_slider_articles', 'article', 'true', 'true' );
        return $object;
    }

    public function getFullData()
    {
        try {
            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            $data = self::normalizeData($data);

            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }
    }
}
