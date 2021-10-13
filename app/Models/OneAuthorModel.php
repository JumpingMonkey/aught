<?php

namespace App\Models;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OneAuthorModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'one_author_models';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'slug',
        'photo',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    protected $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'photo',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    public function articles()
    {
        return $this->hasMany(OneArticleModel::class);
    }
}
