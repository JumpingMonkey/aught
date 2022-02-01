<?php

namespace App\Models\Parts;

use App\Models\OneCategoryModel;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class HeaderModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'header_models';

    protected $fillable = [
        'display_category',
    ];

    public $translatable = [
        'display_category',
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
            $data =  self::normalizeData($data);
            return $this->getCategoriesData($data, 'display_category');

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }

    public function getCategoriesData($object, $field) {
        $categoryIds = [];

        foreach ($object[$field] as $category) {
            $categoryIds[] = $category['category'];
        }

        $categoryModels = OneCategoryModel::query()->whereIn('id', $categoryIds)->get();

        $categoriesData = [];
        foreach ($categoryModels as $oneCategoryData){
            $categoriesData[] = $oneCategoryData->getDataForPartsPage();
        }
        $object[$field] = $categoriesData;
        return $object;
    }
}
