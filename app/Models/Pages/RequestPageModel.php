<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RequestPageModel extends Model
{
    use HasFactory, HasTranslations, TranslateAndConvertMediaUrl;

    protected $table = 'request_page_models';

    protected $fillable = [
        'title',
        'description',
        'name_field_title',
        'phone_field_title',
        'email_field_title',
        'massage_field_title',
        'file_field_title',
        'file_field_description',
        'btn_title',
    ];

    public $translatable = [
        'title',
        'description',
        'name_field_title',
        'phone_field_title',
        'email_field_title',
        'massage_field_title',
        'file_field_title',
        'file_field_description',
        'btn_title',
    ];
}
