<?php

namespace App\Http\Requests\ManagementRequest\GroupRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
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
    public function rules(): array
    {
        return [
            'name' => 'required|unique:groups,name',
            'slug' => 'sometimes',
            'activated' => 'required'
        ];

    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'sometimes' => 'Trường này không đúng kiểu dữ liệu!',
        ];
    }

    public function passedValidation()
    {
        $this->merge(['slug' => Str::slug($this->name)]);
    }
}
