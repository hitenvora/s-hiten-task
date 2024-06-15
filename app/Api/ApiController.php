<?php

namespace App\Api;

use App\Api\V1\Controllers\AuthController;
use App\Api\V1\Resources\User\UserDetailResource;
use App\Http\Controllers\Controller;
use App\Models\UserDeviceToken;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    public static int $SUCCESS = 1;
    public static  $ACTIVE = '1';
    public static  $INACTIVE = '0'; 
    public static  $VERIFIED = '1';
    public static  $UNVERIFIED = '0';
    public static $FAIL = 0;
    public static $SUCCESS_STATUS = 200;
    public static $ERROR_STATUS = 400;
    public static $VALIDATION_FAILED_HTTP_CODE = Response::HTTP_BAD_REQUEST;
    public static $UNAUTHORIZED_USER = Response::HTTP_UNAUTHORIZED;
    public static $HTTP_INTERNAL_SERVER_ERROR = 500;
    public static $DEFAULT_PER_PAGE = 10; 
    public static  $YES = '1';
    public static  $NO = '0'; 
   // public static  $ACCEPT_FRIEND_REQUEST = '2';

    public function successFailResponse($message, $status): array
    {
        return [
            "meta" => [
                "status" => $status,
                "message" => __($message)
            ]
        ];
    }

    public function validateRequest($api)
    {
        $version = Request::segment(2);
        $rules = Config::get("api_validations.{$api}.{$version}.rules");

        if (!$rules) {
            $rules = Config::get("api_validations.{$api}.v1.rules");
        }

        $messages = Config::get("api_validations.{$api}.{$version}.messages");
        if (!$messages) {
            $messages = Config::get("api_validations.{$api}.v1.messages");
        }

        if ($rules && $messages) {
            $messages = collect($messages)->map(function ($message) {
                return __($message);
            })->toArray();

            $payload = Request::only(array_keys($rules));

            $validator = Validator::make($payload, $rules, $messages);

            if ($validator->fails()) {
                throw new ValidationException($validator, static::$VALIDATION_FAILED_HTTP_CODE);
                return $this->error($validator->errors()->first(), 400);
            }
        }
    }

    public function successResponseWithMetaData($meta, $data = null, $mainStatus = 200): array
    {
        return [
            "data" => $data,
            "meta" => $meta,
            "statusCode" => $mainStatus
        ];
    }

    // function saveDeviceToken($request, $user)
    // {
    //     if ($request->device_token && $request->device_type) {
    //         $this->validateRequest("device-type");
    //         $saveUserDeviceToken = UserDeviceToken::whereUserId($user->id)->whereDeviceToken($request->device_token)->whereDeviceType($request->device_type)->first();
    //         if (!$saveUserDeviceToken) $saveUserDeviceToken = new UserDeviceToken();
    //         $saveUserDeviceToken->user_id = $user->id;
    //         $saveUserDeviceToken->device_token = $request->device_token;
    //         $saveUserDeviceToken->device_type = $request->device_type;
    //         $saveUserDeviceToken->save();
    //     }
    // }

    function loginResponse($user)
    { 
        return UserDetailResource::make($user)->additional(["meta" =>
            [
                "token" => $token,
                "status" => AuthController::$SUCCESS,
                "message" => __("api.success"),
            ], "statusCode" => 200]);
    }

    public function successFailResponseWithMetaData($message, $status, $statusCode = 200): array
    {
        return [
            "meta" => [
                "status" => $status,
                "message" => __($message)
            ],
            "statusCode" => $statusCode
        ];
    }

    public function listingResponseWithMetaData($resource, $message, $statusCode = 200)
    {
        return $resource->additional([
            "meta" => [
                "status" => ApiController::$SUCCESS,
                "message" => __($message)
            ],
            "statusCode" => $statusCode
        ]);
    }

    public function concatData($resource, $message, $statusCode = 200): array
    {
        return [
            "data" => $resource,
            "meta" => [
                "status" => ApiController::$SUCCESS,
                "message" => __($message)
            ],
            "statusCode" => $statusCode
        ];
    }
}
