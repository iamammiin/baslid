<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\UploadAvatarAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\UploadAvatarRequest;

/**
 * @OA\Post(
 *      path="/auth/upload-avatar",
 *      tags={"Authentication"},
 *      summary="upload user avatar",
 *      description="upload user avatar",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/UploadAvatarUserRequestBody")
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
class UploadAvatarController extends Controller
{
    private UploadAvatarAction $uploadAvatarAction;

    public function __construct(UploadAvatarAction $uploadAvatarAction)
    {
        $this->uploadAvatarAction = $uploadAvatarAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(UploadAvatarRequest $request)
    {
        $request->validated();

        $data = $this->uploadAvatarAction->__invoke($request);

        return $this->generateResponse('SUCCESS', $data, 200);
    }
}
