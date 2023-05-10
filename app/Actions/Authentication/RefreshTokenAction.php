<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\UserApiField;

class RefreshTokenAction extends Action
{
    public function __invoke(): array
    {
        $user = auth()->user();
        $user[UserApiField::TOKEN] = auth()->refresh(true, true);

        return $this->toAPIUsageField($user->toArray());
    }
}
