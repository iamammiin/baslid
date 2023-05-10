<?php

namespace App\Actions\ProductStatistic;

use App\Actions\Action;
use App\Exceptions\CustomException;
use App\Models\ProductStatistic;

/**
 *  @OA\Schema(
 *      schema="ListProductStatisticDTO",
 *      title="list of Product Statistic Dto",
 *      description="list of Product Statistic data",
 *      type="object",
 *      @OA\Property(property="currentPage", title="currentPage", type="int",example=1),
 *      @OA\Property(property="from", title="from", type="string",example=1),
 *      @OA\Property(property="lastPage", title="lastPage", type="int",example=5),
 *      @OA\Property(property="perPage", title="perPage", type="int",example=15),
 *      @OA\Property(property="to", title="to", type="int",example=10),
 *      @OA\Property(property="total", title="total", type="int",example=10),
 *      @OA\Property(property="content", type="array",@OA\Items(type="object",ref="#/components/schemas/ProductStatisticDTO"))
 * )
 */
class GetListAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $data): array
    {
        $productStatistics = ProductStatistic::where('user_id', auth()->user()->id)
            ->orderBy($data['orderFiled'] ?? 'id', $data['orderType'] ?? 'desc')
            ->paginate($data['perPage'] ?? 10);

        $productStatisticsArray = $productStatistics->toArray();
        $result = $productStatisticsArray;
        unset($result['data'], $result['links'], $result['last_page_url'], $result['next_page_url'], $result['prev_page_url'], $result['path'], $result['first_page_url']);

        $result['content'] = $productStatisticsArray['data'];
        return $this->toAPIUsageField($result);
    }
}
