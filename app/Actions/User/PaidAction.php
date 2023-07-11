<?php

namespace App\Actions\User;

use App\Actions\Action;
use App\Constant\ProductStatistic\ProductStatisticDatabaseField;
use App\Exceptions\CustomException;
use App\Models\ProductStatistic;

class PaidAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(int $userId): array
    {
        ProductStatistic::where(ProductStatisticDatabaseField::USER_ID, $userId)
            ->update([
                ProductStatisticDatabaseField::STATUS => 2
            ]);

        return $this->toAPIUsageField([]);
    }
}
