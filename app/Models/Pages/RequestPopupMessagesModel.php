<?php

namespace App\Models\Pages;

use App\Traits\TranslateAndConvertMediaUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RequestPopupMessagesModel extends Model
{

    protected $table = 'request_popup_messages_models';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'file',
    ];

}
