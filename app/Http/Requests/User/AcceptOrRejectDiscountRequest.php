<?php

namespace App\Http\Requests\User;

use App\Constant\User\Type;
use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="AcceptOrRejectDiscountRequestBody",
 *      title="Accept Or Reject Discount Request Body",
 *      description="Accept Or Reject Discount Request Body",
 *      type="object",
 *      @OA\Property(property="status", title="status", description="status of action, true is accept and false is reject", type="bool", example=1)
 * )
 */
class AcceptOrRejectDiscountRequest extends FormRequest
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
            'status' => 'required|bool'
        ];
    }
}
