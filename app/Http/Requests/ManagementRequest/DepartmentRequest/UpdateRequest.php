<?php

namespace App\Http\Requests\ManagementRequest\DepartmentRequest;

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
        $id = request()->route()->departmentModel->id;
        return [
            'name' => 'required|unique:departments,name,' . $id,
            'slug' => 'sometimes',
            'activated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng không bỏ trống thông tin!',
            'unique' => 'Khoa này này đã được thêm!',
            'sometimes' => 'Khoa này không đúng kiểu dữ liệu!'
        ];
    }
    public function prepareForValidation(){
        $this->merge(['slug' => Str::slug($this->name)]);
    }
}
