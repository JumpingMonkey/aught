<?php

namespace App\Nova\Pages;

use App\Models\Pages\PrivacyPolicyModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Whitecube\NovaFlexibleContent\Flexible;

class PrivacyPolicyResource extends Resource
{
    public static function label()
    {
        return 'Privat Policy';
    }

    public static $group = 'Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = PrivacyPolicyModel::class;

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

            Text::make('Meta-title', 'meta_title'),
            Text::make('Meta-description', 'meta_description'),
            Text::make('Meta-keywords', 'meta_keywords'),

            Text::make('Og title', 'og_title')->hideFromIndex(),
            Text::make('Og description', 'og_description')->hideFromIndex(),
            MediaLibrary::make('Og image', 'og_img')->hideFromIndex(),

            Text::make('Title', 'title'),
            Flexible::make('Blocks', 'blocks')
            ->addLayout('One block', 'one_block', [
                Text::make('Block title', 'block_title'),
                Textarea::make('Block description', 'block_description')
            ])->button('add block')
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
