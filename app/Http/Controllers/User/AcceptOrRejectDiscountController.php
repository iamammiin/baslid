<?php

namespace App\Http\Controllers\User;

use App\Actions\Authentication\UpdateAction;
use App\Actions\User\AcceptOrRejectRequestDiscountChangesAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\UpdateUserRequest;
use App\Http\Requests\User\AcceptOrRejectDiscountRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *      path="/users/{userId}/accept-reject-discount",
 *      tags={"User"},
 *      summary="accept or reject discount request",
 *      description="uaccept or reject discount request",
 *     @OA\Parameter(
 *          name="userId",
 *          description="id of user",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/AcceptOrRejectDiscountRequestBody")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/UserDTO")
 *          )
 *       ),
 *     @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(type="object",ref="#/components/schemas/Unauthenticated")
 *      ),
 *     security={{"client_bearer_token":{}}}
 * )
 */
class AcceptOrRejectDiscountController extends Controller
{
    private AcceptOrRejectRequestDiscountChangesAction $acceptOrRejectRequestDiscountChangesAction;

    public function __construct(AcceptOrRejectRequestDiscountChangesAction $acceptOrRejectRequestDiscountChangesAction)
    {
        $this->acceptOrRejectRequestDiscountChangesAction = $acceptOrRejectRequestDiscountChangesAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(AcceptOrRejectDiscountRequest $request, $userId): JsonResponse
    {
        $validate = $request->validated();

        $data = $this->acceptOrRejectRequestDiscountChangesAction->__invoke($userId, $validate['status']);

        return $this->generateResponse('SUCCESS', $data, 200);
    }
}
