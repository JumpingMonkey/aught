<?php

namespace App\Nova\Pages;

use App\Models\OneArticleModel;
use App\Models\Pages\MainPageModel;
use App\Nova\Resource;
use ClassicO\NovaMediaLibrary\MediaLibrary;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class MainPageResource extends Resource
{
    public static function label(){
        return 'Main';
    }

    public static $group = 'Pages';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = MainPageModel::class;

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

            MediaLibrary::make('Логотип', 'logo'),
            Flexible::make('Отображаемые в слайдере статьи', 'hero_slider_articles')
                ->addLayout('Статья', 'article', [
                    Select::make('Выберите статью', 'article')->searchable()->options(
                        OneArticleModel::all()->pluck('article_title', 'id'),
                    )->displayUsingLabels()
                ])->button('Добавить статью'),

            Text::make('Кнопка', 'hero_btn_title'),

            Flexible::make('Отображаемые статьи 2 блок', 'display_articles_2_block')
                ->addLayout('Статья', 'article', [
                    Select::make('Выберите статью', 'article')->searchable()->options(
                        OneArticleModel::all()->pluck('article_title', 'id'),
                    )->displayUsingLabels()
                ])->button('Добавить статью'),

            Select::make('Статья в третьем блоке', 'article_for_3_block')->searchable()->options(
                OneArticleModel::all()->pluck('article_title', 'id'),
            )->displayUsingLabels(),
            Flexible::make('Отображаемые статьи 4 блок', 'display_articles_4_block')
                ->addLayout('Статья', 'article', [
                    Select::make('Выберите статью', 'article')->searchable()->options(
                        OneArticleModel::all()->pluck('article_title', 'id'),
                    )->displayUsingLabels()
                ])->button('Добавить статью'),

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
