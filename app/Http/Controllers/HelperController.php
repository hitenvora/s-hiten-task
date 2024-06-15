<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Helper;

class HelperController extends Controller
{
    //
    public function helper()
    {
        return view('helper.index');
    }

    public function search_helper()
    {
        return view('helper.index');
    }
    
    public function add(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required|unique:helper',
            'aadhar_no' => 'required|unique:helper',
            'license_no' => 'required|unique:helper',
            'dob' => 'required',
            'doj' => 'required',
            'address' => 'required',
        ]);
        $name = $request->name;
        $mobile_number = $request->mobile_number;
        $aadhar_no = $request->aadhar_no;
        $birthdate = $request->dob;  
        $joindate = $request->doj;  
        $license_no = $request->license_no;  
        $address = $request->address;
    


    
        $obj = new Helper();
        $obj->name = $name;
        $obj->mobile_number = $mobile_number;
        $obj->aadhar_no = $aadhar_no;
        $obj->birthdate = $birthdate;
        $obj->joindate = $joindate; 
        $obj->license_no = $license_no;
        $obj->address = $address;
        $obj->save();
    
        return redirect()->route('helper');
    }
    
    public function create()
     {
         return view('helper.create-helper');
     }

     public function editProfile(Request $request)
    {

        $helper = Helper::where('id',$request->id)->first();
        return view('helper.edit', compact('helper'));
    }

    public function updateProfile(Request $request)
    {   $name = $request->name;
        $mobile_number = $request->mobile_no;
        $aadhar_no = $request->aadhar_no;
        $birthdate = $request->dob;  
        $joindate = $request->doj;  
        $license_no = $request->driving_license_no;  
        $address = $request->address;
        $helper = Helper::findOrFail($request->id);
        $helper->name = $name;
        $helper->mobile_number = $mobile_number;
        $helper->aadhar_no = $aadhar_no;
        $helper->birthdate = $birthdate;
        $helper->joindate = $joindate; 
        $helper->license_no = $license_no;
        $helper->address = $address;
        $helper->save();
        return redirect()->route('helper')->with('success','Helper Updated Successfully');
    }

}
