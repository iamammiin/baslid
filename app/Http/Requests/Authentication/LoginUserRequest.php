<?php

namespace App\Http\Requests\Authentication;

use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="LoginUserRequestBody",
 *      title="login User Request Body",
 *      description="login User Request Body",
 *      type="object",
 *      @OA\Property(property="email", title="email", description="email of user", type="string", example="amin@gmail.com"),
 *      @OA\Property(property="password", title="password", description="password of user", type="string", example="123456"),
 * )
 */
class LoginUserRequest extends FormRequest
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
            UserApiField::EMAIL => 'required|email|max:195',
            UserApiField::PASSWORD => 'required|min:6'
        ];
    }
}
