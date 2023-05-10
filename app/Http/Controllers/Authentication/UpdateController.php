<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\UpdateAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\UpdateUserRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Patch(
 *      path="/auth/update",
 *      tags={"Authentication"},
 *      summary="update user",
 *      description="update user information, please just send changed items",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequestBody")
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
class UpdateController extends Controller
{
    private UpdateAction $updateAction;

    public function __construct(UpdateAction $updateAction)
    {
        $this->updateAction = $updateAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(UpdateUserRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $data = $this->updateAction->__invoke($validate);

        return $this->generateResponse('SUCCESS', $data, 200);
    }
}
