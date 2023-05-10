<?php

namespace App\Actions\Authentication;

use App\Actions\Action;

class GetProfileAction extends Action
{
    public function __invoke(): array
    {
        $user = auth()->user();

        return $this->toAPIUsageField($user->toArray());
    }
}
