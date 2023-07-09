<?php

namespace App\Actions\User;

use App\Actions\Action;
use App\Constant\User\DiscountRequestStatus;
use App\Constant\User\UserApiField;
use App\Constant\User\UserDatabaseField;
use App\Exceptions\CustomException;
use App\Models\User;

class AcceptOrRejectRequestDiscountChangesAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(int $userId, bool $status): array
    {
        $user = User::find($userId);

        if (empty($user)) {
            throw new CustomException('User Not Found', 404);
        }

        if (empty($user->{UserDatabaseField::DISCOUNT_REQUEST_PERCENT})){
            throw new CustomException('not have discount change request', 400);
        }

        $data[UserApiField::DISCOUNT_REQUEST_STATUS] = DiscountRequestStatus::ENABLE;
        $data[UserApiField::DISCOUNT_REQUEST_PERCENT] = null;

        if ($status) {
            $data[UserApiField::DISCOUNT_PERCENT] = $user->{UserDatabaseField::DISCOUNT_REQUEST_PERCENT};
        }

        $user->update($this->toDBUsageField($data));

        return $this->toAPIUsageField($user->toArray());
    }
}
