<?php

namespace App\Http\Controllers\ProductStatistic;

use App\Actions\ProductStatistic\StoreAction;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStatistic\StoreProductStatisticRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *      path="/product-statistic/{userDiscountCode}",
 *      tags={"Product"},
 *      summary="store new product statistic for user",
 *      description="store new product statistic for user",
 *     @OA\Parameter(
 *          name="userDiscountCode",
 *          description="user discount code",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/StoreProductStatisticRequestBody")
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(type="object",
 *              @OA\Property(property="message", type="string", example=""),
 *              @OA\Property(property="data", type="object",ref="#/components/schemas/ProductStatisticDTO")
 *          )
 *       )
 * )
 */
class StoreController extends Controller
{
    private StoreAction $storeAction;

    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

    /**
     * @throws CustomException
     */
    public function __invoke(StoreProductStatisticRequest $request, string $discountCode): JsonResponse
    {
        $validate = $request->validated();

        $data = $this->storeAction->__invoke($discountCode, $validate);

        return $this->generateResponse('SUCCESS', $data, 201);
    }
}
