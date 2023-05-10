<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\UserApiField;
use App\Models\User;

class RegisterAction extends Action
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $data): array
    {
        $data[UserApiField::DISCOUNT_CODE] = time().rand(11,99);
        $data[UserApiField::DISCOUNT_PERCENT] = 10;

        $user = User::create($this->toDBUsageField($data));
        $user[UserApiField::TOKEN] = auth()->login($user);

        return $this->toAPIUsageField($user->toArray());
    }
}
