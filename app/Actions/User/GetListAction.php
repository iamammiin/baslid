<?php

namespace App\Actions\User;

use App\Actions\Action;
use App\Constant\User\DiscountRequestStatus;
use App\Constant\User\UserDatabaseField;
use App\Exceptions\CustomException;
use App\Models\User;

/**
 * @OA\Schema(
 *      schema="ListUserDTO",
 *      title="list of User Dto",
 *      description="list of User data",
 *      type="object",
 *      @OA\Property(property="currentPage", title="currentPage", type="int",example=1),
 *      @OA\Property(property="from", title="from", type="string",example=1),
 *      @OA\Property(property="lastPage", title="lastPage", type="int",example=5),
 *      @OA\Property(property="perPage", title="perPage", type="int",example=15),
 *      @OA\Property(property="to", title="to", type="int",example=10),
 *      @OA\Property(property="total", title="total", type="int",example=10),
 *      @OA\Property(property="content", type="array",@OA\Items(type="object",ref="#/components/schemas/UserDTO"))
 * )
 */
class GetListAction extends Action
{
    /**
     * @throws CustomException
     */
    public function __invoke(array $data): array
    {
        if (isset($data['hasDiscountRequest']) && $data['hasDiscountRequest']) {
            $users = User::where(UserDatabaseField::DISCOUNT_REQUEST_STATUS, DiscountRequestStatus::PENDING);
        } else {
            $users = User::query();
        }

        $users = $users->orderBy($data['orderFiled'] ?? 'id', $data['orderType'] ?? 'desc')
            ->paginate($data['perPage'] ?? 10);

        $usersArray = $users->toArray();
        $result = $usersArray;
        unset($result['data'], $result['links'], $result['last_page_url'], $result['next_page_url'], $result['prev_page_url'], $result['path'], $result['first_page_url']);

        $result['content'] = $usersArray['data'];
        return $this->toAPIUsageField($result);
    }
}
