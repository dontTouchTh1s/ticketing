<?php

namespace App\Http\Requests\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'services_id' => 'required_without::customers_id,groups_id',
            'customers_id' => 'required_without:services_id,groups_id',
            'groups_id' => 'required_without:customers_id, services_id',
            'title' => 'required',
            'body' => 'required',
            'type' => 'required|integer'
        ];
    }
}
