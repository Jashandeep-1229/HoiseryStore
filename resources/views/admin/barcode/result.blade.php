<style>
    #barcode_bc {
      display: flex;
      flex-direction: column;
      align-items: center; /* Center each barcode horizontally */
      gap: 10px;
    }
    #barcode_bc .barcode-card {
      width: auto; /* Same as col-md-4 */
      min-width: 200px; /* Prevents it from becoming too small */
    }
    .barcode_style div{
      margin:0 auto !important;
    }
  </style>
  
  <div class="card-body mx-auto">
      <a class="btn btn-info btn-sm" onclick="get_print_barcode()">Print</a>
      <div id="barcode_bc">
      @foreach ($item_detail as $key => $item)
        <div class="barcode-card border p-2">
          <div class="row">
            <div class="col-md-3">
              {{ $item->brand->name ?? '' }}
            </div>
            <div class="col-md-9 text-end">
              {{ $item->article_name ?? '' }}
            </div>
            <div class="col-md-12 text-center">
                <h6 style="margin-bottom:0px">{{ $item->article_name }}</h6>
                <div class="text-center barcode_style">
                    {!! DNS1D::getBarcodeHTML($item->barcode_value, 'C128', 1.5, 70) !!}
                </div>
                <h6>{{ $item->barcode_value }}</h6>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  