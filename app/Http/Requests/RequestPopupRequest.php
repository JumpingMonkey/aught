<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPopupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:250',
            'phone' => 'required|string|max:500',
            'email' => 'required|email|max:250',
            'message' => 'required|string|max:2000',
            'file'=> 'sometimes|mimes:pdf,doc,docx,txt|max:50000000',
        ];
    }
}
