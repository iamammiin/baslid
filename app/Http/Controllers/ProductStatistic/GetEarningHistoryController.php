<?php

namespace App\Http\Controllers\ProductStatistic;

use App\Actions\ProductStatistic\GetEarningHistoryAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStatistic\GetEarningHistoryRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *      path="/product-statistic/earning-history",
 *      tags={"Product"},
 *      summary="get earning history",
 *      description="get earning history for user",
 *     @OA\Parameter(
 *          name="prevDays",
 *          description="previous days for report",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="int"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation when send prevDays",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/EarningHistoryForPrevDaysDTO")
 *          )
 *       ),
 *     @OA\Response(
 *          response=2000,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/EarningHistoryForYearDaysDTO")
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
class GetEarningHistoryController extends Controller
{
    private GetEarningHistoryAction $getEarningHistoryAction;

    public function __construct(GetEarningHistoryAction $getEarningHistoryAction)
    {
        $this->getEarningHistoryAction = $getEarningHistoryAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(GetEarningHistoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->getEarningHistoryAction->__invoke($validated);

        return $this->generateResponse('SUCCESS', $data, 200);
    }
}
