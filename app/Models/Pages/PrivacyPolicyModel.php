<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class PrivacyPolicyModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'privacy_policy_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'blocks',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'blocks',
    ];

    public static function normalizeData($object)
    {
        self::getNormalizedField($object, 'blocks', 'block_title', 'true', 'true');

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
