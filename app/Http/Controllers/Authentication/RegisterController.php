<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterUserRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *      path="/auth/register",
 *      tags={"Authentication"},
 *      summary="register user",
 *      description="register new user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/RegisterUserRequestBody")
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/UserDTO")
 *          )
 *       )
 * )
 */
class RegisterController extends Controller
{
    private RegisterAction $registerAction;

    public function __construct(RegisterAction $registerAction)
    {
        $this->registerAction = $registerAction;
    }

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->registerAction->__invoke($validated);

        return $this->generateResponse('SUCCESS', $data, 201);
    }
}
