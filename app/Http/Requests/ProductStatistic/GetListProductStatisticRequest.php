<?php

namespace App\Http\Requests\ProductStatistic;

use App\Constant\ProductStatistic\ProductStatisticApiField;
use Illuminate\Foundation\Http\FormRequest;

class GetListProductStatisticRequest extends FormRequest
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
            'perPage' => 'nullable|int',
            'page' => 'nullable|int',
            'orderField' => 'nullable|string|in:' . implode(',', [
                    ProductStatisticApiField::NAME,
                    ProductStatisticApiField::STATUS,
                    ProductStatisticApiField::DATE,
                    ProductStatisticApiField::EARNING,
                    ProductStatisticApiField::TENDERED,
                ]),
            'orderType' => 'nullable|string|in:' . implode(',', [
                    'ASC',
                    'DESC'
                ])
        ];
    }
}
