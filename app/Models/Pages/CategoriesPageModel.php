<?php

namespace App\Models\Pages;

use App\Models\OneCategoryModel;
use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Translatable\HasTranslations;

class CategoriesPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'categories_page_models';

    protected $fillable = [
        'sort_title',
        'grid_title',
        'list_title',
        'display_category',
    ];

    public $translatable = [
        'sort_title',
        'grid_title',
        'list_title',
        'display_category',
    ];

    public static function normalizeData($object)
    {

        self::getNormalizedField($object, 'display_category', 'category', 'true', 'true');

        return $object;
    }

    public static function getCategories ($object, $fieldName) {
        $categoryIds = [];
        foreach ($object[$fieldName] as $value){
            $categoryIds[] = $value['category'];
        }

        $categories = OneCategoryModel::query()->whereIn("id", $categoryIds)->get();

        foreach ($categories as $category){
            $content[] = $category->getDataForCategoriesPage();
        }

        $object[$fieldName] = $content;

        return $object;
    }

    public function getFullData()
    {
        try {

            $data = $this->getAllWithMediaUrlWithout(['id', 'created_at', 'updated_at']);
            $data = self::normalizeData($data);
            $data = self::getCategories($data, 'display_category');

            return $data;

        } catch (\Exception $ex) {
            throw new ModelNotFoundException();
        }

    }
}
