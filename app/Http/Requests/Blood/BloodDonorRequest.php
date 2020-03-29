<?php

namespace App\Http\Requests\Blood;

use Illuminate\Foundation\Http\FormRequest;

class BloodDonorRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'required',
            'birth_date' => 'required',
            'blood_group' => 'required',
            'last_donation_date' => 'required'
        ];
    }
}
