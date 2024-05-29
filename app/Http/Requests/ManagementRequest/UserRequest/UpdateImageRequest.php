<?php

namespace App\Http\Requests\ManagementRequest\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'image' => 'required|file',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'file' => ' Vui lòng thêm đúng định dạng file ảnh'
        ];
    }
}
