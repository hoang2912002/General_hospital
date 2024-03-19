<?php

namespace App\Http\Requests\ManagementRequest\ShiftRequest;

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
        $id = request()->route()->shiftModel->id;
        return [
            'name' => 'required|unique:shifts,name,' . $id,
            'slug' => 'sometimes',
            'activated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng không bỏ trống thông tin!',
            'unique' => 'Ca trực này đã được thêm!',
            'sometimes' => 'Ca trực không đúng kiểu dữ liệu!'
        ];
    }
    public function prepareForValidation(){
        $this->merge(['slug' => Str::slug($this->name)]);
    }
}
