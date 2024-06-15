<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobCategoryController extends Controller
{
    //


    function category()
    {
        return view('job.category');
    }
    function search_category()
    {
        return view('job.category');
    }
    function add_category(Request $request)
    {
        return view('job.add_category');
    }
    function edit_category(Request $request)
    {
        $data=$request->all();
        $category=JobCategory::find($data['Id']);
        return view('job.edit_category')->with("category",$category)->with("Id",$data['Id']);
    }
    function edit_category_db(Request $request)
    {
        $data=$request->all();
        // print_r($data);

        $db=DB::table('job_categories')->where(['Id'=>$data['Id']])->update(
            [
                "category"=>$data['category'],
                "updated_at"=>date('Y-m-d H:i:s'),
            ]
        );
        if($db)
        {
            return redirect()->route('category');
        }
    }
    function add_category_db(Request $request)
    {
        $data=$request->all();

        $add=DB::table('job_categories')->insertGetId([
                "category"=>$data['category'],
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s'),

        ]);
        if($add)
        {
            return redirect()->route('category');
        }
    }
    function del_category(Request $request)
    {
        $data=$request->all();
        JobCategory::find($data['id'])->delete();
        return redirect()->back();
    }
}
