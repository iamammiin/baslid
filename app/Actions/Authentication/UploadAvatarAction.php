<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\UserApiField;
use App\Constant\User\UserDatabaseField;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;

class UploadAvatarAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(Request $request): array
    {
        $user = auth()->user();

        $imagePath = $request->file(UserApiField::AVATAR)->store('image', 'public');

        $user->update([
            UserDatabaseField::AVATAR => '/storage/' . $imagePath
        ]);

        return $this->toAPIUsageField($user->toArray());
    }
}
