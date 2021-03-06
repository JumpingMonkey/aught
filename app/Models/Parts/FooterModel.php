<?php

namespace App\Models\Parts;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class FooterModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'footer_models';

    protected $fillable = [
        'display_category',
        'logo',
        'email_field_title',
        'email_field_description',
        'contact_email',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    public $translatable = [
        'display_category',
        'email_field_title',
        'email_field_description',
    ];

    public $mediaToUrl = [
        'logo',
    ];

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'display_category', 'category', 'true', 'true');

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
