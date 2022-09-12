<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reply' => 'required',
            'ticket' => 'required',
            'content' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
