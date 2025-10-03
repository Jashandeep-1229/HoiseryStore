<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{$order->order_no ?? ''}}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style type="text/css">
@page {
    size: 72mm auto;
    margin: 0;
}
body {
    margin: 0;
    padding: 0;
    font-size: 11px;
}
footer {
    position: fixed; 
    bottom: 15px; 
    font-size:9px;
    left:0px;
    right:0px;
    text-align: :center;
        }
</style>
</head>
<body>
 <footer style="display:block;text-align:center;">
       <b style="font-family:'DejaVu Sans', Times, serif">Thank you for Purchasing! Please Visit Again!</b><br>
       <b style="text-align:center;font-size:9.5px;margin:0 auto;right:25%;font-family:'DejaVu Sans', Times, serif">Developed By DigitalDarzee</b>
    </footer>
    
 <div id="watermark" style="position: fixed;  left:50%; top:50%;  transform:translate(-50%,-50%); !important;z-index:-100000000;">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('ak_logo.png'))) }}" width="200px;" style="opacity:0.12">
      </div>
      <table style="width: 100%;table-layout: fixed;">
          <tbody> 
              
          <tr style="text-align:center;margin-top:20px;">
              <td style="font-size:20px;font-family:'DejaVu Sans', Times, serif;margin-bottom:-20px;border-bottom:1px dashed black">
                <b style=""><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('ak_logo.png'))) }}" width="100px;" style="opacity:1">
                    <br>
                    <div style="margin-top:-12px">
                    <small style="font-size:12px;">Wholesale in all types of variety</small>
                    </div>
                </b>
                
            </td>
          </tr>
         
          
          
          <tr style="text-align:center">
            <td style="font-size:12px; font-family: 'DejaVu Sans', sans-serif;">
                <b><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('2.png'))) }}" width="12px;">  +91 97790-04200</b><br>
                <b><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('3.png'))) }}" width="12px;">  +91 98764-43000</b><br>
                <b><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('4.png'))) }}" width="12px;"> Clock Tower, Shoe Market, Hotel Heritage Ludhiana</b><br>
             </td>
          </tr>
         
         
          </tbody>
        </table>
        <table style="width: 100%;table-layout: fixed;margin-top:20px">
            <tbody> 
                <tr style="width:100%">
                    <td style="text-transform:uppercase;font-size:12px;font-family:'DejaVu Sans', Times, serif">{{$sale->account->name ?? ''}}</td>
                    <td style="text-align:right;font-size:12px;font-family:'DejaVu Sans', Times, serif">{{date('d M,Y',strtotime($sale->sale_date))}}</td>
                </tr>
            </tbody>
        </table>

      <table style="width: 100%;table-layout: fixed;margin-top:20px">
        <thead> 
            <tr>
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="30%">ARTICLE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" wisth="20%">PRICE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:right; font-size:11px;font-family:'DejaVu Sans', Times, serif" width="22%">QTY</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:right; font-size:11px;font-family:'DejaVu Sans', Times, serif" width="22%">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $total_quantity = 0;
            @endphp
            @foreach($sale->details  as $details)
            <tr>
                @php
                    $articleName = $details->item_detail->article_name ?? '';
                    // keep only digits and dashes
                    $numberOnly = preg_replace('/[^0-9\-]/', '', $articleName);
                @endphp
                <td style="border-bottom:1px dashed #000; font-size:12px;font-family:'DejaVu Sans', Times, serif"> {{ $numberOnly ?? '' }} <br> <small style="font-size:10px;">{{$details->item_detail->category->name ?? ''}}</small></td>
                <td style="border-bottom:1px dashed #000; font-size:12px;font-family:'DejaVu Sans', Times, serif">{{$details->selling_price ?? $details->item_detail->selling_price}}</td>
                <td style="border-bottom:1px dashed #000; font-size:12px; text-align:right;font-family:'DejaVu Sans', Times, serif">{{$details->quantity}}</td>
                <td style="border-bottom:1px dashed #000; font-size:12px; text-align:right;font-family:'DejaVu Sans', Times, serif">{{formatIndianNumberWithoutDecimal($details->quantity * ($details->selling_price ?? $details->item_detail->selling_price))}}</td>
            </tr>
            @php
                $total += $details->quantity * ($details->selling_price ?? $details->item_detail->selling_price);
                $total_quantity += $details->quantity;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif">T. Qty</th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">{{$total_quantity}}</th>
            </tr>
            @if($discount_amount > 0)
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif">Disc</th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{$discount_amount}}</th>
            </tr>
            @endif
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif">T. Amt</th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{formatIndianNumberWithoutDecimal($total - $discount_amount)}}</th>
            </tr>
        </tfoot>
       
    </table>
   
</body>
</html>
