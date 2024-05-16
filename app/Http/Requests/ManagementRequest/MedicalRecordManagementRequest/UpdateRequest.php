<?php

namespace App\Http\Requests\ManagementRequest\MedicalRecordManagementRequest;

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
        return [
            'user_uuid' => 'required',
            'doctor_uuid' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vessel' => 'required',
            'blood_pressure' => 'required',
            'temperature' => 'required',
            'reason' => 'required',
            'disease' => 'required',
            'exam_date' => 'required|date',
            'shift_id' => 'required',
            're_exam_date' => 'required|date',
            'note' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'date' => 'Vui lòng điền đúng định dạng ngày/tháng/năm!',
        ];
    }
}
