@extends('layouts.admin.app')

@section('title', 'Add Article')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Add Article</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('item.store')}}" class="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id"  id="item_id"  value="0">
                    <div class="card-body row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6>Select Brand<span>*</span></h6>
                                <select class="form-control js-example-basic-single mb-2"  name="brand_id" id="brand_id" required>
                                    <option selected disabled value="">Select brand</option>
                                    @foreach($brand as $br)
                                    <option value="{{$br->id}}" {{ ($item->brand_id ?? 0) == $br->id ? 'selected':''  }}>{{$br->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6>Select Category<span>*</span></h6>
                                <select class="form-control js-example-basic-single mb-2"  name="category_id" id="category_id" required>
                                    <option selected disabled value="">Select Category</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}" {{ ($item->category_id ?? 0) == $cat->id ? 'selected':''  }}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6>Select Season<span>*</span></h6>
                                <select class="form-control js-example-basic-single mb-2"  name="season_id" id="season_id" required>
                                    <option selected disabled value="">Select Season</option>
                                    @foreach($season as $sea)
                                    <option value="{{$sea->id}}" {{ ($item->season_id ?? 0) == $sea->id ? 'selected':''  }}>{{$sea->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Min Alert</h6>
                                <input type="number" step="any" name="min_alert" id="min_alert" value="{{ old('min_alert') ?? $item->min_alert ?? 5 }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Max Alert</h6>
                                <input type="number" step="any" name="max_alert" id="max_alert" value="{{ old('max_alert') ?? $item->max_alert ?? 50 }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <h6>Enter Article No<span>*</span></h6>
                                <input type="text" name="article_no" id="article_no" value="{{ old('article_no') }}" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>&nbsp;</h6>
                                <a class="btn btn-primary" onclick="add_article($('#article_no').val())" href="javascript:void(0)">Add Article</a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <fieldset class="border px-md-3 p-2">
                                <legend class="float-none w-auto">Article - Size</legend>
                                <div class="dt-ext table-responsive">
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Article No</td>
                                                {{-- <td>Color</td> --}}
                                                <td>Size</td>
                                                <td>Purchase Price</td>
                                                <td>Sale Price</td>
                                                <td>Bundles in Pcs</td>
                                                <td>Total Quantity</td>
                                                <td>Image</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="get_data_list">
                                            @php
                                                $groups = (isset($item) && $item)
                                                    ? $item->details->groupBy('article_name')
                                                    : collect();   // empty collection
                                            @endphp
                                                @foreach($groups as $articleIndex => $articleGroup)
                                                @php 
                                                    $rowspan = $articleGroup->count();
                                                @endphp

                                                @foreach($articleGroup as $detailIndex => $detail)
                                                    <tr class="sub_row {{ $detailIndex == 0 ? 'item_article_row' : 'item-detail-row' }}" 
                                                        id="{{ $detailIndex == 0 ? 'article_id-'.$detail->id : '' }}" 
                                                        data-article="{{ $articleGroup->first()->id }}">

                                                        {{-- show these only on first row --}}
                                                        <input type="hidden" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][id]" value="{{ $detail->id }}">
                                                        @if($detailIndex == 0)
                                                            <td class="sr" rowspan="{{ $rowspan }}">{{ $loop->parent->iteration }}</td>
                                                            <td rowspan="{{ $rowspan }}">
                                                                <input type="hidden" name="add[{{ $loop->parent->index }}][item_id]" value="{{ $item->id }}">
                                                                <input type="hidden" name="add[{{ $loop->parent->index }}][article_name]" value="{{ $detail->article_name }}">
                                                               
                                                                <small>{{ $detail->article_name }}</small>
                                                            </td>
                                                        @endif

                                                        {{-- detail inputs --}}
                                                        {{-- <td>
                                                           
                                                            <input type="text" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][color]" 
                                                                value="{{ $detail->color }}" class="form-control form-control-sm">
                                                        </td> --}}
                                                        <td><input type="text" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][size]" 
                                                                value="{{ $detail->size }}" class="form-control form-control-sm" readonly></td>
                                                        <td><input type="text" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][purchase_price]" 
                                                                value="{{ $detail->purchase_price }}" class="form-control form-control-sm"></td>
                                                        <td><input type="text" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][selling_price]" 
                                                                value="{{ $detail->selling_price }}" class="form-control form-control-sm"></td>

                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input class="form-control form-control-sm" type="number" step="any" 
                                                                    name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][quantity]" 
                                                                    value="{{ $detail->quantity }}" oninput="recalculate_totals({{ $articleGroup->first()->id }})" placeholder="Quantity">
                                                                @if($detailIndex == 0)
                                                                    <button class="btn btn-outline-success"  onclick="add_more({{ $detail->id }}, {{ $loop->parent->index }})" type="button">+</button>
                                                                @else
                                                                    <button type="button" class="btn btn-outline-danger btn-remove-detail"
                                                                            onclick="remove_more(this,{{ $detail->id }})">-</button>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <input type="number" step="any" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][opening_stock]" 
                                                                value="{{ $detail->opening_stock }}" class="form-control form-control-sm" oninput="recalculate_totals({{ $articleGroup->first()->id }})">
                                                                <span class="f-12"> Bundle: <span class="mutha_text">{{ $detail->mutha }}</span></span>
                                                            <input type="hidden" name="add[{{ $loop->parent->index }}][item_detail][{{ $detailIndex }}][mutha]" 
                                                                value="{{ $detail->mutha }}" class="mutha_input">
                                                            </td>

                                                        @if($detailIndex == 0)
                                                            <td rowspan="{{ $rowspan }}">
                                                                <input type="file" name="add[{{ $loop->parent->index }}][image]" class="form-control form-control-sm">
                                                            @if($item->image ?? 0)
                                                                <a href="{{ asset('uploads/' . $item->image) }}" data-lightbox="product-image">
                                                                    <img src="{{ asset('uploads/' . $item->image) }}" width="60" height="60" style="cursor: pointer;">
                                                                </a>
                                                            @else
                                                                <a href="{{ asset('no_product.jpg') }}" data-lightbox="product-image">
                                                                    <img src="{{ asset('no_product.jpg') }}" width="60" height="60" style="cursor: pointer;">
                                                                </a>
                                                            @endif
                                                               
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">
                                                                <a class="btn btn-danger btn-xs" onclick="remove_article({{ $loop->parent->index }}, {{ $detail->id }}, {{ $item->id }})" href="javascript:void(0)">-</a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach

                                                {{-- totals row --}}
                                                <tr id="total_row_{{$articleGroup->first()->id}}">
                                                    <td colspan="7" class="text-end">TOTAL</td>
                                                    <td>TOTAL BUNDLE: <span id="total_opening_stock_{{$articleGroup->first()->id}}">{{ $articleGroup->sum('opening_stock') }}</span></td>
                                                    <td><span id="total_mutha_{{$articleGroup->first()->id}}">{{ $articleGroup->sum('mutha') }}</span></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mb-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function add_article(article_no){
        if(article_no == ''){
            alert('Please enter article no');
            return false;
        }
        var item_id = $('#item_id').val() || 0;
        var brand_id = $('#brand_id').val() || 0;
        var category_id = $('#category_id').val() || 0;
        var key = $('.sr').length ?? 0;
        if(brand_id == 0 || category_id == 0){
            alert('Please select brand or category');
            return false;
        }
        else{
            $.get("{{route('item.add_article')}}", {article_name: article_no, brand_id: brand_id, category_id: category_id,key:key,item_id:item_id}, function(data){
                if(data == -1){
                    alert('Article already added');
                    return false;
                }
                else if(data == -2){
                    alert('Please select brand | category first');
                    return false;
                }
                else{
                    $('#get_data_list').append(data);
                    $('#article_no').val('');
                }
            });
        }
    };
    $(document).ready(function () {
    // Only listen for Enter on the article_no input
    $('#article_no').on('keydown', function (e) {
        if (e.key === "Enter") {
            e.preventDefault(); // Stop form submission
            const articleNo = $(this).val(); // Get input value
            if (articleNo) {
                add_article(articleNo); // Call your function
            } else {
                alert("Please enter an article number before adding.");
            }
        }
    });
});

    
function add_more(item_detail_id, key){
  $.get("{{ route('item.add_more') }}", { item_detail_id: item_detail_id, key: key }, function(data){
    let count = $('.sub_row[data-article="'+item_detail_id+'"]').length + 1;
    data = data.replace(/\[item_detail]\[\]/g, '[item_detail]['+count+']');
    // unique id for the new row
    const rowId = 'subrow_' + item_detail_id + '_' + Date.now();

    // wrap returned <td> fragments in a <tr> with data-article and an identifying class
    const $tr = $('<tr/>', {
      class: 'sub_row item-detail-row',
      id: rowId,
      'data-article': item_detail_id
    }).html(data);

    const $totalRow = $('#total_row_' + item_detail_id);
    if ($totalRow.length) {
      $totalRow.before($tr);
    } else {
      $('#article_id-' + item_detail_id).after($tr);
    }
    $tr.find('input[name*="[quantity]"]').on('input', function(){
      recalculate_totals(item_detail_id);
    });
    $tr.find('input[name*="[opening_stock]"]').on('input', function(){
      recalculate_totals(item_detail_id);
    });

    // increase rowspan for article header cells
    bumpRowspan(item_detail_id, +1);
    reindex_item_details(item_detail_id);
  }).fail(function(xhr){
    console.error('add_more failed', xhr);
  });
}

// change rowspan on the article header cells
function bumpRowspan(articleId, delta){
  $('#article_id-' + articleId).find('> td[rowspan]').each(function(){
    let cur = parseInt($(this).attr('rowspan')) || 1;
    let next = Math.max(1, cur + delta);
    $(this).attr('rowspan', next);
  });
}

// remove a dynamically added detail row
function remove_more(btn,item_detail_id){
    $.get("{{ route('item.remove_more') }}", { item_detail_id: item_detail_id }, function(data){
        if(data.result == 1){
            $.notify({ title:'Success', message:data.message }, { type:'success', });
        }
        else{
            $.notify({ title:'Failed', message:data.message }, { type:'danger', });  
        }
    })
  // closest row we created
  const $tr = $(btn).closest('tr.item-detail-row');
  if(!$tr.length){
    // fallback: remove nearest tr (defensive)
    $tr = $(btn).closest('tr');
  }
  if(!$tr.length) return;

  const articleId = $tr.data('article') || null;
  recalculate_totals(articleId);
  $tr.remove();

  if(articleId){
    bumpRowspan(articleId, -1);
  } else {
    // best-effort: find previous article row and decrement
    const $prevArticle = $tr.prevAll('tr.item_article_row').first();
    if($prevArticle.length){
      const aid = $prevArticle.attr('id').replace('article_id-','');
      bumpRowspan(aid, -1);
    }
  }
  reindex_item_details(item_detail_id);
}
function remove_article(key,articleId,itemId){
    $.get("{{ route('item.remove_article') }}", { itemId: itemId }, function(data){
        if(data.result == 1){
            $.notify({ title:'Success', message:data.message }, { type:'success', });
        }
        else{
            $.notify({ title:'Failed', message:data.message }, { type:'danger', });  
        }
        
    })
// $(el).parent().parent().remove();

  // remove main article header row
  $('#article_id-' + articleId).remove();

  // remove all appended sub rows for this article
  $('.sub_row[data-article="' + articleId + '"]').remove();

  // remove the total row for this article (if present)
  $('#total_row_' + articleId).remove();
  reindex_articles();

}
function reindex_item_details(articleId){
    $('.sub_row[data-article="'+articleId+'"]').each(function(detailIndex, row){
        $(row).find('input, select, textarea').each(function(){
            let name = $(this).attr('name');
            if(name){
                // enforce sequential 0,1,2... indexes
                name = name.replace(/\[item_detail]\[(?:\d+)?\]/, '[item_detail]['+detailIndex+']');
                $(this).attr('name', name);
            }
        });
    });
}

function reindex_articles(){
  $('tr.item_article_row').each(function(articleIndex){
    const $articleRow = $(this);
    const articleRowId = $articleRow.attr('id') || '';
    const articleId = articleRowId.replace('article_id-','');

    // 1) update visible serial number
    $articleRow.find('td.sr').first().text(articleIndex + 1);

    // 2) update all article-level input/select/textarea names that start with add[OLD]
    $articleRow.find('input[name], select[name], textarea[name]').each(function(){
      let name = $(this).attr('name');
      if(!name) return;
      // replace only the leading add[<num>] part
      name = name.replace(/^add\[\d+\]/, 'add[' + articleIndex + ']');
      $(this).attr('name', name);
    });

    // 3) update onclick handlers located inside the article row that embed the article index
    //    - add_more(<articleId>, oldIndex)  -> update oldIndex
    //    - remove_article(oldIndex, <articleId>, itemId) -> update oldIndex
    $articleRow.find('[onclick]').each(function(){
      let onclick = $(this).attr('onclick') || '';

      // update add_more(<articleId>, <oldIndex>)
      onclick = onclick.replace(
        new RegExp('(add_more\\s*\\(\\s*' + articleId + '\\s*,\\s*)\\d+(\\s*\\))'),
        '$1' + articleIndex + '$2'
      );

      // update remove_article(<oldIndex>, <articleId>, ...)
      onclick = onclick.replace(
        new RegExp('(remove_article\\s*\\(\\s*)\\d+(\\s*,\\s*' + articleId + '\\s*,)'),
        '$1' + articleIndex + '$2'
      );

      $(this).attr('onclick', onclick);
    });

    // 4) update all detail rows for this article to use the new leading add[articleIndex] prefix
    $('.sub_row[data-article="'+articleId+'"]').each(function(detailIndex, row){
      $(row).find('input[name], select[name], textarea[name]').each(function(){
        let name = $(this).attr('name');
        if(!name) return;
        // replace only the leading add[OLD] with add[new]
        name = name.replace(/^add\[\d+\]/, 'add[' + articleIndex + ']');
        $(this).attr('name', name);
      });
    });
  });
}

function reindex_item_details(articleId){
    // find all sub_rows for this article
    $('.sub_row[data-article="'+articleId+'"]').each(function(detailIndex, row){
        $(row).find('input, select, textarea').each(function(){
            let name = $(this).attr('name');
            if(name){
                // fix both [item_detail][X] and [item_detail][] cases
                name = name.replace(/\[item_detail]\[\d*\]/, '[item_detail]['+detailIndex+']');
                $(this).attr('name', name);
            }
        });
    });
}
function recalculate_totals(articleId) {
    let totalOpeningStock = 0;
    let totalMutha = 0;

    $('.sub_row[data-article="'+articleId+'"]').each(function() {
        let quantity = parseFloat($(this).find('input[name*="[quantity]"]').val()) || 0;
        let openingStock = parseFloat($(this).find('input[name*="[opening_stock]"]').val()) || 0;
        let mutha = 0;

        if(quantity > 0){
            mutha = (openingStock / quantity).toFixed(2);
        }

        // Set mutha value in hidden input
        $(this).find('input.mutha_input').val(mutha);
        $(this).find('.mutha_text').text(mutha);

        totalOpeningStock += openingStock;
        totalMutha += parseFloat(mutha);
    });

    totalMutha = totalMutha.toFixed(2);

    $('#total_opening_stock_' + articleId).text(totalOpeningStock);
    $('#total_mutha_' + articleId).text(totalMutha);
}




</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

@endsection