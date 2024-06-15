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
            <div style="width:100% !important;">
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
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #2b303a;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#2b303a;">
            <div style="min-width: 320px; max-width: 900px; display: table-cell; vertical-align: top; width: 900px;">
            <div style="width:100% !important;">
            <!--[if (!mso)&(!IE)]><!-->
            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
            <div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:25px;padding-right:40px;padding-bottom:25px;padding-left:40px;">
            <div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 14px;">
            <p style="font-size: 12px; line-height: 1.2; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 14px; margin: 0;"><span style="color: #95979c; font-size: 16px;font-weight: 600;"><?php echo $username; ?></span><span style="color: #95979c; font-size: 16px;float:right;font-weight: 600;">Potebaki Book</span></p>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            <div style="background-color:transparent;">
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
            <div style="min-width: 320px; max-width: 840px; display: table-cell; vertical-align: top; width: 840px;">
            <div style="width:100% !important;">
            <!--[if (!mso)&(!IE)]><!-->
            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
         
            <div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:40px;padding-bottom:10px;padding-left:40px;">
            <div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
            <p style="font-size: 16px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 19px; margin: 0; margin-top: 20px;"><span><strong><span style="font-size: 30px;"><?php echo $customername; ?></span></strong></span></p>
            <p style="text-align: center;font-size: 16px;line-height: 8px;">Phone Number : <?php echo $mobile; ?></p>
            <p style="text-align: center;font-size: 16px;line-height: 8px;"><?php echo date('d-M-Y', $yrdata1); ?></p>
            </div>
            </div>

            <div align="left" style="padding-top:15px;padding-right:40px;padding-bottom:0px;padding-left:40px;line-height: 32px;">
            <div>
            <table id="default-datatable" style="margin-bottom:20px; width: 100%;"> 
                <thead>  <tr> <th rowspan="1" colspan="1" style="width: 150px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-left: 1px solid #bec0c2; padding:5px 10px; font-size:16px; background: #dddddd;">Date</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px; background: #dddddd;">Details</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px; background: #dddddd;">Debit(-)</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #dddddd;">Credit(+)</th> <th rowspan="1" colspan="1" style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #dddddd;">Balance</th> </tr>  </thead>
                <tbody>
                <?php
                $bal = 0;
                $select = mysql_query("SELECT * FROM add_payment_detail where cusid='".$_REQUEST['cusid']."' and (payment_status = '0' or payment_status = '1') ORDER BY id DESC");
                while ($fetch = mysql_fetch_array($select)) 
                {               
                    $payment_status = $fetch["payment_status"];
                    if($payment_status == "1")
					{
						$cc = $fetch['amount'];
						$creditt += ($fetch['amount']);

						$bal = $bal + $cc;
					}
					else
					{
						$cc = "";
					}
					
					if($payment_status == "0")
					{
						$dd = $fetch['amount'];
						$debitt += ($fetch['amount']);
						$bal = $bal - $dd;
					}
					else
					{
						$dd = "";
					}


				?>

                <tr>
                    <td style="width: 49px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-left: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;"><b><?php echo $fetch["payment_date"]; ?></b></td>
                    <td style="width: 286px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;background-color: #fff8ed;"><?php echo $fetch["description"]; ?></td>
                    <td style="width: 286px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;background-color: #fff8ed;"><?php echo $dd ?></td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;background-color: #efffdc;"><?php echo $cc ?></td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:14px;color: red; font-weight: 600;"><?php echo $bal; ?> Dr</td>
                </tr>
                <tr>
                                
                <?php   } ?>
                    <td colspan="2" style="width: 286px; text-align:left; border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;background: #ddd;font-weight: 600;">Grand Total</td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;font-weight: 600;background: #dddddd;"><?php echo $debitt; ?></td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;font-weight: 600;background: #dddddd;background: #dddddd;"><?php echo $creditt; ?></td>
                    <td style="width: 286px; text-align:left;border-bottom: 1px solid #bec0c2; border-top: 1px solid #bec0c2; border-right: 1px solid #bec0c2; padding:5px 10px; font-size:16px;color: red; font-weight: 600;background: #dddddd;"><?php echo $bal; ?></td>
                </tr>
                </tbody>
            </table>

            </div>
            
            </div>
            <div align="left" style="padding-top:15px;padding-right:40px;padding-bottom:0px;padding-left:40px;line-height: 32px;">
            <div>
            </div>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
            <tbody>
            <tr style="vertical-align: top;" valign="top">
            <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
            <tbody>
            <tr style="vertical-align: top;" valign="top">
            <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
            </tr>
            </tbody>
            </table>
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
            <div style="background-color:transparent;">
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
            <div style="min-width: 320px; max-width: 900px; display: table-cell; vertical-align: top; width: 900px;">
            <div style="width:100% !important;">
            <!--[if (!mso)&(!IE)]><!-->
            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
            <!--<![endif]-->
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            <div style="background-color:transparent;">
            <div style="Margin: 0 auto; min-width: 320px; max-width: 900px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #2b303a;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#2b303a;">
            <div style="min-width: 320px; max-width: 900px; display: table-cell; vertical-align: top; width: 900px;">
            <div style="width:100% !important;">
            <!--[if (!mso)&(!IE)]><!-->
            <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
   
            <div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:20px;padding-right:40px;padding-bottom:30px;padding-left:40px;">
            <div style="line-height: 1.2; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 14px;">
           
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











    <div style="padding: 0px 32px; border: 1px solid #e1dede; border-radius: 6px; box-shadow: 0 3px 10px rgb(69 14 33 / 20%); margin: 30px 70px; background:white;">
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium" style="width: 100%;">Invoice <x-base.button
            class="mr-2 shadow-md"
            variant="primary"
            onclick="printInvoice()" style="background: #2196f3; padding: 10px 20px; color: white; border: 1px solid #2196f3; float: right; font-size: 15px; border-radius: 4px;">
            Print
        </x-base.button></h2>
    </div>
    <!-- BEGIN: Invoice -->
    
    <div class="intro-y box mt-5 overflow-hidden invoice" style="background:white;">
        @php 
        $string = $getJobData->job_category;
        $variableAry=explode(",",$string); 
        @endphp
        <table style=" width: 100%; height: 100%;">
        <tbody>
            <tr>
                <td style="vertical-align: top;">
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px;">
                        <img src="https://demo.vruttiitsolutions.com/sk_logo.jpg" style="width:200px;margin-bottom: 15px;" />
                        <div class="mt-2 text-lg font-medium text-primary">
                            {{ $getJobData->job_ref_no }}
                        </div>
                        <div class="mt-1">{{ date('M d,Y',strtotime($getJobData->created_at)) }}</div>
                    </div>
                </td>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px; float:right;">
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
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 10px 30px;">
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

            <tr>
                <td colspan="2">
                   
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px;">
                        <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Service Detail</div>
                        <div class="overflow-x-auto" style="margin-top:20px;">
                            <x-base.table>
                                <x-base.table.thead>
                                    <x-base.table.tr>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 dark:border-darkmode-400" style="border: 1px solid #ddd;  background: #ddd;">
                                            SERVICE NAME
                                        </x-base.table.th>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;  background: #ddd;">
                                            PRICE
                                        </x-base.table.th>
                                    </x-base.table.tr>
                                </x-base.table.thead>
                                <x-base.table.tbody>
                                    @php  $tptalprice = 0; @endphp
                                    @foreach($variableAry as $value) 
                                        
                                    @php
                                    $price = 0;
                                        $customerDetailscount = DB::table('job_categories')
                                                ->where('category',$value)
                                                ->count();
                                    
                                            if($customerDetailscount > 0)
                                            {
                                                $customerDetailsname = DB::table('job_categories')
                                                ->where('category',$value)
                                                ->first();
                                                $price = $customerDetailsname->price;
                                                if($price == "")
                                                {
                                                    $price = 0;
                                                }

                                                
                                            }
                                            
                                            $tptalprice = $price + $tptalprice;
                                    @endphp
                                

                                    <x-base.table.tr>
                                        <x-base.table.td class="border-b dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                            <div class="whitespace-nowrap font-medium">
                                                {{ $value }}
                                            </div>
                                        </x-base.table.td>
                                    
                                        <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                            {{ $price }}

                                        </x-base.table.td>
                                    
                                    </x-base.table.tr>
                                    @endforeach

                                </x-base.table.tbody>
                            </x-base.table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px 30px 40px;">
                        <div class="mt-10 text-center sm:mt-0 sm:text-left">
                            <div class="text-base text-slate-500" style="color:black;">Payment Type : {{ $getJobData->payment_type }}</div>

                        </div>
                    </div>
                </td>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px 30px 40px; float:right;">
                        <div class="text-center sm:ml-auto sm:text-right">
                            <div class="text-base text-slate-500"  style="color:black;">Total Amount</div>
                            <div class="mt-2 text-xl font-medium text-primary">
                                {{ $tptalprice }}
                            </div>
                            <div class="mt-1">Taxes included</div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
        
    
        <!-- <div class="px-5 py-10 sm:px-16 sm:py-20">
            <div class="overflow-x-auto">
                <x-base.table>
                    <x-base.table.thead>
                        <x-base.table.tr>
                            <x-base.table.th class="whitespace-nowrap border-b-2 dark:border-darkmode-400">
                                PRODUCT NAME
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                QTY
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                PRICE
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                SUBTOTAL
                            </x-base.table.th>
                        </x-base.table.tr>
                    </x-base.table.thead>
                    <x-base.table.tbody>
                        <x-base.table.tr>
                            <x-base.table.td class="border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium">
                                    {{ $getJobData->product }}
                                </div>
                                <div class="mt-0.5 whitespace-nowrap text-sm text-slate-500">
                                    {{ $getJobData->product_model_details }}
                                </div>
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                               1
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                                {{ $getJobData->estimated_cost }}

                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right font-medium dark:border-darkmode-400">
                                {{ $getJobData->estimated_cost }}
                            </x-base.table.td>
                        </x-base.table.tr>

                    </x-base.table.tbody>
                </x-base.table>
            </div>
        </div> -->
       
    </div>
    <!-- END: Invoice -->
    </div>
<style>

@media print {

    body * {
        visibility: hidden;
    }

    .invoice, .invoice * {
        visibility: visible;
    }

    .invoice {
        position: absolute;
        left: 0;
        top: 0;
    }
}

</style>

@endsection

@once
    @push('scripts')
        @vite('resources/js/vendor/tippy/index.js')
    @endpush
@endonce

@once
    @push('scripts')
        @vite('resources/js/layouts/side-menu/index.js')
    @endpush
@endonce
