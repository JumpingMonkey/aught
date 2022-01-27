<?php

namespace App\Nova;

use App\Models\OneArticleModel;
use App\Models\OneAuthorModel;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Drobee\NovaSluggable\Slug;
use Drobee\NovaSluggable\SluggableText;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
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

            Text::make('Og title', 'og_title')->hideFromIndex(),
            Text::make('Og description', 'og_description')->hideFromIndex(),
            MediaLibrary::make('Og image', 'og_img')->hideFromIndex(),

            BelongsToMany::make('OneCategory'),
            Boolean::make('Отображать на сайте?', 'visible')
                ->trueValue('true')
                ->falseValue('false')->hideFromIndex(),
            Date::make('Дата создания', 'create_date')->nullable()->hideFromIndex(),
            SluggableText::make('Заголовок', 'article_title')->slug('Слаг'),
            Text::make('Описание для превью', 'article_preview_description')->hideFromIndex(),
            Slug::make('Слаг', 'slug')
                ->CreationRules('unique:one_article_models,slug')
                ->hideFromIndex(),
//            Slug::make('Слаг', 'slug')
//                ->from('article_title')
//                ->creationRules('unique:one_article_models,slug')
//                ->hideFromIndex(),
//            BelongsTo::make('Автор', 'author', OneAuthorResource::class),
            Select::make('Автор статьи', 'author_id')->options(
                OneAuthorModel::all()->pluck('name', 'id')
            )->displayUsingLabels()->hideFromIndex(),
            Text::make('Интервьюер', 'interview')->hideFromIndex(),
            Text::make('Видеоограф/фотограф', 'video_maker')->hideFromIndex(),

            MediaLibrary::make('Фото', 'main_image')
//                ->array('list')
                ->rules('required')
                ->hideFromIndex(),

            Flexible::make('Соцсети', 'social_network')->hideFromIndex()
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

            Flexible::make('Блоки', 'blocks')->hideFromIndex()
                ->addLayout('Заголовок', 'title', [
                    Textarea::make('Заголовок', 'title'),
                ])
                ->addLayout('Текст', 'text', [
                    Textarea::make('Текст', 'text'),
                ])
                ->addLayout('Цитата', 'quote', [
                    Textarea::make('Цитата', 'quote'),
                    Text::make('Подпись к цитате', 'quote_label'),
                ])
                ->addLayout('Точка', 'mark_list', [
                    Trix::make('Точка', 'mark_list'),
                ])
                ->addLayout('Фото слева + заг. опис.', 'left_img_title_desc', [
                    Textarea::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'image'),
                    MediaLibrary::make('Фото', 'img')
                ])
                ->addLayout('Фото справа + заг. опис.', 'right_img_title_desc', [
                    Textarea::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'image'),
                    MediaLibrary::make('Фото', 'img')
                ])
                ->addLayout('Фото+цитата ', 'img_quote', [
                    Textarea::make('Цитата', 'quote'),
                    MediaLibrary::make('Фото', 'img'),
                    Text::make('Подпись к фото', 'img_label'),
                ])
                ->addLayout('Цифра', 'number_list', [
                    Trix::make('Цифра', 'number_list'),
                ])
                ->addLayout('Слайдер', 'slider', [
                    MediaLibrary::make('Слайд', 'slide')->array(),
                ])
                ->addLayout('Аудио', 'audio', [
                    MediaLibrary::make('Аудио', 'audio'),
                ])
                ->addLayout('Фото', 'img', [
                    MediaLibrary::make('Фото', 'img'),
                ])
                ->addLayout('Видео ', 'video', [
                    MediaLibrary::make('Видео', 'video'),
                ])->button('Добавить блок'),
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
