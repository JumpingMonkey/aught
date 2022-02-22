<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class OneAuthorModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'one_author_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'slug',
        'position',
        'photo',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'og_title',
        'og_description',
        'apple_music',
        'spotify',
        'band_camp',
        'web_site',
    ];

    protected $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'position',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'og_title',
        'og_description',
    ];

    public $mediaToUrl = [
        'photo',
        'og_img',
    ];

    public function articles()
    {
        return $this->hasMany(OneArticleModel::class);
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

            $data = $this->getAllWithMediaUrlWithout([ 'created_at', 'updated_at']);
            return self::normalizeData($data);

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }
}
