<?php

namespace App\Http\Requests\ProductStatistic;

use App\Constant\ProductStatistic\ProductStatisticApiField;
use Illuminate\Foundation\Http\FormRequest;

class GetEarningHistoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prevDays' => 'nullable|int'
        ];
    }
}
