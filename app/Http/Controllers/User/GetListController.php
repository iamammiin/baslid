<?php

namespace App\Http\Controllers\User;

use App\Actions\User\GetListAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetListUserRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *      path="/users",
 *      tags={"User"},
 *      summary="get users list",
 *      description="get users list",
 *     @OA\Parameter(
 *          name="page",
 *          description="current page",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="int"
 *          )
 *      ),
 *     @OA\Parameter(
 *          name="perPage",
 *          description="count of user in page",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="int"
 *          )
 *      ),@OA\Parameter(
 *          name="orderField",
 *          description="name of field for sort",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),@OA\Parameter(
 *          name="orderType",
 *          description="type of sort for example:ASC, DESC",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),@OA\Parameter(
 *          name="hasDiscountRequest",
 *          description="when send this true get all user has discount request changed",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/ListUserDTO")
 *          )
 *       ),
 *     @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(type="object",ref="#/components/schemas/Unauthenticated")
 *      ),
 *     security={{"client_bearer_token":{}}}
 * )
 */
class GetListController extends Controller
{
    private GetListAction $getListAction;

    public function __construct(GetListAction $getListAction)
    {
        $this->getListAction = $getListAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(GetListUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->getListAction->__invoke($validated);

        return $this->generateResponse('SUCCESS', $data, 200);
    }
}
