<?php

namespace App\Nova\Pages;

use App\Models\Pages\AboutPageModel;
use App\Nova\Resource;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class AboutPageResource extends Resource
{
    use TabsOnEdit;

    public static function label()
    {
        return 'About';
    }

    public static $group = 'Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = AboutPageModel::class;

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

            Textarea::make('Заголовок', 'title'),

            Tabs::make('Блоки', [
                Tab::make('Первый блок', [
                    Text::make('Основано','based'),
                    MediaLibrary::make('Большое фото', 'big_img'),
                    MediaLibrary::make('Маленькое фото', 'small_img'),
                    Text::make('Заголовок слева от фото', 'title_to_the_left_of_the_img'),
                    Textarea::make('Текст слева от фото', 'text_to_the_left_of_the_img'),
                ]),
                Tab::make('Второй блок', [
                    Textarea::make('Крупный шрифт', 'large_text'),
                    Textarea::make('Левый абзац', 'left_small_text'),
                    Textarea::make('Правый абзац', 'right_small_text'),
                ]),
                Tab::make('Галерея', [
                    Flexible::make('Галерея', 'gallery')
                    ->addLayout('Фото', 'img', [
                        MediaLibrary::make('Фото', 'img')
                    ])->button('Добавить фото')

                ]),
                Tab::make('Бегущая строка', [
                    Textarea::make('Бегущая строка', 'creeping_line')
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
