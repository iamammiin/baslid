<?php

namespace App\Http\Requests\Authentication;

use App\Constant\User\Type;
use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="RegisterUserRequestBody",
 *      title="Register User Request Body",
 *      description="Register User Request Body",
 *      type="object",
 *      @OA\Property(property="firstName", title="firstName", description="first name of user", type="string", example="Amin"),
 *      @OA\Property(property="lastName", title="lastName", description="last name of user", type="string", example="Mazreali"),
 *      @OA\Property(property="phone", title="phone", description="phone of user", type="string", example="09214125578"),
 *      @OA\Property(property="type", title="type", description="type of user", type="int", example=2),
 *      @OA\Property(property="email", title="email", description="email of user", type="string", example="amin@gmail.com"),
 *      @OA\Property(property="country", title="country", description="country of user", type="string", example="iran"),
 *      @OA\Property(property="password", title="password", description="password of user", type="string", example="123456"),
 * )
 */
class RegisterUserRequest extends FormRequest
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
            UserApiField::FIRST_NAME => 'required|max:195',
            UserApiField::LAST_NAME => 'required|max:195',
            UserApiField::PHONE => 'required|max:20',
            UserApiField::TYPE => 'required|in:'. implode(',',Type::AVAILABLE_TYPE),
            UserApiField::EMAIL => 'required|email|max:195|unique:Users',
            UserApiField::PASSWORD => 'required|min:6',
            UserApiField::COUNTRY => 'required',
            UserApiField::ADDRESS => 'nullable',
            UserApiField::LANGUAGE => 'nullable',
            UserApiField::PRICE => 'nullable',
            UserApiField::BIOGRAPHY => 'nullable',
            UserApiField::PAYPAL_ADDRESS => 'nullable',
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
