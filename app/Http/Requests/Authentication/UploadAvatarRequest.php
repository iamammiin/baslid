<?php

namespace App\Http\Requests\Authentication;

use App\Constant\User\UserApiField;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="UploadAvatarUserRequestBody",
 *      title="Upload Avatar User Request Body",
 *      description="Upload Avatar User Request Body",
 *      type="object",
 *      @OA\Property(property="avatar", title="avatar", description="avatar of user", type="string", format="binary")
 * )
 */
class UploadAvatarRequest extends FormRequest
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
            UserApiField:: AVATAR => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
