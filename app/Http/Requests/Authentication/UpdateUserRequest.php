<?php

namespace App\Http\Requests\Authentication;

use App\Constant\User\Type;
use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="UpdateUserRequestBody",
 *      title="Update User Request Body",
 *      description="Update User Request Body",
 *      type="object",
 *      @OA\Property(property="firstName", title="firstName", description="first name of user", type="string", example="Amin"),
 *      @OA\Property(property="lastName", title="lastName", description="last name of user", type="string", example="Mazreali"),
 *      @OA\Property(property="phone", title="phone", description="phone of user", type="string", example="09214125578"),
 *      @OA\Property(property="type", title="type", description="type of user", type="int", example=2),
 *      @OA\Property(property="email", title="email", description="email of user", type="string", example="amin@gmail.com"),
 *      @OA\Property(property="country", title="country", description="country of user", type="string", example="iran"),
 *      @OA\Property(property="address", title="address", description="address of user", type="string", example="iran,tehran,vanak"),
 *      @OA\Property(property="language", title="language", description="language of user", type="string", example="English"),
 *      @OA\Property(property="price", title="price", description="price of user", type="string", example="Rial"),
 *      @OA\Property(property="biography", title="biography", description="biography of user", type="string", example="i am amin, ..."),
 *      @OA\Property(property="paypalAddress", title="paypalAddress", description="Paypal address of user", type="string", example="paypal.com/amin"),
 *      @OA\Property(property="discountPercent", title="discountPercent", description="discount percent of user", type="int", example=10),
 *      @OA\Property(property="instagramUsername", title="instagramUsername", description="instagram username of user", type="string", example="iamammiin"),
 *      @OA\Property(property="youtubeUsername", title="youtubeUsername", description="youtube username of user", type="string", example="iamammiin"),
 *      @OA\Property(property="tiktokUsername", title="tiktokUsername", description="tiktok username of user", type="string", example="iamammiin")
 * )
 */
class UpdateUserRequest extends FormRequest
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
            UserApiField::FIRST_NAME => 'nullable|min:3|max:195',
            UserApiField::LAST_NAME => 'nullable|min:3|max:195',
            UserApiField::PHONE => 'nullable|min:3|max:20',
            UserApiField::TYPE => 'nullable|min:1|in:'. implode(',',Type::AVAILABLE_TYPE),
            UserApiField::EMAIL => 'nullable|email|min:1|max:195|unique:users,email,'.auth()->user()->id,
            UserApiField::COUNTRY => 'nullable',
            UserApiField::ADDRESS => 'nullable',
            UserApiField::LANGUAGE => 'nullable',
            UserApiField::PRICE => 'nullable',
            UserApiField::BIOGRAPHY => 'nullable',
            UserApiField::PAYPAL_ADDRESS => 'nullable',
            UserApiField::DISCOUNT_PERCENT => 'nullable|int',
            UserApiField::INSTAGRAM_USERNAME => 'nullable|string',
            UserApiField::YOUTUBE_USERNAME => 'nullable|string',
            UserApiField::TIKTOK_USERNAME => 'nullable|string',
        ];
    }
}
