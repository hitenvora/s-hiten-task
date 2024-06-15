@php
//echo $Invoice->name;
    // print_r($user);
    // print_r($Invoice);exit;
@endphp
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>

.td-padding{
    padding: 20px;
}
</style>
</head>
<body>

<table width='100%'>
    <tr>
        <td style="    text-align: center;">
            <img src="{{ public_path('sk_logo.jpg'); }}" style="height:100px;">
        </td>
    </tr>

</table>
<table width='100%'>
    <tr>

        <td style='font-size:50px;'>Invoice</td>
        <td style="    text-align: right;">
            <p style='font-size:20px;'>{{ $user->name }}</p>
            <!--<p style='font-size:10px;'>{{ $user->email }}</p>-->
        </td>
    </tr>
    <tr style="margin-top: 50px;">
        <td  style="margin-top: 50px;">
            <p style='font-size:20px;'>Client Details</p>
            <p style='font-size:10px;'>{{ $Invoice->name }}</p>
            <p style='font-size:10px;'>{{ $Invoice->email }}</p>
            <p style='font-size:10px;'>{{ $Invoice->mobile_no }}</p>
        </td>
        <td style="    text-align: right;">
            <p style='font-size:20px;'>Receipt</p>
            <p  style='font-size:10px;'>#{{ $Invoice->invoice_no }}</p>
            <p  style='font-size:10px;'>{{ date('M d,Y',strtotime($Invoice->created_at)) }}</p>
        </td>

    </tr>

</table>
<br>
<br>
<br>
<table width='100%' border='1' style='border-collapse: collapse;'>
    <tr>
        <td class='td-padding' style="text-align: center;" width='70%'>DESCRIPTION</td>
        <td  style="text-align: center;"class='td-padding'>QTY</td>
        <td  style="text-align: center;"class='td-padding'>PRICE</td>
        <td style="text-align: center;" class='td-padding'>SUBTOTAL</td>
    </tr>
    <tr>
        <td class='td-padding' width='70%'>
            <p style='font-size:20px;'>{{ $Invoice->product }}</p>
            <p  style='font-size:10px;'>{{ $Invoice->product_details }}</p>
        </td>
        <td style="text-align: center;" class='td-padding'>{{ $Invoice->qty }}</td>
        <td style="text-align: center;" class='td-padding'>{{ $Invoice->price }}</td>
        <td style="text-align: center;" class='td-padding'>{{ $Invoice->total }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center;">Total</td>
        <td style="text-align: center;">{{ $Invoice->total }}</td>
    </tr>
</table>
<br><br>
<table width='40%' border='1' style='border-collapse: collapse;'>
    <tr>
        <td>Payment -Type</td>
        <td>{{ $Invoice->payment_type }}</td>
    </tr>
</table>

<br>
<br>
<br>
<div style="font-size:10px; ">
<span><b>Extra Charges</b></span>
<ul>
    <li>Plastic Items</li>
    <li>Air filter</li>
    <li>Sheet Metal Parts</li>
    <li>Condenser &amp; Evaporator Coils</li>
    <li>Remote Control</li>
    <li>Voltage Stabilizers &amp; Scanners</li>
    <li>Circuit breaker</li>
    <li>Thermocol Parts</li>
    <li>Compressor</li>
    <li>Refrigerant gas charging</li>
    <li>Fan Motor</li>
    <li>C.B.</li>
    <li>Magnetic Switch</li>
    <li>Transformer</li>
    </ul>
</div>
<div style="font-size:10px; ">
<span><b>Terms & Conditions</b></span>
<ul>
    <li>In case the customer wants to cancel the contract before the completion of the contract period, there shall be no refund of the charges for unexpired period</li>
    <li>The contract is not transferable in event of resale / gift to any other person and no refund shall be given</li>
    <li>The equipment bought to the service center will remain there at customer risk and the company will not be responsible for any damages caused due to the factors beyond its control</li>

    </ul>
</div>
</body>
</html>


