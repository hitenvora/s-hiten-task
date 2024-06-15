<?php



namespace App\Http\Controllers;



use App\Models\CustomerDetails;

use App\Models\User;

use App\Models\job;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;




class CustomerController extends Controller
{

    //

    function customer_profile(Request $request)
    {
        $userData = User::where('id', $request->id)->first();
        $getDetails = CustomerDetails::where('_user_id', $request->id)->get();
        $getDetails->transform(function ($item) {
            $item->username = $item->username ?? "";
            return $item;
        });
        // print_r($userData);
        // print_r($getDetails);exit;
        return view('customer.profile', compact('userData', 'getDetails'));

    }

    function view()
    {

        return view('customer.view');

    }

    function search_customer()
    {

        return view('customer.view');

    }

    function create(Request $request)
    {



        return view('customer.add');



    }

    function del_address_customer(Request $request)
    {

        $data = $request->all();

        CustomerDetails::find($data['id'])->delete();

        return redirect()->back();

    }

    public function removeAC(Request $request)
    {
        DB::table('ac_detail')->where('id', $request->id)->delete();
        return response()->json(['success' => 'Ac Deleted successfully.']);
    }

    function update_customer(Request $request)
    {
        // dd($request->id);


        // $validatedData = $request->validate([
        //     'phone_no' => [
        //         'required',
        //         Rule::unique('users')->ignore($request->id, 'id'), // Assuming you're using the authenticated user's ID
               
        //     ],
        // ], [ 
        //     'phone_no.required' => 'Mobile number is required.', // Error message for required rule
        //     'phone_no.unique' => 'The mobile number has already been taken.', // Error message for unique rule
          
        // ]);

        $data = $request->all();
        // dd($data);
   
        // Ensure 'id' key exists in the $data array before proceeding
        if (isset($data['id'])) {
            $user_id = $data['id'];

            $data_updat = [
                'name' => $data['name'],
                'phone_no' => $data['phone_no'],
                'type' => '3'
            ];

            $affected = DB::table('users')
                ->where('id', $user_id)
                ->update($data_updat);

                
                // foreach ($data['address'] as $key => $value) {
                    //     // if (isset($data['address_id'][$key])) {
            //     //     DB::table('customer_details')->where('id', $data['address_id'][$key])->update([
            //     //         '_user_id' => $user_id,
            //     //         'address' => $data['address'][$key],
            //     //         'location_type' => $data['location_type'][$key],
            //     //         'no_ac' => $data['no_ac'][$key],
            //     //         'pincode' => $data['pincode'][$key],
            //     //         'ac_company' => $data['ac_company'][$key],
            //     //         'no_of_ton' => $data['no_of_ton'][$key],
            //     //         'type' => $data['type'][$key]
            //     //     ]);
            //     // } else {
            //     //     DB::table('customer_details')->insertGetId([
            //     //         '_user_id' => $user_id,
            //     //         'address' => $data['address'][$key],
            //     //         'location_type' => $data['location_type'][$key],
            //     //         'no_ac' => $data['no_ac'][$key],
            //     //         'pincode' => $data['pincode'][$key],
            //     //         'ac_company' => $data['ac_company'][$key],
            //     //         'no_of_ton' => $data['no_of_ton'][$key],
            //     //         'type' => $data['type'][$key]
            //     //     ]);
            //     // }
            //     if (isset($data['address_id'][$key])) {
                //         DB::table('customer_details')->where('id', $data['address_id'][$key])->update([
            //             '_user_id' => $user_id,
            //             'address' => $data['address'][$key],
            //             'location_type' => $data['location_type'][$key],
            //             'no_ac' => $data['no_ac'][$key],
            //             'pincode' => $data['pincode'][$key],
            //             'ac_company' => "N/A",
            //             'no_of_ton' => $data['no_of_ton'][$key],
            //             'type' => $data['type'][$key]
            //         ]);
            //     }      
            // }

            foreach ($data['type'] as $key=> $value) {
                foreach ($data['type'][$key] as $keys => $value) {
                // Check if address_id exists for customer_details table
                if (isset($data['address_id'][$key])) {
                    // Update or insert into customer_details table
                    DB::table('customer_details')->updateOrInsert(
                        ['id' => $data['address_id'][$key]],
                        [
                            '_user_id' => $user_id,
                            'location_type' => $data['location_type'][$key],
                            'address' => $data['address'][$key],
                            'pincode' => $data['pincode'][$key],
                            'no_ac' => "N/A",
                            'ac_company' => "N/A",
                            'no_of_ton' => "N/A",
                            'message' => "N/A",
                            'type' => "N/A",
                            'latlong' => $data['location'][$key],
                        ]
                    );

                    // Update or insert into ac_detail table
                        // if (isset($data['no_ac'][$key]) && is_array($data['no_ac'][$key])) {
                    //     $acCount = count($data['no_ac'][$key]);
                        //     for ($i = 0; $i < $acCount; $i++) {
                    //         DB::table('ac_detail')->updateOrInsert(
                    //             ['address_id' => $data['address_id'][$key], 'id' => $data['acId'][$key][$i]],
                    //             [
                    //                 '_user_id' => $user_id,
                    //                 'no_ac' => $data['no_ac'][$key][$i],
                    //                 'no_of_ton' => $data['no_of_ton'][$key][$i],
                        //                 'message' => $data['message'][$key][$i],
                    //                 'type' => $data['type'][$key][$i],
                    //             ]
                    //         );
                    //     }
                    // }
                    if (isset($data['no_ac'][$key]) && is_array($data['no_ac'][$key])) {
                        $acCount = count($data['no_ac'][$key]);
                        // $i = 0;
                        // // dd($data['no_ac'][$key])

                        // for ($i = 0; $i < $acCount; $i++) {
                            // if (isset($data['no_ac'][$key][$keys]) && $data['no_ac'][$key][$keys] && $keys == 4) {
                            //     dd('hi', $data['no_ac'][$key][$keys], $keys, $key);
                            // }
                            if (isset($data['no_ac'][$key][$keys])) {
                                // if (isset($data['no_ac'][$key][$keys]) && $data['no_ac'][$key][$keys] !== '') {
                                // dd($key);
                                // Check if index $keys exists and is not empty
                                if (isset($data['acId'][$key][$keys]) && $data['acId'][$key][$keys] !== '') {
                                    // dd($key);
                                    DB::table('ac_detail')->updateOrInsert([
                                        'address_id' => $data['address_id'][$key],
                                        'id' => $data['acId'][$key][$keys]
                                    ], [
                                        '_user_id' => $user_id,
                                        'no_ac' => $data['no_ac'][$key][$keys],
                                        'no_of_ton' => $data['no_of_ton'][$key][$keys],
                                        'message' => $data['message'][$key][$keys],
                                        'type' => $data['type'][$key][$keys]
                                    ]);
                                } else {
                                    // dd($key);
                                    // Insert new record
                                    DB::table('ac_detail')->insert([
                                        'address_id' => $data['address_id'][$key],
                                        '_user_id' => $user_id,
                                        'no_ac' => $data['no_ac'][$key][$keys],
                                        'no_of_ton' => $data['no_of_ton'][$key][$keys],
                                        'message' => $data['message'][$key][$keys],
                                        'type' => $data['type'][$key][$keys]
                                    ]);
                                }
                            }
                        // }
                    }

                } else {
                        // dd($data);
                    // Insert new address details
                    // $addressId = DB::table('customer_details')->insertGetId([
                    //     '_user_id' => $user_id,
                    //     'location_type' => $data['location_type'][$key],
                    //     'address' => $data['address'][$key],
                    //     'pincode' => $data['pincode'][$key],
                    //     'no_ac' => "N/A",
                    //     'ac_company' => "N/A",
                    //     'no_of_ton' => "N/A",
                    //     'type' => "N/A",
                    // ]);
                    // // Insert AC details with the corresponding address_id
                    // if (isset($data['no_ac'][$key]) && is_array($data['no_ac'][$key])) {
                    //     $acCount = count($data['no_ac'][$key]);
                    //     for ($i = 0; $i < $acCount; $i++) {
                    //         DB::table('ac_detail')->insert([
                    //             '_user_id' => $user_id,
                    //             'address_id' => $addressId,
                    //             'type' => $data['type'][$key][$i],
                    //             'no_ac' => $data['no_ac'][$key][$i],
                    //             'no_of_ton' => $data['no_of_ton'][$key][$i],
                    //         ]);
                    //     }
                    // }
                }
            }
            }

            if (isset($data['newaddress'])) {
                foreach ($data['newaddress'] as $key => $value) {
                    $addressId = DB::table('customer_details')->insertGetId([
                        '_user_id' => $user_id,
                        'location_type' => $data['newlocation_type'][$key],
                        'address' => $data['newaddress'][$key],
                        'pincode' => $data['newpincode'][$key],
                        'no_ac' => "N/A",
                        'ac_company' => "N/A",
                        'no_of_ton' => "N/A",
                        'message' => "N/A",
                        'type' => "N/A",
                        'latlong' => $data['newlocation'][$key],
                    ]);
                    if (isset($data['newno_ac'][$key]) && is_array($data['newno_ac'][$key])) {
                        $acCount = count($data['newno_ac'][$key]);
                        for ($i = 0; $i < $acCount; $i++) {
                            DB::table('ac_detail')->insert([
                                '_user_id' => $user_id,
                                'address_id' => $addressId,
                                'type' => $data['newtype'][$key][$i],
                                'no_ac' => $data['newno_ac'][$key][$i],
                                'no_of_ton' => $data['newno_of_ton'][$key][$i],
                                'message' => $data['newmessage'][$key][$i],
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('customer.list');
        }
    }


    function del_customer(Request $request)
    {
        $data = $request->all();
        User::find($data['id'])->delete();
        CustomerDetails::where('_user_id', $data['id'])->delete();
        job::where('customer_id', $data['id'])->delete();
        DB::table('ac_detail')->where('_user_id', $data['id'])->delete();
        DB::table('amcs')->where('_user_id', $data['id'])->delete();
        DB::table('amc_address')->where('user_id', $data['id'])->delete();
        DB::table('amc_visit')->where('customerid', $data['id'])->delete();
        DB::table('complaints')->where('_customer_id', $data['id'])->delete();

        return redirect()->back();
    }


    // function del_customer(Request $request, $id)
    // {
    //     $data = $request->all();
    //     dd($request->all());
    //     User::find($id);

    //     CustomerDetails::where('_user_id', $id)->delete();
    //     job::where('customer_id', $id)->delete();
    //     DB::table('ac_detail')->where('_user_id', $id)->delete();
    //     DB::table('amcs')->where('_user_id', $id)->delete();
    //     DB::table('amc_address')->where('user_id', $id)->delete();
    //     DB::table('amc_visit')->where('customerid', $id)->delete();
    //     DB::table('complaints')->where('_customer_id', $id)->delete();

    //     return redirect()->back();
    // }

    function edit_customer(Request $request)
    {

        $data = $request->all();

        // print_r($data);

        $userData = User::find($request->id);

        // print_r($userData);

        $getDetails = CustomerDetails::where('_user_id', $request->id)->get();

        // print_r($getDetails);

        return view('customer.edit', compact('userData', 'getDetails'));

    }





    function create_add(Request $request)
    {
        
        // $validatedData = $request->validate([
        //     'phone_no' => 'required|unique:users,phone_no',
        // ]);
        // $validatedData = $request->validate([
        //     'phone_no' => 'required|unique:users|digits:10',
        // ]);
        

        $data = $request->all();
        // dd($data);
        $user_id = DB::table('users')->insertGetId([
            'name' => $data['name'],
            // 'email' =>$data['email'],
            'phone_no' => $data['phone_no'],
            'type' => '3'

        ]);
        
        if (isset($data['address'])) {
            foreach ($data['address'] as $key => $value) {
                // Insert address details
                $addressId = DB::table('customer_details')->insertGetId([
                    '_user_id' => $user_id,
                    'location_type' => $data['location_type'][$key],
                    'address' => $data['address'][$key],
                    'pincode' => $data['pincode'][$key],
                    'no_ac' => "N/A",
                    'ac_company' => "N/A",
                    'no_of_ton' => "N/A",
                    'message' => "N/A",
                    'type' => "N/A",
                    'latlong' => $data['location'][$key],
                ]);

                // Insert AC details with the corresponding address_id
                if (isset($data['no_ac'][$key]) && is_array($data['no_ac'][$key])) {
                    $acCount = count($data['no_ac'][$key]);
                    for ($i = 0; $i < $acCount; $i++) {
                        DB::table('ac_detail')->insert([
                            '_user_id' => $user_id,
                            'address_id' => $addressId,
                            'type' => $data['type'][$key][$i],
                            'no_ac' => $data['no_ac'][$key][$i],
                            'no_of_ton' => $data['no_of_ton'][$key][$i],
                            'message' => $data['message'][$key][$i],
                        ]);
                    }
                }
            }
        }


        // if (isset($data['address'])) {
        //     foreach ($data['address'] as $key => $value) {
        //         $addressId = DB::table('customer_details')->insertGetId([
        //             '_user_id' => $user_id,
        //             'location_type' => $data['location_type'][$key],
        //             'address' => $data['address'][$key],
        //             'pincode' => $data['pincode'][$key],
        //             'no_ac' => "N/A",
        //             'ac_company' => "N/A",
        //             'no_of_ton' => "N/A",
        //             'type' => "N/A",
        //         ]);
        //         // Insert AC details with the corresponding address_id
        //         $acDetails = [];
        //         $acCount = count($request->input('type'));
        //         for ($i = 0; $i < $acCount; $i++) {
        //             DB::table('ac_detail')->insertGetId([
        //                 '_user_id'=>$user_id,
        //                 'address_id'=>$user_id,
        //                 'type' => $request->input('type')[$i],
        //                 'no_ac' => $request->input('no_ac')[$i],
        //                 'no_of_ton' => $request->input('no_of_ton')[$i],
        //             ]);
        //         }
        //     }
        //     // Insert AC details into ac_detail table
        //     DB::table('ac_detail')->insert($acDetails);
        // }

        // if (isset($data['address'])) {
        //     foreach ($data['address'] as $key => $value) {
        //         $addressId = DB::table('customer_details')->insertGetId([
        //             '_user_id' => $user_id,
        //             'location_type' => $data['location_type'][$key],
        //             'address' => $data['address'][$key],
        //             'pincode' => $data['pincode'][$key],
        //             'no_ac' => "N/A",
        //             'ac_company' => "N/A",
        //             'no_of_ton' => "N/A",
        //             'type' => "N/A",
        //         ]);

        //         // Insert AC details with the corresponding address_id
        //         if (isset($data['type'][$key]) && is_array($data['type'][$key])) {
        //             $acCount = count($data['type'][$key]);
        //             for ($i = 0; $i < $acCount; $i++) {
        //                 DB::table('ac_detail')->insert([
        //                     '_user_id' => $user_id,
        //                     'address_id' => $addressId,
        //                     'type' => $data['type'][$key][$i],
        //                     'no_ac' => $data['no_ac'][$key][$i],
        //                     'no_of_ton' => $data['no_of_ton'][$key][$i],
        //                 ]);
        //             }
        //         }
        //     }
        // }



        // if(isset($data['address']))
        // {
        //     foreach ($data['address'] as $key => $value) {
        //         DB::table('customer_details')->insertGetId([
        //             '_user_id'=>$user_id,
        //             'location_type'=>$data['location_type'][$key],
        //             'address'=>$data['address'][$key],
        //             'pincode'=>$data['pincode'][$key],
        //             'no_ac'=>"N/A",
        //             'ac_company'=>"N/A",
        //             'no_of_ton'=>"N/A",
        //             'type'=>"N/A",
        //         ]);
        //     }
        // }

        // $acDetails = [];
        // $acCount = count($request->input('type'));
        // for ($i = 0; $i < $acCount; $i++) {
        //     DB::table('ac_detail')->insertGetId([
        //         '_user_id'=>$user_id,
        //         'address_id'=>$user_id,
        //         'type' => $request->input('type')[$i],
        //         'no_ac' => $request->input('no_ac')[$i],
        //         'no_of_ton' => $request->input('no_of_ton')[$i],
        //     ]);
        // }

        $request->session()->forget('old_input');
        return redirect()->route('customer.list');



    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $complaints = Complaint::where(function ($query) use ($search) {
            $query->where('_customer_id', 'LIKE', "%$search%")
                ->orWhere('ref_no', 'LIKE', "%$search%");
        })
            ->orWhere('item_description', 'LIKE', "%$search%")
            ->orWhere('remark', 'LIKE', "%$search%")
            ->get();

        return view('complaint.index', compact('complaints', 'search'));
    }



    public function deleteAddress($id)
    {
        try {
            // Find the customer detail record by ID
            $customerDetail = CustomerDetails::findOrFail($id);
        
            // Delete associated AC details
            $ac_details_deleted = DB::table('ac_detail')->where('address_id', $customerDetail->id)->delete();
        
            // Delete the customer detail record
            $customerDetail->delete();
        
            // If deletion is successful, return success response
            return response()->json(['message' => 'Address and associated AC details deleted successfully'], 200);
        } catch (\Exception $e) {
            // If an error occurs during deletion, return error response
            return response()->json(['message' => 'Error deleting address and associated AC details', 'error' => $e->getMessage()], 500);
        }
    }


    public function checkmobile(Request $request)
{
        $email = $request->input('phone_no');
    $exists = User::where('phone_no', $email)->exists();
    return response()->json(['exists' => $exists]);

}






public function checkmobileuserid(Request $request, $id)
{
    
    $phone_no = $request->input('phone_no');
    $user = User::findOrFail($id); // Retrieve the user by ID

    // Check if any user other than the current user has the same phone number
    $exists = User::where('phone_no', $phone_no)
            ->where('id', '!=', $id) // Exclude the current user's ID
            ->exists();

    return response()->json(['exists' => $exists]);
}



}

