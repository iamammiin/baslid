<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\UserApiField;
use App\Exceptions\CustomException;
use App\Models\User;
use Illuminate\Validation\UnauthorizedException;

class LoginAction extends Action
{
    public function __invoke($data): array
    {
        $token = auth()->attempt($data);

        if (!$token){
            throw new CustomException('Unauthorized');
        }

        $user = auth()->user();
        $user[UserApiField::TOKEN] = $token;

        return $this->toAPIUsageField($user->toArray());
    }
}
