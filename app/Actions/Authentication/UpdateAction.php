<?php

namespace App\Actions\Authentication;

use App\Actions\Action;
use App\Exceptions\CustomException;

class UpdateAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $data): array
    {
        $user = auth()->user();

        $user->update($this->toDBUsageField($data));

        return $this->toAPIUsageField($user->toArray());
    }
}
