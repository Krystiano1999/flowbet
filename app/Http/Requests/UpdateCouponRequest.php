<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'step_id' => 'nullable|integer|exists:steps,id',
            'type' => 'required|in:standard,extra',
            'amount' => 'required|numeric|min:0',
            'odds' => 'required|numeric|min:1',
            'result' => 'nullable|in:win,lose,null',
            'events_count' => 'required|integer|min:1',
            'won_events_count' => 'required|integer|min:0|lte:events_count',
            'lost_events_count' => 'required|integer|min:0|lte:events_count',
        ];
    }
}