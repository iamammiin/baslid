<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\LoginAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginUserRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *      path="/auth/login",
 *      tags={"Authentication"},
 *      summary="login user",
 *      description="login user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/LoginUserRequestBody")
 *      ),
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
 *          description="Unauthorized",
 *          @OA\JsonContent(type="object",ref="#/components/schemas/Unauthenticated")
 *      )
 * )
 */
class LoginController extends Controller
{
    private LoginAction $loginAction;

    public function __construct(LoginAction $loginAction)
    {
        $this->loginAction = $loginAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->loginAction->__invoke($validated);

        return $this->generateResponse('SUCCESS', $data);
    }
}
