<?php

namespace App\Http\Requests\ManagementRequest\CategoryRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class UpdateRequest extends FormRequest
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
        $id = request()->route()->categoryModel->id;
        return [
            'name' => 'required|unique:medicines_type,name,' . $id,
            'slug' => 'sometimes',
            'activated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng không bỏ trống thông tin!',
            'unique' => 'Danh mục thuốc này đã được thêm!',
            'sometimes' => 'Danh mục thuốc không đúng kiểu dữ liệu!'
        ];
    }
    public function prepareForValidation(){
        $this->merge(['slug' => Str::slug($this->name)]);
    }
}
