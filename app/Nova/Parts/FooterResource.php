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
                ])->button('Добавить категорию')->rules('required'),
            MediaLibrary::make('Логотип', 'logo')->rules('required'),
            Text::make('Название email поля', 'email_field_title')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Подпись под email полем', 'email_field_description')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Контактный email', 'contact_email')
                ->rules('required'),
            Text::make('Facebook сылка', 'facebook')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('instagram сылка', 'instagram')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Twitter сылка', 'twitter')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Youtube сылка', 'youtube')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Soundcloud сылка', 'soundcloud')
                ->rules('required')
                ->hideFromIndex(),
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
