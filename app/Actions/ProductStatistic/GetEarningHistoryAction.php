<?php

namespace App\Actions\ProductStatistic;

use App\Actions\Action;
use App\Exceptions\CustomException;
use App\Models\ProductStatistic;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/**
 *  @OA\Schema(
 *      schema="EarningHistoryForPrevDaysDTO",
 *      title="Get Earning history Dto",
 *      description="Get Earning history data",
 *      type="object",
 *      @OA\Property(property="2023-05-1", title="2023-05-1", type="int",example=13),
 *      @OA\Property(property="2023-05-2", title="2023-05-2", type="int",example=145),
 *      @OA\Property(property="2023-05-3", title="2023-05-3", type="int",example=113),
 *      @OA\Property(property="2023-05-4", title="2023-05-4", type="int",example=100),
 *      @OA\Property(property="2023-05-5", title="2023-05-5", type="int",example=0),
 * )
 *
 *
 *  @OA\Schema(
 *      schema="EarningHistoryForYearDaysDTO",
 *      title="Get Earning history Dto",
 *      description="Get Earning history data",
 *      type="object",
 *      @OA\Property(property="1", title="1", type="int",example=223),
 *      @OA\Property(property="2", title="2", type="int",example=13),
 *      @OA\Property(property="3", title="3", type="int",example=4),
 *      @OA\Property(property="4", title="4", type="int",example=54),
 *      @OA\Property(property="5", title="5", type="int",example=133),
 *      @OA\Property(property="6", title="6", type="int",example=11),
 *      @OA\Property(property="7", title="7", type="int",example=43),
 *      @OA\Property(property="8", title="8", type="int",example=2),
 *      @OA\Property(property="9", title="9", type="int",example=5),
 *      @OA\Property(property="10", title="10", type="int",example=6),
 *      @OA\Property(property="11", title="11", type="int",example=22),
 *      @OA\Property(property="12", title="12", type="int",example=135)
 * )
 */
class GetEarningHistoryAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $data): array
    {
        $user = auth()->user();
        if (isset($data['prevDays']) && $data['prevDays'] <= 60 && $data['prevDays'] >= 1) {
            $firstDay = Carbon::now()->subDays((int)$data['prevDays'])->toDateString();
            $lastDay = Carbon::make($firstDay)->addDays((int)$data['prevDays'])->toDateString();

            $days = CarbonPeriod::create($firstDay, $lastDay);
            foreach ($days as $day) {
                $response[$day->toDateString()] = 0;
            }

            $result = ProductStatistic::where('date', '>=', $firstDay)
                ->where('date', '<=', $lastDay)
                ->selectRaw('date, sum(earning) as total_earning')
                ->where('user_id', $user->id)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get()->toArray();

            foreach ($result as $day) {
                $response[$day['date']] = (int)$day['total_earning'];
            }
        } else {
            $result = ProductStatistic::whereYear('date', Carbon::now()->format('Y'))
                ->selectRaw('month(date) month, sum(earning) as total_earning')
                ->where('user_id', $user->id)
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get()->toArray();
            $response = array();
            foreach ($result as $monthData) {
                $response[$monthData['month']] = (int)$monthData['total_earning'];
            }

            for ($i = 1; $i <= 12; $i++) {
                if (!isset($response[$i])) {
                    $response[$i] = 0;
                }
            }

            ksort($response);
        }


        return $this->toAPIUsageField($response);
    }
}
