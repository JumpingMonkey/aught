<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class Page404Model extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'page404_models';

    protected $fillable = [
        'title',
        'sub_title',
        'articles',
    ];

    public $translatable = [
        'title',
        'sub_title',
        'articles',
    ];

    public static function normalizeData($object)
    {

//        self::getNormalizedField($object, 'articles', 'img', 'true', 'true');

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
