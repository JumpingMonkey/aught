<?php

namespace App\Models\Parts;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeaderModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'header_models';

    protected $fillable = [
        'display_category',
    ];

    public $translatable = [
        'display_category',
    ];

}
