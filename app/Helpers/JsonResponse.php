<?php
/**
 * Created by PhpStorm.
 * User: davidmogbeyiteren
 * Date: 2019-12-20
 * Time: 12:10
 */

namespace App\Helpers;


trait JsonResponse
{

    /**
     * @param array $data
     * @param int $statusCode
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data = [], $message = 'Operation Successful', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }


    /**
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($data = [], $message = 'Bad Request', $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFatalError($data = [], $message = 'Something went wrong! We are working on it', $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

}
