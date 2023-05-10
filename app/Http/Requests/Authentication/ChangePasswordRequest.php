<?php

namespace App\Http\Requests\Authentication;

use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="ChangePasswordUserRequestBody",
 *      title="Change Password User Request Body",
 *      description="Change Password User Request Body",
 *      type="object",
 *      @OA\Property(property="currentPassword", title="currentPassword", description="current password of user", type="string", example="123456"),
 *      @OA\Property(property="password", title="password", description="password of user", type="string", example="1234567"),
 * )
 */
class ChangePasswordRequest extends FormRequest
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
            UserApiField:: CURRENT_PASSWORD => 'required|min:6',
            UserApiField::PASSWORD => 'required|min:6'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            UserApiField::PASSWORD => bcrypt($this->password),
        ]);
    }
}
