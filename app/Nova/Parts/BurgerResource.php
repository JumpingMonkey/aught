<?php

namespace App\Nova\Parts;

use App\Models\OneArticleModel;
use App\Models\OneCategoryModel;
use App\Models\Parts\BurgerModel;
use App\Nova\Resource;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class BurgerResource extends Resource
{
    public static function label(){
        return 'Burger';
    }

    public static $group = 'Parts';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = BurgerModel::class;

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

            Text::make('Предложить новость', 'offer_news'),

            Flexible::make('Отображаемые категории', 'display_category')
                ->addLayout('Категория', 'category', [
                    Select::make('Выберите категорию', 'category')->options(
                        OneCategoryModel::all()->pluck('category_title', 'id'),
                    )->displayUsingLabels()
                ])->button('Добавить категорию'),

            Flexible::make('Отображаемые статьи', 'display_article')
                ->addLayout('Статья', 'article', [
                    Select::make('Выберите категорию', 'article')->options(
                        OneArticleModel::all()->pluck('article_title', 'id'),
                    )->displayUsingLabels()
                ])->button('Добавить категорию'),
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
