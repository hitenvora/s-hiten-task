<?php



namespace App\Api\V1\Controllers;



use App\Api\ApiController;

use App\Api\V1\Resources\User\UserDetailResource;

use App\Jobs\sendOTPInMail;

use App\Models\SocialTokens;

use App\Models\Technician;

use App\Models\User;

use App\Models\UserAddress;

use App\Repositories\UserRepository;

use App\Traits\File;

use F9Web\ApiResponseHelpers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;

use Validator;

use Illuminate\Validation\ValidationException;

class AuthController extends ApiController

{

    use File;



    private $userRepository;







    /**

     * Get a JWT via given credentials.

     *

     * @return \Illuminate\Http\JsonResponse

     */

   public function login(Request $request)
  {
        // try {
    	   // $user = User::where('email', $request->user_name)->first();
     
        //     if (! $user || ! Hash::check($request->password, $user->password)) {
        //         throw ValidationException::withMessages([
        //             'email' => ['The provided credentials are incorrect.'],
        //         ]);
        //     }
            
        //     $token = $user->createToken("android")->plainTextToken;
            
        //     $responseData = [
        //         'userData' => $user,
        //         'token' => $token,
        //     ];
 
        
        //     return response()->json(['success' => true, 'data' => $responseData], 200);
            
        //  } catch (\Exception $e) 
        //  {
        //      return response()->json(['error' => 'Authentication failed'], 500);
        //  }
        
        
    
	    $credentials = $request->only('user_name', 'password');
 
        try {
        
            if (!$token = Auth::guard('api')->attempt($credentials))
            {
                        return response()->json(['error' => 'Invalid credentials'], 401);
            }
    
            $userData = Auth::guard('api')->user();
    
            
            $responseData = [
                'userData' => $userData,
                'token' => $token,
            ];
 
        
            return response()->json(['success' => true, 'data' => $responseData], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => 'Authentication failed'], 500);
        }  

        // if(Auth::guard('api')->attempt($credentials)){ 
        //     $authUser = Auth::guard('api')->user();
        //     $token = $authUser->createToken('MyAuthApp')->plainTextToken;

        //     $responseData = [
        //         'userData' => $authUser,
        //         'token' => $token,
        //     ];
            
        //     return response()->json(['success' => true, 'data' => $responseData], 200);
        // }
        // else
        // {
        //     return response()->json(['error' => 'Authentication failed'], 500);
        // }         
}





}



