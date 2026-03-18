<?php

namespace App\Http\Requests\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SegmentRequests extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attendance_id' => 'required|string|max:255',
            'segment_type' => 'required|string|in:TRAVEL,SITE,OFFICE',
            'site_id' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'segment_type.in' => 'Segment type must be TRAVEL, SITE, or OFFICE.',
            'end_time.after_or_equal' => 'End time must be after or equal to start time.',
        ];
    }
}
