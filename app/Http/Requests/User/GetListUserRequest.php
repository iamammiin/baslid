<?php

namespace App\Http\Requests\User;

use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

class GetListUserRequest extends FormRequest
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
            'hasDiscountRequest' => 'bool',
            'perPage' => 'nullable|int',
            'page' => 'nullable|int',
            'orderField' => 'nullable|string|in:' . implode(',', [
                    UserApiField::FIRST_NAME,
                    UserApiField::LAST_NAME,
                    UserApiField::EMAIL,
                    'id'
                ]),
            'orderType' => 'nullable|string|in:' . implode(',', [
                    'ASC',
                    'DESC'
                ])
        ];
    }
}
