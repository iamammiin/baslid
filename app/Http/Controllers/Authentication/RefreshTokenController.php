<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\RefreshTokenAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post (
 *      path="/auth/refresh",
 *      tags={"Authentication"},
 *      summary="refresh user token",
 *      description="refresh user token",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/UserDTO")
 *          )
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(type="object",ref="#/components/schemas/Unauthenticated")
 *      ),
 *     security={{"client_bearer_token":{}}}
 * )
 */
class RefreshTokenController extends Controller
{
    private RefreshTokenAction $refreshTokenAction;

    public function __construct(RefreshTokenAction $refreshTokenAction)
    {
        $this->refreshTokenAction = $refreshTokenAction;
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->refreshTokenAction->__invoke();

        return $this->generateResponse('SUCCESS', $data);
    }
}
