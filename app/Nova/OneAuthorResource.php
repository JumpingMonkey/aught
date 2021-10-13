<?php

namespace App\Nova;

use App\Models\OneAuthorModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class OneAuthorResource extends Resource
{
//    public static $group = '';

    public static function label() {
        return 'One Author';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = OneAuthorModel::class;

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

            Text::make('Meta-title', 'meta_title')->hideFromIndex(),
            Text::make('Meta-description', 'meta_description')->hideFromIndex(),
            Text::make('Meta-keywords', 'meta_keywords')->hideFromIndex(),

            Text::make('Имя', 'name'),
            Text::make('Слаг', 'slug'),
            MediaLibrary::make('Фото', 'photo'),
            Textarea::make('Описание', 'description'),
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
