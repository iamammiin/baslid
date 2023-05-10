<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Baslid Project Api Documentation",
 *      description="This is a documentation for the Baslid Project witch is produced by Swagger",
 *      @OA\Contact(
 *          email="aminmohammadmazreali@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Nginx 1.17.7",
 *          url="https://nginx.org/LICENSE"
 *      )
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Base Url"
 * )
 *
 * @OA\Schema(
 *      schema="Unauthenticated",
 *      title="Unauthenticated",
 *      description="Unauthenticated Request",
 *      type="object",
 *      @OA\Property(property="message", title="message", type="string", example="Unauthenticated"),
 * )
 *
 * @OA\Schema(
 *      schema="NotFound",
 *      title="notFound",
 *      description="notFound Request",
 *      type="object",
 *      @OA\Property(property="message", title="message", type="string", example="not Found"),
 *      @OA\Property(property="code", title="code",  type="int", example="404"),
 * )
 *
 * @OA\Schema(
 *      schema="BadRequest",
 *      title="badRequest",
 *      description="Bad Request",
 *      type="object",
 *      @OA\Property(property="message", title="message", type="string", example="Bad Request"),
 *      @OA\Property(property="code", title="code",  type="int", example="400"),
 * )
 *
 *
 * @OA\PathItem(path="/api")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function generateResponse(string $message = '', array $data = [], int $httpStatus = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpStatus);
    }
}
