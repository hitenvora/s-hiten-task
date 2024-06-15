<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use App\Models\JobSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsubcategoryController extends Controller
{
    //


    function subcategory()
    {
        return view('job.subcategory');
    }
    function search_subcategory()
    {
        return view('job.subcategory');
    }
    function add_subcategory(Request $request)
    {
        $category = JobCategory::all();
        return view('job.add_subcategory', compact('category'));
    }
    function edit_subcategory(Request $request,$id)
    {
        $subcategory = JobSubCategory::find($id);
        $category = JobCategory::all();
        return view('job.edit_subcategory',compact('subcategory','category'));
    }
    function edit_subcategory_db(Request $request)
    {
        $data = $request->all();
        $db = DB::table('job_subcategories')->where(['id' => $data['id']])->update(
            [
                "subcategory" => $data['subcategory'],
                "job_category_id" => $data['category'],
                "price" => $data['price'],
            ]
        );
        if ($db) {
            return redirect()->route('subcategory');
        }
    }
    function add_subcategory_db(Request $request)
    {
        $data = $request->all();
        $add = DB::table('job_subcategories')->insertGetId([
            "subcategory" => $data['subcategory'],
            "job_category_id" => $data['category'],
            "price" => $data['price'],
        ]);
        if ($add) {
            return redirect()->route('subcategory');
        }
    }
    function del_subcategory(Request $request)
    {
        $data = $request->all();
        Jobsubcategory::find($data['id'])->delete();
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        // $subcategory = Jobsubcategory::find($request->id);
        // $subcategory->status = $request->status;
        // $subcategory->save();
        $data = $request->all();
        $db = DB::table('job_subcategories')->where(['id' => $data['id']])->update(
            [
                "status" => $data['status'],
            ]   
        );
        return response()->json(['success'=>'Status change successfully.']);
    }
}
