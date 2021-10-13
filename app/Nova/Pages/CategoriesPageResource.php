<?php

namespace App\Nova\Pages;

use App\Models\Pages\CategoriesPageModel;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Whitecube\NovaFlexibleContent\Flexible;

class CategoriesPageResource extends Resource
{
    public static function label(){
        return 'Categories';
    }

    public static $group = 'Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = CategoriesPageModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Multilingual::make('Language'),

            Text::make('Текст поля сортировки', 'sort_title'),
            Text::make('Текст отображения сеткой', 'grid_title'),
            Text::make('Текст отображения писком', 'list_title'),
            Flexible::make('Отображаемые категории', 'display_category')
                ->addLayout('Категория', 'category', [
                    Select::make('Выберите категорию', 'category')->options([
                        'Test' => 'test',

                    ])
            ])
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
