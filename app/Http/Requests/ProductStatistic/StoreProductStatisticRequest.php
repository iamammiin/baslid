<?php

namespace App\Http\Requests\ProductStatistic;

use App\Constant\ProductStatistic\ProductStatisticApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="StoreProductStatisticRequestBody",
 *      title="Store Product Statistic Request Body",
 *      description="Store Product Statistic Request Body",
 *      type="object",
 *      @OA\Property(property="name", title="name", description="name of product", type="string",example="mouse"),
 *      @OA\Property(property="image", title="image", description="image url of product", type="string",example="mouse.jpeg"),
 *      @OA\Property(property="date", title="date", description="date of product", type="string",example="2023-05-05"),
 *      @OA\Property(property="tendered", title="tendered", description="tendered of product", type="int",example=200),
 *      @OA\Property(property="earning", title="earning", description="earning of product", type="int",example=10),
 *      @OA\Property(property="status", title="status", description="paid status of product", type="bool",example=1),
 * )
 */
class StoreProductStatisticRequest extends FormRequest
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
            ProductStatisticApiField::NAME => 'required|string',
            ProductStatisticApiField::IMAGE => 'required|string',
            ProductStatisticApiField::DATE => 'required|date_format:Y-m-d',
            ProductStatisticApiField::TENDERED => 'required|integer',
            ProductStatisticApiField::EARNING => 'required|integer',
            ProductStatisticApiField::STATUS => 'required|boolean',
        ];
    }
}
