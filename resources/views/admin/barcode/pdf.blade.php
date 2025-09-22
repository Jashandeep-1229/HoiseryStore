<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Barcode Print</title>
<link rel="icon" href="{{ asset(env('APP_FAVICON')) }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset(env('APP_FAVICON')) }}" type="image/x-icon">
<style>
 @page { size: 281.465pt 140.732pt; margin: 0; }
html, body { margin:8px 0px; padding:0; font-size:0; line-height:0; }

.page {
    width: 281.465pt;
    display: block;
    page-break-after: always;
}

.page:last-child {
    page-break-after: auto;
}

.label {
    font-size:12pt; 
    line-height:1.08;
    width:90mm; 
    box-sizing:border-box; 
    padding:2mm;
    margin:0 auto;
    overflow:hidden; 
    font-weight:700;
}

  table.inner {
    width:100%; border-collapse:collapse; table-layout:fixed;
  }
  td { vertical-align:top; white-space:nowrap; overflow:hidden; }

  .brand { font-size:14px; max-width:50mm; }
  .title { font-size:14px; text-align:right; max-width:36mm; }
  .barcode-wrap { text-align:center; margin-top:1mm; }
  img.barcode { display:block; width:90mm; height:22mm; margin:0 auto; }
  .meta td { font-size:14.5px; }
  .meta .r { text-align:right; }
</style>
</head>
<body>
@php use Illuminate\Support\Str; @endphp

@foreach($item_detail as $item)
  <div class="page">
    <div class="label">
      <table class="inner">
        <tr>
          <td class="brand">{{ $item->brand->name ?? '' }}</td>
          <td class="title" style="text-transform:uppercase">
            {{ $item->size }} | {{ $item->quantity }} Pcs
          </td>
        </tr>
      </table>

      <div class="barcode-wrap">
        <img class="barcode"
             src="data:image/png;base64,{!! DNS1D::getBarcodePNG($item->barcode_value,'C128',1,10) !!}"
             alt="barcode">
      </div>

      <table class="inner meta" style="margin-top:1mm;">
        <tr>
          <td style="text-transform:uppercase;font-size:16px;" colspan="2">{{ Str::limit($item->article_name ?? '', 50) }}</td>
          <td class="r" style="font-size:12px">{{ Str::limit($item->category->name ?? '', 20) }}</td>
        </tr>
      </table>
    </div>
  </div>
@endforeach

</body>
</html>
