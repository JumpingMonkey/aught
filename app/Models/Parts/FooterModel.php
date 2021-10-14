<?php

namespace App\Models\Parts;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'footer_models';

    protected $fillable = [
        'display_category',
        'logo',
        'email_field_title',
        'email_field_description',
        'contact_email',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    public $translatable = [
        'display_category',
        'email_field_title',
        'email_field_description',
    ];

    public $mediaToUrl = [
        'logo',
    ];
}
