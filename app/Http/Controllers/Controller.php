<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\{JsonResponse};
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    CONST ERROR_MSG = "Something wrong.!! Please try again.";

    public function modifyErrorMessage($errors) : array {
        $dataArr = [];
        foreach ($errors as $key => $error) {
            $dataArr[$key] = $error[0] ?? '';
        }
        return $dataArr;
    }

    public function getCatchErrorMessage($e) : JsonResponse {
        //\Log::error($e->getMessage());
        return response()->json(["status" => false, 'message' => self::ERROR_MSG,'data' => null], 500);
    }
    public function getValidationErrorMessageAndResponse($messageArr) : JsonResponse
    {
        $errors = [];
        foreach ($messageArr as $key => $message) {
            if (isset($message)) {
                $errors[$key] = $message;
            }
        }

        if (count($errors) === 1) {
            return response()->json([
                "status" => false,
                "message" => Arr::first($errors),
                "data" => $errors
            ], 201);
        }
        return response()->json([
            "status" => false,
            "message" => "Validation errors",
            "data" => $errors
        ], 201);
    }
}
