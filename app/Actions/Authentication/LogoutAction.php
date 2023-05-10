<?php

namespace App\Actions\Authentication;

use App\Actions\Action;

class LogoutAction extends Action
{
    public function __invoke(): void
    {
        auth()->logout();
    }
}
