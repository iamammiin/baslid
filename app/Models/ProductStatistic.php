<?php

namespace App\Models;

use App\Constant\ProductStatistic\ProductStatisticDatabaseField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="ProductStatisticDTO",
 *      title="Product Statistic Dto",
 *      description="Product Statistic data",
 *      type="object",
 *      @OA\Property(property="name", title="name", description="name of product", type="string",example="mouse"),
 *      @OA\Property(property="image", title="image", description="image url of product", type="string",example="mouse.jpeg"),
 *      @OA\Property(property="date", title="date", description="date of product", type="string",example="2023-05-05"),
 *      @OA\Property(property="tendered", title="tendered", description="tendered of product", type="int",example=200),
 *      @OA\Property(property="earning", title="earning", description="earning of product", type="int",example=10),
 *      @OA\Property(property="status", title="status", description="paid status of product", type="bool",example=1)
 * )
 */
class ProductStatistic extends Model
{
    use HasFactory;

    protected $table = "product_statistics";

    protected $fillable = ProductStatisticDatabaseField::AVAILABLE_FOR_CREATE_OR_UPDATE;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
