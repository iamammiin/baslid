<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\GetProfileAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *      path="/auth/profile",
 *      tags={"Authentication"},
 *      summary="user profile",
 *      description="user profile",
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
class GetProfileController extends Controller
{
    private GetProfileAction $getProfileAction;

    public function __construct(GetProfileAction $getProfileAction)
    {
        $this->getProfileAction = $getProfileAction;
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->getProfileAction->__invoke();

        return $this->generateResponse('SUCCESS', $data);
    }
}
