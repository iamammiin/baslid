<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\UserApiField;
use App\Constant\User\UserDatabaseField;
use App\Exceptions\CustomException;

class ChangePasswordAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $validate): void
    {
        $user = auth()->user();

        $hash = app('hash');
        if ($hash->check($validate[UserApiField::CURRENT_PASSWORD], $user->{UserDatabaseField::PASSWORD})) {
            $user->update([
               UserDatabaseField::PASSWORD => $validate[UserDatabaseField::PASSWORD]
            ]);
        }else{
           throw new CustomException('Current Password Is Incorrect',400);
        }
    }
}
