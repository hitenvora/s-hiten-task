<?php

namespace App\Api\V1\Controllers;

use App\Api\ApiController;
use App\Api\V1\Resources\Marketplace\Product\FeedbackListResource;
use App\Api\V1\Resources\Marketplace\Product\ProductListResource;
use App\Api\V1\Resources\User\NotificationListResource;
use App\Api\V1\Resources\User\ReportReasonListResource;
use App\Api\V1\Resources\User\UserCommentsResource;
use App\Api\V1\Resources\User\UserDetailResource;
use App\Api\V1\Resources\User\UserLikeResource;
use App\Events\Notification\AddFeedBack;
use App\Events\Notification\AddLike;
use App\Models\Discovery;
use App\Models\Event;
use App\Models\FeedbackImage;
use App\Models\ModuleType;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Report;
use App\Models\ReportReason;
use App\Models\User;
use App\Models\UserComment;
use App\Models\UserCommentLike;
use App\Models\UserDeviceToken;
use App\Models\UserFavouriteList;
use App\Models\UserFeedbacks;
use App\Models\UserLike;
use App\Models\UserRating;
use App\Traits\CommonCodeTrait;
use App\Traits\File;
use App\Traits\UserTraits;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;


class UserController extends ApiController
{
    use ApiResponseHelpers, File ,UserTraits ,CommonCodeTrait;

    /* public function __construct()
      {
          $this->middleware('auth:api');
      }*/


    public function changePassword(Request $request)
    {
        $this->validateRequest('change-password');
        $user = User::whereId(auth()->user()->id)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$user) return $this->successFailResponse('api.user_not_found', ApiController::$FAIL);
        if (Hash::check($request->old_password, $user->password) == false) return $this->successFailResponseWithMetaData('api.old_password_wrong', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->successFailResponseWithMetaData('api.password_update_successfully', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
    }

    /**
     * @param Request $request
     * @return array|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function notificationList(Request $request)
    {
        $this->validateRequest('notification-list');
        $per_page = $request->per_page ? $request->per_page : ApiController::$DEFAULT_PER_PAGE;

        $checkModuleType = ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $userId = auth()->user()->id;
        $notifications = Notification::whereToId($userId)->orderByDesc('id')->whereModuleType($request->module_type);

        //update is read status
        $notificationIds = $notifications->pluck('id')->toArray();
        foreach ($notificationIds as $notificationId) {
            $updateIsRead = Notification::whereId($notificationId)->whereIsRead(ApiController::$NO)->first();
            if ($updateIsRead) {
                $updateIsRead->is_read = ApiController::$YES;
                $updateIsRead->save();
            }
        }

        $resource = NotificationListResource::collection($notifications->paginate($per_page));
        return $this->listingResponseWithMetaData($resource, 'api.notification_list', ApiController::$SUCCESS_STATUS);
    }

    /**
     * @param Request $request
     * @return array|array[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userRating(Request $request)
    {
        $this->validateRequest('user-rating');

        $userId = Hashids::connection(User::class)->decode($request->user_id)[0] ?? 0;

        $user = User::whereId($userId)->whereStatus(ApiController::$ACTIVE)->first();
        if ($user) {
            $userRating = UserRating::where('request_id', auth()->user()->id)->where('user_id', $userId)->first();
            if (!$userRating) {
                $userRating = new  UserRating();
                $userRating->request_id = auth()->user()->id;
                $userRating->user_id = $userId;
                $userRating->star = $request->star;
                $userRating->description = $request->description;
                $userRating->save();
                return $this->successFailResponse('api.add_rating_successfully', ApiController::$SUCCESS);
            } else {
                return $this->successFailResponse('api.already_given_rating', ApiController::$FAIL);
            }
        } else {
            return $this->successFailResponse('api.user_not_found', ApiController::$FAIL);
        }
    }

    /**
     * @param $request
     * @return array|int|mixed
     */
   /* public function checkModuleType($request)
    {
        //check module type
        $checkModuleType = ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        if ($request->module_type == ApiController::$DISCOVERY) {

            $requestId = Hashids::connection(Discovery::class)->decode($request->request_id)[0] ?? 0;
            if ($requestId == 0) return $this->successFailResponseWithMetaData('api.discovery_not_found', ApiController::$FAIL);
            $discovery = Discovery::where(['id' => $requestId, 'status' => ApiController::$ACTIVE])->first();
            if (!$discovery) return $this->successFailResponseWithMetaData('api.discovery_not_found', ApiController::$FAIL);
            else return $requestId;

        } elseif ($request->module_type == ApiController::$EVENT) {

            $requestId = Hashids::connection(Event::class)->decode($request->request_id)[0] ?? 0;
            if ($requestId == 0) return $this->successFailResponseWithMetaData('api.event_not_found', ApiController::$FAIL);
            $Event = Event::where(['id' => $requestId, 'status' => ApiController::$ACTIVE])->first();
            if (!$Event) return $this->successFailResponseWithMetaData('api.event_not_found', ApiController::$FAIL);
            else return $requestId;

        } elseif ($request->module_type == ApiController::$MARKETPLACE) {
            $requestId = Hashids::connection(Product::class)->decode($request->request_id)[0] ?? 0;
            if ($requestId == 0) return $this->successFailResponseWithMetaData('api.product_not_found', ApiController::$FAIL);
            $Product = Product::where(['id' => $requestId, 'status' => ApiController::$ACTIVE, 'is_sold' => ApiController::$NO])->first();
            if (!$Product) return $this->successFailResponseWithMetaData('api.product_not_found', ApiController::$FAIL);
            else return $requestId;
        } else {
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }
    }*/

    /**
     * @param Request $request
     * @return array|array[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addRemoveLike(Request $request)
    {
        $this->validateRequest('add-remove-like');

        //it will chek because of getting two types of response array and integer in return
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        $Product = Product::where(['id' => $requestId, 'status' => ApiController::$ACTIVE, 'is_sold' => ApiController::$NO])->first();
        if (!$Product) return $this->successFailResponseWithMetaData('api.product_not_found', ApiController::$FAIL);

        $addLike = UserLike::whereUserId(auth()->user()->id)->where('request_id', $requestId)->whereModuleType($request->module_type)->first();
        if ($addLike) {
            if ($addLike->is_like == 1 && $request->is_like == ApiController::$YES) return $this->successFailResponseWithMetaData('api.already_liked', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
            elseif ($addLike->is_like == 0 && $request->is_like == ApiController::$NO) return $this->successFailResponseWithMetaData('api.already_disliked', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }else{
            if($request->is_like == ApiController::$NO) return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
            $addLike = new UserLike();
        }
        try {
            DB::beginTransaction();
            $addLike->user_id = auth()->user()->id;
            $addLike->request_id = $requestId;
            $addLike->is_like = $request->is_like;
            $addLike->module_type = $request->module_type;
            $addLike->save();
            DB::commit();
            if ($addLike->is_like == ApiController::$YES){
                if(auth()->user()->id != $Product->user_id){
                    event(new AddLike(ApiController::$ADD_LIKE,auth()->user()->id,$Product->user_id,$requestId,$request->module_type));
                }
                return $this->successResponseWithMetaData(['status' => ApiController::$SUCCESS, 'message' => __('api.like')], ["isLike" => 1,'likeCount'=> $Product->likes->count()]);
            }
            else {
                $notification = Notification::whereFromId(auth()->user()->id)->whereToId($Product->user_id)->whereType(ApiController::$ADD_LIKE)->first();
                if($notification) $notification->delete();
                return $this->successResponseWithMetaData(['status' => ApiController::$SUCCESS, 'message' => __('api.dislike')], ["isLike" => 0,'likeCount'=> $Product->likes->count()]);
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function likeKList(Request $request)
    {
        $this->validateRequest('user-like-list');
        $per_page = $request->per_page ? $request->per_page : ApiController::$DEFAULT_PER_PAGE;

        //it will chek because of getting two types of response array and integer in return
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        if ($request->module_type == ModuleType::$MARKETPLACE) {
            $Product = Product::where(['id' => $requestId, 'status' => ApiController::$ACTIVE, 'is_sold' => ApiController::$NO])->first();
            if (!$Product) return $this->successFailResponseWithMetaData('api.product_not_found', ApiController::$FAIL);
            $likeList = UserLike::whereRequestId($requestId)
                ->whereModuleType($request->module_type)
                ->whereIsLike(ApiController::$YES)
                ->whereHas('user', function ($query){
                    $query->whereStatus(ApiController::$ACTIVE);
                })->orderByDesc('id');
            $resource = UserLikeResource::collection($likeList->paginate($per_page));
            return $this->listingResponseWithMetaData($resource, 'api.likes_list', ApiController::$SUCCESS_STATUS);

        } else {
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function userDetail(Request $request)
    {

        if ($request->user_id) {
            //it will chek because of getting two types of response array and integer in return
            if (gettype($this->checkUser($request)) == 'array') return $this->checkUser($request);
            $userId = $this->checkUser($request)->id;
        } else {
            $userId = checkAuthUserId($request);
        }

        $user = User::whereId($userId)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$user) return $this->successFailResponseWithMetaData('api.user_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $data = UserDetailResource::make($user);
        return $this->successResponseWithMetaData([
            'status' => ApiController::$SUCCESS,
            'message' => __('api.user_details')
        ], $data);
    }

    /**
     * @param Request $request
     * @return array|array[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeNotificationStatus(Request $request)
    {
        $this->validateRequest('change-notification-status');
        $user = User::whereId(\auth()->user()->id)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$user) return $this->successFailResponseWithMetaData('api.inactive_user', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        if ($user->notification_status == ApiController::$ACTIVE && $request->notification_status == ApiController::$ACTIVE) return $this->successFailResponseWithMetaData('api.status_activated_already', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        if ($user->notification_status == ApiController::$INACTIVE && $request->notification_status == ApiController::$INACTIVE) return $this->successFailResponseWithMetaData('api.status_inactivated_already', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        $user->notification_status = $request->notification_status;
        $user->save();
        return $this->successFailResponseWithMetaData('api.notification_status_update', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userPostList(Request $request)
    {
        $this->validateRequest('list');
        $per_page = $request->per_page ?? ApiController::$DEFAULT_PER_PAGE;

        //check module type
        $checkModuleType = ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        if ($request->user_id) {
            if (gettype($this->checkUser($request)) == 'array') return $this->checkUser($request);
            $userId = $this->checkUser($request)->id;

        } else {
            $userId = checkAuthUserId($request);
        }

         return $this->moduleWiseData($request,$userId,$per_page);

    }

    public function editProfile(Request $request)
    {
        $this->validateRequest('edit-profile');

        $user = User::whereId(\auth()->user()->id)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$user) return $this->successFailResponseWithMetaData('api.user_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        try {
            DB::beginTransaction();
            //check email already exist or not
            $findEmail = User::whereEmail($request->email)->where('id', '!=', \auth()->user()->id)->whereStatus(ApiController::$ACTIVE)->first();
            if ($findEmail) return $this->successFailResponseWithMetaData('api.email_exist', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->country_code = $request->country_code;
            $user->mobile_number = $request->mobile_number;
            $user->bio = $request->bio;

            //save user location
            saveLocation($request, $user);

            $profile_image = $request->file('image');
            if ($profile_image) {
                $oldProfileImage = $user->profile_image;
                if ($oldProfileImage) {
                    //Delete image if it exists and upload new image
                    Storage::disk(config('filesystem.storage_type'))->delete('public/uploads/user_image/' . $oldProfileImage);
                }
                $uploadFile = $this->upload($profile_image, config('filesystems.upload.user_image'));
                $user->profile_image = $uploadFile['name'];
            }
            $user->save();
            DB::commit();
            $data = UserDetailResource::make($user);
            return $this->successResponseWithMetaData([
                'status' => ApiController::$SUCCESS,
                'message' => __('api.profile_updated')
            ], $data);

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function userComment(Request $request)
    {

        $this->validateRequest('add-user-comment');

        //check module type
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        //parent comment
        if ($request->parent_id) {
            $parentID = Hashids::connection(UserComment::class)->decode($request->parent_id)[0] ?? 0;
            if ($parentID == 0) return $this->successFailResponseWithMetaData('api.comment_not_found', ApiController::$FAIL,ApiController::$SUCCESS_STATUS);
        } else {
            $parentID = 0;
        }

        //Main comment
        if ($request->main_comment_id) {
            $mainCommentId = Hashids::connection(UserComment::class)->decode($request->main_comment_id)[0] ?? 0;
            if ($mainCommentId == 0) return $this->successFailResponseWithMetaData('api.comment_not_found', ApiController::$FAIL,ApiController::$SUCCESS_STATUS);
        } else {
            $mainCommentId = 0;
        }

        $userComment = new UserComment();
        $userComment->request_id = $requestId;
        $userComment->module_type = $request->module_type;
        $userComment->user_id = \auth()->user()->id;
        $userComment->comment = $request->comment;
        $userComment->parent_id = $parentID;
        $userComment->main_comment_id = $mainCommentId;
        $userComment->save();
        return $this->successFailResponseWithMetaData('api.comment_added', ApiController::$SUCCESS,ApiController::$SUCCESS_STATUS);
    }

    public function userCommentLike(Request $request)
    {
        $this->validateRequest('user-comment-like');

        $commentId = Hashids::connection(UserComment::class)->decode($request->comment_id)[0] ?? 0;
        if ($commentId == 0) return $this->successFailResponseWithMetaData('api.comment_not_found', ApiController::$FAIL,ApiController::$SUCCESS_STATUS);
        $userCommentLike = UserCommentLike::whereUserId(auth()->user()->id)->whereCommentId($commentId)->first();
        if (!$userCommentLike) {
            $userCommentLike = new UserCommentLike();
            $userCommentLike->comment_id = $commentId;
            $userCommentLike->user_id = auth()->user()->id;
            $userCommentLike->save();
            return $this->successFailResponseWithMetaData('api.like', ApiController::$SUCCESS,ApiController::$SUCCESS_STATUS);
        } else {
            $userCommentLike->delete();
            return $this->successFailResponseWithMetaData('api.dislike', ApiController::$SUCCESS,ApiController::$SUCCESS_STATUS);
        }
    }

    public function userCommentList(Request $request)
    {

        $this->validateRequest('user-comment-list');
        $per_page = $request->per_page ?? ApiController::$DEFAULT_PER_PAGE;

        //check module type
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        $commentList = UserComment::whereRequestId($requestId)->whereModuleType($request->module_type)->whereParentId(0)->orderByDesc('id');
        $resource = UserCommentsResource::collection($commentList->paginate($per_page));
        return $this->listingResponseWithMetaData($resource, 'api.report_reason_list', ApiController::$SUCCESS_STATUS);
    }

    public function addReport(Request $request)
    {
        $this->validateRequest('add-report');

        //check module type
        $checkModuleType = ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        //check  report reason
        $reasonId = Hashids::connection(ReportReason::class)->decode($request->reason_id)[0] ?? 0;
        if ($reasonId == 0) return $this->successFailResponseWithMetaData('api.reason_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $reportReason = ReportReason::whereId($reasonId)->whereModuleType($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$reportReason) return $this->successFailResponseWithMetaData('api.reason_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        //check module type
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        try {
            DB::beginTransaction();
            $addReport = new Report();
            $addReport->reason_id = $reportReason->id;
            $addReport->user_id = \auth()->user()->id;
            $addReport->request_id = $requestId;
            $addReport->module_type = $request->module_type;
            $addReport->message = $request->message;
            $addReport->save();
            DB::commit();
            return $this->successFailResponseWithMetaData('api.add_report_successfully', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reportReasonList(Request $request)
    {
        $this->validateRequest('report-reason-list');

        //check module type
        $checkModuleType = ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if (!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $reportReasonList = ReportReason::whereStatus(ApiController::$ACTIVE)->whereModuleType($request->module_type)->get();
        $resource = ReportReasonListResource::collection($reportReasonList);
        return $this->listingResponseWithMetaData($resource, 'api.report_reason_list', ApiController::$SUCCESS_STATUS);

    }

    public function userList()
    {
        $userList = User::whereStatus(ApiController::$ACTIVE)->whereIsVerified(ApiController::$YES);
        $resource = UserDetailResource::collection($userList->get());
        return $this->listingResponseWithMetaData($resource, 'api.user_list', ApiController::$SUCCESS_STATUS);

    }

    public function addFeedback(Request $request)
    {
        $this->validateRequest('add-feedback');

        //it will chek because of getting two types of response array and integer in return
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);

        if($request->module_type == ApiController::$DISCOVERY){
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }
        elseif($request->module_type == ApiController::$EVENT){
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        } elseif($request->module_type == ApiController::$MARKETPLACE){
            $getProduct  = Product::whereId($requestId)->first();
            if($getProduct->user){
                $user = User::whereId($getProduct->user->id)->whereStatus(ApiController::$ACTIVE)->first();
                if(!$user) return $this->successFailResponseWithMetaData('api.user_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
                $userId = $user->id;
            }
        }else{
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }

       // if($userId == auth()->user()->id) return $this->successFailResponseWithMetaData('api.same_user_id', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        $userFeedBack = UserFeedbacks::whereRequestId($requestId)->whereModuleType($request->module_type)->whereUserId(auth()->user()->id)->first();
        if ($userFeedBack) return $this->successFailResponseWithMetaData('api.already_feedback', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        try {
            DB::beginTransaction();
            $userFeedBack = new  UserFeedbacks();
            $userFeedBack->user_id = auth()->user()->id;
            $userFeedBack->request_id = $requestId;
            $userFeedBack->module_type = $request->module_type;
            $userFeedBack->review = $request->review;
            $userFeedBack->rate = $request->rate;
            $userFeedBack->save();

            $imagesArray = $request->file('feedback_images');
            if ($imagesArray) {
                if (count($imagesArray) > 0) {
                    foreach ($imagesArray as $image) {
                        $feedBackImage = new FeedbackImage();
                        $feedBackImage->feedback_id = $userFeedBack->id;
                        $image = $this->upload($image, config('filesystems.upload.feedback_image'));
                        $feedBackImage->image = $image['name'];
                        $feedBackImage->save();
                    }
                }
            }
            DB::commit();
            if($userId != auth()->user()->id){
                event(new AddFeedBack(ApiController::$ADD_FEEDBACK,auth()->user()->id,$userId,$requestId,$request->module_type,$userFeedBack->id,$userFeedBack->hash_id));
            }
            return $this->successFailResponseWithMetaData('api.feedback_added', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function feedbackList(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : ApiController::$DEFAULT_PER_PAGE;
        if($request->user_id){

            if (gettype($this->checkUser($request)) == 'array') return $this->checkUser($request);
            $user = $this->checkUser($request);

            //get user products
            $productIds = $user->products()->pluck('id')->toArray();
            $feedBackList = UserFeedbacks::whereIn('request_id',$productIds)
                ->whereModuleType(ApiController::$MARKETPLACE)
                ->whereHas('user', function ($query){
                    $query->whereStatus(ApiController::$ACTIVE);
                })
                ->whereHas('product', function ($query){
                    $query->whereStatus(ApiController::$ACTIVE);
                })->orderByDesc('id');
        }else{
            $this->validateRequest('feedback-list');
            $this->checkModuleType($request);
            //it will chek because of getting two types of response array and integer in return
            if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
            $requestId = $this->checkModuleType($request);

            $feedBackList = UserFeedbacks::whereRequestId($requestId)
                ->whereModuleType($request->module_type)
                ->whereHas('user', function ($query){
                    $query->whereStatus(ApiController::$ACTIVE);
                })
                ->whereHas('product', function ($query){
                    $query->whereStatus(ApiController::$ACTIVE);
                })->orderByDesc('id');
        }

        $resource = FeedbackListResource::collection($feedBackList->paginate($per_page));
        return $this->listingResponseWithMetaData($resource, 'api.list_of_feedbacks', ApiController::$SUCCESS_STATUS);
    }

    public function feedbackDetails(Request $request)
    {
        $this->validateRequest('feedback-details');

        $feedBackId = Hashids::connection(UserFeedbacks::class)->decode($request->feedback_id)[0] ?? 0;
        if ($feedBackId == 0) return $this->successFailResponseWithMetaData('api.feedback_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);

        $feedBack = UserFeedbacks::whereId($feedBackId)->first();
        if ($feedBack) {
            $data = FeedbackListResource::make($feedBack);
            return $this->successResponseWithMetaData([
                'status' => ApiController::$SUCCESS,
                'message' => __('api.feedback_details')
            ], $data);
        } else {
            return $this->successFailResponseWithMetaData('api.feedback_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }
    }


    /**
     * @param Request $request
     * @return array|array[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addToFavourite(Request $request)
    {
        $this->validateRequest('add-to-favourite');
        $this->checkModuleType($request);
        //it will chek because of getting two types of response array and integer in return
        if (gettype($this->checkModuleType($request)) == 'array') return $this->checkModuleType($request);
        $requestId = $this->checkModuleType($request);
        $addToFavourite = UserFavouriteList::whereUserId(auth()->user()->id)->whereModuleType($request->module_type)->whereRequestId($requestId)->first();
        try {
            DB::beginTransaction();
            if ($addToFavourite) {
                $addToFavourite->is_fav = $request->is_fav;
                $addToFavourite->save();
            } else {
                if ($request->is_fav != '0') {
                    $addToFavourite = new UserFavouriteList();
                    $addToFavourite->user_id = auth()->user()->id;
                    $addToFavourite->request_id = $requestId;
                    $addToFavourite->is_fav = $request->is_fav;
                    $addToFavourite->module_type = $request->module_type;
                    $addToFavourite->save();
                } else {
                    return $this->successFailResponseWithMetaData('api.product_removed_to_favourite_list', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
                }
            }
            DB::commit();
            if ($addToFavourite->is_fav == ApiController::$NO) return $this->successFailResponseWithMetaData('api.product_removed_to_favourite_list', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
            return $this->successFailResponseWithMetaData('api.product_added_to_favourite_list', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->successFailResponseWithMetaData('api.something_wrong', ApiController::$FAIL, ApiController::$HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function favouriteList(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : ApiController::$DEFAULT_PER_PAGE;
        $this->validateRequest('favourite-list');
        //check module type
        $checkModuleType =  ModuleType::whereId($request->module_type)->whereStatus(ApiController::$ACTIVE)->first();
        if(!$checkModuleType) return $this->successFailResponseWithMetaData('api.module_type_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        $userId = checkAuthUserId($request);
        $latitude = checkLatitude($request);
        $longitude = checkLongitude($request);

        if ($request->module_type == ModuleType::$MARKETPLACE) {
            $userFavoriteProduct = UserFavouriteList::whereUserId($userId)
                ->whereIsFav(ApiController::$YES)
                ->whereModuleType(ModuleType::$MARKETPLACE)->pluck('request_id')->toArray();
            $products = distance($latitude,$longitude)->whereIn('products.id', $userFavoriteProduct);

            $resource = ProductListResource:: collection($products->orderByDesc('created_at')->paginate($per_page));
            return $this->listingResponseWithMetaData($resource, 'api.favourite_list', ApiController::$SUCCESS_STATUS);
        } else {
            return $this->successFailResponseWithMetaData('api.no_data_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
        }

    }

    public function logOut(Request $request)
    {
        # Validation
        $this->validateRequest('logout');

        //get device token from auth id
        if ($request->device_token && $request->device_type) {
            if ($request->device_token && $request->device_type) $deviceToken = UserDeviceToken::whereUserId(auth()->user()->id)->whereDeviceToken($request->device_token)->first();
            if (!$deviceToken) return $this->successFailResponseWithMetaData('api.device_token_not_found', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);
            $deviceToken->delete();
        }

        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return $this->successFailResponseWithMetaData('api.success', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);

    }
    public function commentReply(Request $request){
        $this->validateRequest('add-user-comment');
        if ($request->module_type == ApiController::$DISCOVERY) {
            $postId = Hashids::connection(Discovery::class)->decode($request->post_id)[0] ?? 0;
            if ($postId == 0) return $this->successFailResponse('api.discovery_not_found', ApiController::$FAIL);
        } elseif ($request->module_type == ApiController::$EVENT) {
            $postId = Hashids::connection(Event::class)->decode($request->post_id)[0] ?? 0;
            if ($postId == 0) return $this->successFailResponse('api.event_not_found', ApiController::$FAIL);
        }
        $userComment = new UserComment();
        $userComment->post_id = $postId;
        $userComment->user_id = \auth()->user()->id;
        $userComment->comment = $request->comment;
        $userComment->save();
        return $this->successFailResponse('api.comment_added', ApiController::$SUCCESS);
    }

}
