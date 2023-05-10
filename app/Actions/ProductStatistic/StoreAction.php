<?php

namespace App\Actions\ProductStatistic;

use App\Actions\Action;
use App\Constant\ProductStatistic\ProductStatisticApiField;
use App\Constant\User\UserDatabaseField;
use App\Exceptions\CustomException;
use App\Models\ProductStatistic;
use App\Models\User;

class StoreAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(string $discountCode, array $data): array
    {
        $user = User::where(UserDatabaseField::DISCOUNT_CODE, $discountCode)->first();

        if (empty($user)) {
            throw new CustomException('User Not Found', 404);
        }

        $data[ProductStatisticApiField::USER_ID] = $user->id;

        $productStatistic = ProductStatistic::create($this->toDBUsageField($data));

        return $this->toAPIUsageField($productStatistic->toArray());
    }
}
