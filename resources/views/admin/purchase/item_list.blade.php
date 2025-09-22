
<tr class="item_article_row" id="article_id-{{$item_detail->id}}" data-article="{{$item_detail->id}}">
    <td class="sr" rowspan="1">{{ request()->key+1 }}</td>
    <td rowspan="1">
        <input type="hidden" name="add[{{request()->key}}][item_id]" value="{{$item->id}}">
        <input type="hidden" name="add[{{request()->key}}][item_detail_id]" value="{{$item_detail->id}}">
        <input type="hidden" name="add[{{request()->key}}][article_name]" value="{{$item_detail->article_name}}">
        <small>{{$item_detail->article_name ?? ''}}</small><br>
        <small>{{$item_detail->size ?? ''}}</small>
    </td>
    <!-- first detail row -->
    <td> <input type="text" name="add[{{request()->key}}][purchase_price]" value="{{request()->purchase_price}}" class="form-control form-control-sm"> </td>
    <td> <input type="text" name="add[{{request()->key}}][selling_price]" value="{{request()->selling_price}}" class="form-control form-control-sm"> </td>
    <td> <input type="text" name="add[{{request()->key}}][quantity]" value="{{request()->quantity}}" oninput="recalculate_totals({{ $item_detail->id }})" class="form-control form-control-sm"> </td>
    <td> 
        <input type="text" name="add[{{request()->key}}][opening_stock]" value="{{request()->opening_stock}}"  oninput="recalculate_totals({{ $item_detail->id }})" class="form-control form-control-sm"> 
        <span class="f-12"> Bundle: <span class="mutha_text">@if(request()->quantity > 0){{ round(request()->opening_stock / request()->quantity, 2)}}@else{{0}}@endif</span></span>
        <input type="hidden" name="add[{{request()->key}}][mutha]"  value="@if(request()->quantity > 0){{ round(request()->opening_stock / request()->quantity, 2)}}@else{{0}}@endif" class="mutha_input">
    </td>

    <td rowspan="1">
        <a class="btn btn-danger btn-xs" onclick="remove_article({{request()->key}},{{$item_detail->id}},{{$item->id}})" href="javascript:void(0)">-</a>
    </td>
</tr>
