<?php

namespace App\Nova\Parts;

use App\Models\OneCategoryModel;
use App\Models\Parts\FooterModel;
use App\Nova\Resource;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class FooterResource extends Resource
{
    public static function label(){
        return 'Footer';
    }

    public static $group = 'Parts';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = FooterModel::class;

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

            Flexible::make('Отображаемые категории', 'display_category')
                ->addLayout('Категория', 'category', [
                    Select::make('Выберите категорию', 'category')->options(
                        OneCategoryModel::all()->pluck('category_title', 'id'),
                    )
                ])->button('Добавить категорию'),
            MediaLibrary::make('Логотип', 'logo'),
            Text::make('Название email поля', 'email_field_title'),
            Text::make('Подпись под email полем', 'email_field_description'),
            Text::make('Контактный email', 'contact_email'),
            Text::make('Facebook сылка', 'facebook'),
            Text::make('instagram сылка', 'instagram'),
            Text::make('Twitter сылка', 'twitter'),
            Text::make('Youtube сылка', 'youtube'),
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
