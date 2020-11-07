<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'address' => 'required|string',
            'phone' => 'required|string|min:9',
            'pickupdate' => 'required|date|after:today',
            'deliverydate' => "required|date|after:deliverdate",
        ];
    }
    public function messages()
    {
        return [
            'deliverydate.after' => 'The Delivery date is to be taken must be at least 3 days',
            'phone.min' => 'The phone number at least 9 characters'
        ];
    }
}
