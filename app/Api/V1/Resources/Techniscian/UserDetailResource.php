<?php

namespace App\Api\V1\Resources\User;

use App\Api\ApiController;
use App\Api\V1\Resources\Marketplace\Product\ProductListResource;
use App\Models\Country;
use App\Models\FriendRequest;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{

    public function toArray($request)
    {
        //Profile image
        if ($this->profile_image && !empty($this->profile_image)) {
            $profileImage = glide($this->profile_image, config('filesystems.upload.user_image'));
        } else {
            $profileImage = glide('', config('filesystems.upload.user_image'));
        }

        $authUserId = checkAuthUserId($request);

        //chek this  user you follow or not
        $checkFollow = FriendRequest::whereFromUserId($authUserId)->whereToUserId($this->id)->whereIsAccepted(ApiController::$YES)->first();
        if ($checkFollow) $isFollowing = 1;
        else $isFollowing = 0;

        //get country flag
        $getFlag = Country::whereCountryCode($this->country_code)->first();
        if($getFlag){
            $getFlag = glide($getFlag->flag, config('filesystems.upload.country'));
        }else{
            $getFlag = '';
        }

        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? null,
            'profile_image' => $this->profile_image ?asset('technician_images/'.$this->profile_image) : null, 
            'user_name' => $this->user_name ?? null,
            'phoneNumber' => $this->user_name ? $this->user_name :null, 
            'mobile_no' => $this->mobile_no ?? null,
            'aadhar_no' => $this->aadhar_no ?? null,
            'dob'=> $this->dob ?? null,
            'doj' => $this->doj ?? null,
            'totalSoldProducts' => $this->soldproducts ? $this->soldproducts->count() : 0,
            'address' => $this->address ?? null, 
            'status' => $this->status ?? null, 
            'created_at' => $this->created_at ?? null, 
            'updated_at' => $this->updated_at ?? null,  
        ];

    }
}
