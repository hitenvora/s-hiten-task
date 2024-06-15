<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function view_product()
    {
        return view('product.view');
    }

    function search_product()
    {
        return view('product.view');
    }

    function add_form_product()
    {
        return view('product.add');
    }

    function add_product(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|unique:products',

        ]);
        $add=product::create([
            "product_name"=>$request->product_name,
            "product_description"=>$request->product_description,
        ]);
        if($add)
        {
            return redirect()->route('view.product');
        }

    }
    function del_product(Request $request)
    {
        $id=$request->id;

       $del= product::find($id)->delete();
       if($del)
       {
        return redirect()->back();
       }
    }
    function edit_product(Request $request)
    {
        $id=$request->id;
        $product= product::where('id',$id)->first();
        // print_r($product);
        // echo $id;
        return view('product.edit',compact('product','id'));

    }
    function update_product(Request $request)
    {
        $id=$request->id;
       $update=product::where('id',$request->id)->update(
            [
                "product_name"=>$request->product_name,
                "product_description"=>$request->product_description,
            ]
       );
       if($update)
       {
        return redirect()->route('view.product');
       }

    }
}
