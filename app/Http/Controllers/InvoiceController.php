<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class InvoiceController extends Controller
{
    //

    function view_pdf(Request $request)
    {
         $getInvoice=invoice::where('id',$request->id)->first();
         $userData=User::where('id',$getInvoice->_created_by)->first();

        $data = ['Invoice' => $getInvoice,"user"=>$userData]; // Sample data to pass to the view


       $pdf = PDF::loadView('invoice.invoice_pdf', $data);
       return $pdf->stream('document.pdf');
    }
    function create_invoice(Request $request)
    {
        return view('invoice.create');
    }
    function add_invoice(Request $request)
    {
        $invoice=new invoice();

        $invoice->invoice_no=$request->invoice_no;
        $invoice->name=$request->name;
        $invoice->email = $request->email;
        $invoice->mobile_no=$request->mobile_no;
        $invoice->product=$request->product;
        $invoice->qty=$request->qty;
        $invoice->price=$request->price;
        $invoice->payment_type=$request->payment_type;
        $invoice->total=$request->total;
        $invoice->product_details=$request->product_details;
        $invoice->_created_by=Auth::user()->id;

        $invoice->save();

       $id= $invoice->id;
       if($id > 0)
       {
            return redirect()->route('view.invoice',$id);
       }
    }
    function view_invoice(Request $request)
    {
        $getInvoice=invoice::where('id',$request->id)->first();
        // echo $request->id;
        return view('invoice.view',compact('getInvoice'));
    }
    function list_invoice()
    {
        $getInvoice=invoice::get();
        // print_r($getInvoice);

        return view('invoice.list',compact('getInvoice'));
    }
}
