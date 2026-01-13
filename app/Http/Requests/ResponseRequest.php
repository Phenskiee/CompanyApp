<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponseRequest extends FormRequest
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
            'application_date' => 'nullable|date',
            'status_id' => 'nullable|exists:dropdowns,id',
            'date_of_interview' => 'nullable|date',
            'time_of_interview' => 'nullable',
            'status_after_interview_id' => 'nullable|exists:dropdowns,id',
        ];
    }
}
