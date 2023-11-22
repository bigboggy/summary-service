<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewSummaryRequest extends FormRequest
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
            'currentSprint' => 'required|array',
            'currentSprint.day' => 'required|integer',
            'currentSprint.currentMorale' => 'required|integer',
            'currentSprint.progress' => 'required|integer',
            'currentSprint.done' => 'required|integer',
            'currentSprint.open' => 'required|integer',
            'currentSprint.blocked' => 'required|array',
            'currentSprint.blocked.*.assignee' => 'required|string',
            'currentSprint.blocked.*.title' => 'required|string',
            'currentSprint.blocked.*.blockedDateSince' => 'required|date_format:Y-m-d',
            'lastSprint' => 'required|array',
            'lastSprint.day' => 'required|integer',
            'lastSprint.currentMorale' => 'required|integer',
            'lastSprint.progress' => 'required|integer',
            'lastSprint.done' => 'required|integer',
            'lastSprint.open' => 'required|integer',
            'lastSprint.blocked' => 'nullable|array',
        ];
    }
}
