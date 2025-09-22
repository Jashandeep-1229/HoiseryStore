
<tr class="item_article_row" id="article_id-{{$item_detail->id}}" data-article="{{$item_detail->id}}">
    <td class="sr" rowspan="1">{{ request()->key+1 }}</td>
    <td rowspan="1">
        <input type="hidden" data-source="{{$item_detail->barcode_value}}">
        <input type="hidden" name="add[{{request()->key}}][id]" value="0">
        <input type="hidden" name="add[{{request()->key}}][item_id]" value="{{$item_detail->item_id}}">
        <input type="hidden" name="add[{{request()->key}}][item_detail_id]" value="{{$item_detail->id}}">
        <input type="hidden" name="add[{{request()->key}}][article_name]" value="{{$item_detail->article_name}}">
        <small>{{$item_detail->article_name ?? ''}}</small>    <small>{{$item_detail->size ?? ''}}</small>
        <br>{{$item_detail->brand->name ?? ''}}
    
    </td>
    <!-- first detail row -->
    <td> <input type="number" step="any" name="add[{{request()->key}}][selling_price]"  value="{{$item_detail->selling_price}}" class="form-control form-control-sm"> </td>
    <td> <input type="number" step="any" name="add[{{request()->key}}][quantity]" value="{{$item_detail->quantity}}" max="{{$remainingStock->remaining ?? 0}}" oninput="recalculate_totals({{ $item_detail->id }})" class="form-control form-control-sm"> </td>
    

    <td rowspan="1">
        <a class="btn btn-danger btn-xs" onclick="remove_article()" href="javascript:void(0)">-</a>
    </td>
</tr>
