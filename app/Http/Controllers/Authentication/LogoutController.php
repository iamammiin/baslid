<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\LogoutAction;
use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *      path="/auth/logout",
 *      tags={"Authentication"},
 *      summary="logout user",
 *      description="logout user",
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(type="object",ref="#/components/schemas/Unauthenticated")
 *      ),
 *     security={{"client_bearer_token":{}}}
 * )
 */
class LogoutController extends Controller
{
    private LogoutAction $logoutAction;

    public function __construct(LogoutAction $logoutAction)
    {
        $this->logoutAction = $logoutAction;
    }

    public function __invoke()
    {
        $this->logoutAction->__invoke();

        return $this->generateResponse('SUCCESS', [], 202);
    }
}
