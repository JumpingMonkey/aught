<?php

namespace App\Nova;

use App\Models\OneArticleModel;
use App\Models\OneAuthorModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class OneArticleResource extends Resource
{
    public static function label(){
        return 'One Article';
    }

//    public static $group = 'Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = OneArticleModel::class;

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
            BelongsToMany::make('OneCategory'),

            Date::make('Дата создания', 'create_date')->nullable(),
            Text::make('Заголовок', 'article_title'),
            Text::make('Слаг', 'slug'),
            Select::make('Автор статьи', 'author_id')->options(
                OneAuthorModel::all()->pluck('name', 'id')
            )->displayUsingLabels(),
            Text::make('Интервьюер', 'interview'),
            Text::make('Видео', 'video_maker'),

            MediaLibrary::make('Фото', 'main_image')->rules('required'),

            Text::make('Подпись к соц сетям', 'social_label'),
            Flexible::make('Соцсети', 'social_network')
            ->addLayout('Соцсеть', 'one_social',[
                Select::make('Соцсеть', 'social')->options([
                    'FB' => 'FB',
                    'SC' => 'SC',
                    'YT' => 'YT',
                    'TW' => 'TW',
                    'IN' => 'IN',
                ]),
                Text::make('Ccылка на соцсеть', 'social_link')
            ])->button('Добавить соцсеть'),

            Flexible::make('Блоки', 'blocks')
                ->addLayout('Соцсеть', 'one_social',[
                    Textarea::make('Многострочное поле ср. шрифт', 'textarea_md_font'),
                    Textarea::make('Многострочное поле мал. шрифт две кол.', 'textarea_sm_font_2_col'),
                    Textarea::make('Многострочное поле мал. шрифт две кол.', 'textarea_sm_font_2_col'),
                    Textarea::make('Цитата бол. шрифт', 'textarea_lg_font_quote'),
                    Text::make('Подмись к цитате', 'quote_label'),
                ])
                ->addLayout('Фото слева + заг. опис.', 'left_img_title_desc', [
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'image'),
                    MediaLibrary::make('Фото', 'img')
                ])
                ->addLayout('Фото справа + заг. опис.', 'right_img_title_desc', [
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'image'),
                    MediaLibrary::make('Фото', 'img')
                ])
                ->addLayout('Фото и цитата ', 'img_quote', [
                    Textarea::make('Цитата', 'quote'),
                    MediaLibrary::make('Фото', 'img'),
                    Text::make('Подпись к фото', 'img_label'),
                ])
                ->addLayout('Галерея + аудио ', 'gallery_and_audio', [
                    MediaLibrary::make('Фото', 'img')->array(),
                    Textarea::make('Текст', 'text'),
                    MediaLibrary::make('Аудио', 'audio'),
                ])
                ->addLayout('Фото + видео ', 'img_and_video', [
                    MediaLibrary::make('Фото', 'img'),
                    MediaLibrary::make('Видео', 'video'),
                ]),
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
