<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{$order->order_no ?? ''}}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style type="text/css">
@page{
    magin:0;
    padding:0;
}
body{
    margin: -4ex;
    padding: 0;
}
footer {
    position: fixed; 
    bottom: -20px; 
    font-size:10px;
    left:0px;
    right:0px;
    text-align: :center;
        }
</style>
</head>
<body>
 <footer style="display:block;text-align:center;">
       <b>Thank you for Purchasing! Please Visit Again!</b><br>
       <b style="text-align:center;font-size:9px;margin:0 auto;right:25%;">Developed By DigitalDarzee</b>
    </footer>
    
 <div id="watermark" style="position: fixed;  left:50%; top:50%;  transform:translate(-50%,-50%); !important;z-index:-100000000;">
     
    {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('manisa_beaute_co_black.png'))) }}" width="120px;" style="opacity:0.08"> --}}
      </div>
      <table style="width: 100%;table-layout: fixed;">
          <tbody> 
              
          <tr style="text-align:center">
              <td style="font-size:18px;"><b>Aasha Fashion</b></td>
          </tr>
          
          
          <tr style="text-align:center">
              <td style="font-size:18px;"><b>Sale No.: {{$sale->sale_no}}</b></td>
          </tr>
         
          </tbody>
        </table>
        <table style="width: 100%;table-layout: fixed;margin-top:20px">
            <tbody> 
                <tr style="width:100%">
                    <td style="text-transform:uppercase">{{$sale->account->name ?? ''}}</td>
                    <td style="text-align:right">{{date('d M,Y',strtotime($sale->sale_date))}}</td>
                </tr>
            </tbody>
        </table>

      <table style="width: 100%;table-layout: fixed;margin-top:20px">
        <thead> 
            <tr>
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:12px;text-align:left" width="50%">ARTICLE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; font-size:12px;text-align:left">PRICE</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:right; font-size:12px;">QTY</th>
                <th style="border-bottom:1px dashed black; font-weight:bold; text-align:right; font-size:12px;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->details  as $details)
            <tr>
                <td style="border-bottom:1px dashed #000; font-size:11px;">{{$details->item_detail->article_name ?? ''}}</td>
                <td style="border-bottom:1px dashed #000; font-size:11px;">{{$details->selling_price ?? $details->item_detail->selling_price}}</td>
                <td style="border-bottom:1px dashed #000; font-size:11px; text-align:right;">{{$details->quantity}}</td>
                <td style="border-bottom:1px dashed #000; font-size:11px; text-align:right;">{{$details->quantity * ($details->selling_price ?? $details->item_detail->selling_price)}}</td>
            </tr>
            
            @endforeach
        </tbody>
       
    </table>
   
</body>
</html>
