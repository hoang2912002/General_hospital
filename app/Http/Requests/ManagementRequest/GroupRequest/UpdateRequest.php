<?php

namespace App\Http\Requests\ManagementRequest\GroupRequest;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

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
        $id = request()->route()->groupModel->id;
        return [
            'name' => 'required|unique:groups,name,' .$id,
            'slug' => 'sometimes',
            'activated' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'required' => 'Trường này không được bỏ trống!',
            'unique' => 'Trường này đã tồn tại!',
            'sometimes' => 'Trường này không đúng kiểu dữ liệu!'
        ];
    }
    public function prepareForValidation(){
        $this->merge(['slug' => Str::slug($this->name)]);
    }
}
