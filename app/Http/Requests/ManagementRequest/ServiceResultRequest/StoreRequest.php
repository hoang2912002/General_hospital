<?php

namespace App\Http\Requests\ManagementRequest\ServiceResultRequest;

use App\Rules\Phone_number;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            '*.medical_record_id' => 'required',
            '*.shift_id' => 'required',
            '*.day_id' => 'required',
            '*.arr.*.service_id_arr.*' => 'required',
            '*.arr.*.description.*' => 'required',
            '*.arr.*.image.*' => 'required',
            '*.arr.*.price.*' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
        ];
    }

}
