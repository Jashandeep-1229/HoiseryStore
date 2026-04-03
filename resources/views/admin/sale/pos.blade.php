<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{$sale->order_no ?? ''}}</title>
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
    text-align: center;
        }
thead {
    display: table-row-group;
}
tr {
    page-break-inside: avoid;
}
</style>
</head>
<body>
 <footer style="display:block;text-align:center;">
       <b style="font-family:'DejaVu Sans', Times, serif">Thank you for Purchasing! Please Visit Again!</b><br>
       <b style="text-align:center;font-size:9.5px;margin:0 auto;right:25%;font-family:'DejaVu Sans', Times, serif">Developed By DigitalDarzee</b>
    </footer>
    
 <div id="watermark" style="position: fixed; left:50%; top:50%; transform:translate(-50%,-50%) !important; z-index:-1000;">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('ak_logo.png'))) }}" width="200px" style="opacity:0.12">
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
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="40%">ARTICLE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:left; font-size:11px;font-family:'DejaVu Sans', Times, serif" width="15%">QTY</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="20%">PRICE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:right; font-size:11px;font-family:'DejaVu Sans', Times, serif" width="25%">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $item_total_sum = 0;
                $total_quantity = 0;
                $item_wise_discount_total = 0;
            @endphp
            @foreach($sale->details as $details)
            @php
                $articleName = $details->item_detail->article_name ?? '';
                $numberOnly = preg_replace('/[^0-9\-]/', '', $articleName);
                
                $selling_price = $details->selling_price ?? $details->item_detail->selling_price;
                $item_discount = $details->discount ?? 0;
                $net_price = $selling_price - $item_discount;
                $line_total = $details->quantity * $net_price;
                
                $item_total_sum += $line_total;
                $total_quantity += $details->quantity;
                $item_wise_discount_total += ($details->quantity * $item_discount);
            @endphp
            <tr>
                <td style="border-bottom:1px dashed #000; font-size:12px;font-family:'DejaVu Sans', Times, serif"> {{ $numberOnly ?? '' }} <br> <small style="font-size:10px;">{{$details->item_detail->category->name ?? ''}}</small></td>
                <td style="border-bottom:1px dashed #000; font-size:12px; text-align:left;font-family:'DejaVu Sans', Times, serif">{{$details->quantity}}</td>
                <td style="border-bottom:1px dashed #000; font-size:12px;font-family:'DejaVu Sans', Times, serif">
                    @if($item_discount > 0)
                        <s style="color: #666; font-size: 10px;">{{formatIndianNumberWithoutDecimal($selling_price)}}</s>
                    @endif
                    {{formatIndianNumberWithoutDecimal($net_price)}}
                </td>
                <td style="border-bottom:1px dashed #000; font-size:12px; text-align:right;font-family:'DejaVu Sans', Times, serif">
                    @if($item_discount > 0)
                        <s style="color: #666; font-size: 10px;">{{formatIndianNumberWithoutDecimal($details->quantity * $selling_price)}}</s><br>
                    @endif
                    {{formatIndianNumberWithoutDecimal($line_total)}}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                // Additional discount = TOTAL_DISCOUNT in DB - sum of item-wise discounts
                // PLUS the Ledger discount amount if any
                $extra_discount = ($sale->total_discount ?? 0) - $item_wise_discount_total;
                if($extra_discount < 0) $extra_discount = 0;
                $total_footer_discount = $extra_discount + $discount_amount;
            @endphp
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%">T. Qty</th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif">{{$total_quantity}}</th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif">T.A</th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{formatIndianNumberWithoutDecimal($item_total_sum)}}</th>
            </tr>
            @if($total_footer_discount > 0)
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%">Disc</th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{formatIndianNumberWithoutDecimal($total_footer_discount)}}</th>
            </tr>
            @endif
            @if($sale->total_tax > 0)
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%">Tax</th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{$sale->total_tax}}</th>
            </tr>
            @endif
            <tr>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif" width="50%">Net Amt</th>
                <th style=" font-weight:bold; font-size:11px;text-align:left;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:10px;text-align:right;font-family:'DejaVu Sans', Times, serif"></th>
                <th style=" font-weight:bold; font-size:11px;text-align:right;font-family:'DejaVu Sans', Times, serif">₹{{formatIndianNumberWithoutDecimal($item_total_sum - $total_footer_discount + $sale->total_tax)}}</th>
            </tr>
        </tfoot>
       
    </table>
   
</body>
</html>
