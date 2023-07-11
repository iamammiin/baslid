<?php

namespace App\Http\Controllers\User;

use App\Actions\User\PaidAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *      path="/users/{userId}/paid-all-product",
 *      tags={"User"},
 *      summary="paid all product statistic for user",
 *      description="paid all product statistic for user",
 *     @OA\Parameter(
 *          name="userId",
 *          description="id of user",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="array",@OA\Items())
 *          )
 *       ),
 *     security={{"client_bearer_token":{}}}
 * )
 */
class PaidController extends Controller
{
    private PaidAction $paidAction;

    public function __construct(PaidAction $paidAction)
    {
        $this->paidAction = $paidAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(int $userId): JsonResponse
    {
        $data = $this->paidAction->__invoke($userId);

        return $this->generateResponse('SUCCESS', $data, 201);
    }
}
