<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatrixRequest extends FormRequest
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
            'alternative_id' => ['required'],
            'criteria_id' => ['required'],
            'value' => ['required', 'numeric', 'min:0'],
 /*            'price' => ['required'],
            'length' => ['required'],
            'type' => ['required'],
            'size' => ['required'],
            'facilities' => ['required'],
            'roomate' => ['required'],
            'kitchen' => ['required'],
            'kitchenette' => ['required'],
            'residence' => ['required'],
            'distance' => ['required'],
            'parking' => ['required'],
            'gym' => ['required'],
            'review' => ['required'],
            'rating' => ['required'],
*/
        ];
    }
}
