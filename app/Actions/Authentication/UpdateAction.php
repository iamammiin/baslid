<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Constant\User\DiscountRequestStatus;
use App\Constant\User\UserApiField;
use App\Exceptions\CustomException;

class UpdateAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $data): array
    {
        $user = auth()->user();

        if (isset($data[UserApiField::DISCOUNT_PERCENT])) {
            $data[UserApiField::DISCOUNT_REQUEST_STATUS] = DiscountRequestStatus::PENDING;
            $data[UserApiField::DISCOUNT_REQUEST_PERCENT] = $data[UserApiField::DISCOUNT_PERCENT];
            unset($data[UserApiField::DISCOUNT_PERCENT]);
        }

        $user->update($this->toDBUsageField($data));

        return $this->toAPIUsageField($user->toArray());
    }
}
