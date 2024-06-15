<!DOCTYPE html>
<html>
<head>
<title>Job Invoice</title>
<script src="{{asset('/js/')}}/html2pdf.bundle.min.js"></script>

<script>
      function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save();
      }
</script>
</head>

<body style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
@php 
        $string = $getJobData->job_category;
        $variableAry=explode(",",$string); 
        @endphp
<div style="background-color:transparent; ">
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin-top: 10px; margin-bottom: 20px;">
            <div style="border-collapse: collapse;display: table;width: 100%;">
            <div style="min-width: 320px; max-width: 900px; display: table-cell; vertical-align: top; width: 900px;">
            <div style="width:100% !important;font-size:28px;">
            Invoice
         <button type="button" class="btn btn-round btn-gradient-orange waves-effect waves-light m-1" name="btn-login" onclick="generatePDF()" style="border-radius: 5px; font-size: 16px; width: 15%;float: right; border: 1px solid #03A9F4; background: #03A9F4; padding: 10px; color: white;">Print </button>

            </div>
            </div>
            </div>
            </div>
            </div>


<div id="invoice">
            <table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
            <tbody>
            <tr style="vertical-align: top;" valign="top">
            <td style="word-break: break-word; vertical-align: top;" valign="top">

            <div style="background-color:transparent;">
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;margin-bottom: 42px;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <div style="min-width: 320px; max-width: 840px; display: table-cell; vertical-align: top; width: 840px;">
            <div style="width:100% !important;">
            <!--[if (!mso)&(!IE)]><!-->
            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
         
            <div align="left" style="padding-top:15px;padding-right:40px;padding-bottom:0px;padding-left:40px;line-height: 32px;">
            <div>
            <table style="margin-bottom:20px; width: 100%;"> 
                <tbody>
                <tr>
                   <td>
                        <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 0px;">
                            <img src="https://crm.skenterprisehvac.com/sk_logo.jpg" style="width:200px;margin-bottom: 15px;" />
                            <div class="mt-2 text-lg font-medium text-primary">
                                {{ $getJobData->job_ref_no }}
                            </div>
                            <div class="mt-1">{{ date('M d,Y',strtotime($getJobData->created_at)) }}</div>
                        </div>
                   </td>
                   <td>
                        <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 0px; float:right;">
                            <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Client Details</div>
                            <div class="mt-2 text-lg font-medium text-primary">
                                {{ $getClientData->name }}
                            </div>
                            <div class="mt-1"><b>Email ID :</b> {{ $getClientData->email }}</div>
                            <div class="mt-1"><b>Mobile No. :</b> {{  $getClientData->phone_no }}.</div>

                            @php  $getDetails=DB::table('customer_details')->where('_user_id',$getClientData->id)->get();
                            @endphp
                            @foreach ($getDetails as $rowDetails)
                            <div class="mt-1"><b>Address :</b> {{  $rowDetails->address }}.</div>
                            @endforeach
                        </div>
                   </td>
                </tr>
                @if ($getJobData->technician_id != '0')
                @php $technicians = DB::table('technicians')->where('id', $getJobData->technician_id)->first();@endphp
                    <tr>
                        <td colspan="2" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                            <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 10px 0px;">
                                <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Technician Details</div>
                                <div class="mt-2 text-lg font-medium text-primary">
                                    {{ $technicians->name }}
                                </div>
                                <div class="mt-1"><b>Mobile No. :</b> {{  $technicians->mobile_no }}.</div>
                                <div class="mt-1"><b>Aadhar No. :</b> {{ $technicians->aadhar_no }}</div>
                                <div class="mt-1"><b>Driving Licence No. :</b> {{ $technicians->driving_license_no }}</div>
                                <div class="mt-1"><b>Address :</b> {{ $technicians->address }}</div>
                            </div>
                        </td>
                    </tr>
                    @endif
                
                </tbody>
            </table>

            </div>
            </div>

            <div align="left" style="padding-top:15px;padding-right:40px;padding-bottom:0px;padding-left:40px;line-height: 32px;">
            <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;color: black; margin-bottom:15px;">Service Detail</div>
            <div>
            <table id="default-datatable" style="margin-bottom:20px; width: 100%;"> 
                <thead>  <tr> <th rowspan="1" colspan="1" style="width: 150px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-left: 1px solid #bec0c2; padding:5px 10px; font-size:16px; background: #dddddd;">SERVICE NAME</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #dddddd;">PRICE</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #dddddd;">QUANTITY</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #dddddd;">TOTAL</th> </tr>  </thead>
                <tbody>
               
                @php  $tptalprice = 0; @endphp
                @foreach($variableAry as $value) 
                                        
                @php
                $price = 0;
                $customerDetailscount = DB::table('job_categories')->where('category',$value)->count();
                                    
                if($customerDetailscount > 0)
                {
                    $customerDetailsname = DB::table('job_categories')->where('category',$value)->first();
                    $price = $customerDetailsname->price;
                    if($price == "")
                    {
                        $price = 0;
                    }                                
                }
                                            
                $tptalprice = $price + $tptalprice;
                @endphp
                @if (count($getJobItem) > 0)
                    @foreach ($getJobItem as $data)  
                    @php
                                                $subcategory = \DB::table('job_subcategories')->where('id',$data->subcategory)->first();
                                            @endphp
                        <tr>
                            <td style="width: 49px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-left: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;"><b>{{ $subcategory->subcategory }}</b></td>
                            <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> {{ $data->price }}</td>
                            <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> {{ $data->quantity }}</td>
                            <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> {{ $data->total }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td style="width: 49px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-left: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;"><b>N/A</b></td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> N/A</td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> N/A</td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"> N/A</td>
                </tr>
                @endif
                @endforeach
                </tbody>
            </table>

            </div>
            
            </div>

            <div align="left" style="padding-top:15px;padding-right:40px;padding-bottom:0px;padding-left:40px;line-height: 32px;">
            <div>
            <table style="margin-bottom:20px; width: 100%;"> 
                <tbody>
                <tr>
                   <td style="vertical-align:top;">
                        <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px;">
                            <div class="mt-10 text-center sm:mt-0 sm:text-left">
                                <div class="text-base text-slate-500" style="color:black;">Payment Type : {{ $getJobData->payment_type }}</div>
                                <div class="text-base text-slate-500 text-primary" style="color:black;">Received Amount : {{ $getJobData->received_amount }}</div>
                            </div>
                        </div>
                   </td>
                   <td style="vertical-align:top;">
                        <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px 30px 40px; float:right;">
                            <div class="text-center sm:ml-auto sm:text-right">
                                <div class="text-base text-slate-500"  style="color:black;">Total Amount</div>
                                <div class="mt-2 text-xl font-medium text-primary" style="font-weight: 700; float: right; font-size: 26px;">
                                    {{ $getJobData->bill_amount }}
                                </div><br>
                                <div class="mt-1">Taxes included</div>
                            </div>
                        </div>
                   </td>
                </tr>
               
                </tbody>
            </table>

            </div>
            </div>

           
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
       
           
            </td>
            </tr>
            </tbody>
            </table>
    </div>
</body>
</html>