<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code' => [
                "required",
                "string",
                "min:2",
                "max:255",
                "unique:criterias,code"
            ],
            'name' => [
                "required",
                "string",
                "min:2",
                "max:255",
            ],
            'type' => [
                "required",
                "string",
                "min:2",
                "max:255"
            ]
        ];
    }
}
