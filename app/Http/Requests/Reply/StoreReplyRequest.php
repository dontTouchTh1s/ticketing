<?php

namespace App\Http\Requests\Reply;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required',
            'ticket' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
