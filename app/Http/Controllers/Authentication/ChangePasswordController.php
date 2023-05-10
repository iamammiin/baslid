<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\ChangePasswordAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ChangePasswordRequest;

/**
 * @OA\Post(
 *      path="/auth/change-password",
 *      tags={"Authentication"},
 *      summary="change user password",
 *      description="change user password",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/ChangePasswordUserRequestBody")
 *      ),
 *      @OA\Response(
 *          response=202,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="array",@OA\Items())
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
class ChangePasswordController extends Controller
{
    private ChangePasswordAction $changePasswordAction;

    public function __construct(ChangePasswordAction $changePasswordAction)
    {
        $this->changePasswordAction = $changePasswordAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $validate = $request->validated();

        $this->changePasswordAction->__invoke($validate);

        return $this->generateResponse('SUCCESS', [], 202);
    }
}
