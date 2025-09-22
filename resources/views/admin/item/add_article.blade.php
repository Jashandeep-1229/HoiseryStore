
<tr class="sub_row item_article_row" id="article_id-{{$item_detail->id}}" data-article="{{$item_detail->id}}">
    <td class="sr" rowspan="1">{{ request()->key+1 }}</td>
    <td rowspan="1">
        <input type="hidden" name="add[{{request()->key}}][item_id]" value="{{$item->id}}">
        <input type="hidden" name="add[{{request()->key}}][article_name]" value="{{$item_detail->article_name}}">
        <input type="hidden" name="add[{{request()->key}}][item_detail][0][id]" value="{{$item_detail->id}}"> 
        <small>{{$item_detail->article_name ?? ''}}</small>
    </td>
    <!-- first detail row -->
    {{-- <td> 
      
        <input type="text" name="add[{{request()->key}}][item_detail][0][color]"  oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm"> 
    </td> --}}
    <td> <input type="text" name="add[{{request()->key}}][item_detail][0][size]"  oninput="this.value = this.value.toUpperCase()" class="form-control form-control-sm"> </td>
    <td> <input type="text" name="add[{{request()->key}}][item_detail][0][purchase_price]" class="form-control form-control-sm"> </td>
    <td> <input type="text" name="add[{{request()->key}}][item_detail][0][selling_price]" class="form-control form-control-sm"> </td>

    <td>
        <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" type="text" name="add[{{request()->key}}][item_detail][0][quantity]" oninput="recalculate_totals({{$item_detail->id}})"  placeholder="Quantity">
            <button class="btn btn-outline-success" onclick="add_more({{$item_detail->id}}, {{request()->key}})" type="button">+</button>
        </div>
    </td>
    <td> 
        <input type="text" name="add[{{request()->key}}][item_detail][0][opening_stock]" oninput="recalculate_totals({{$item_detail->id}})"  class="form-control form-control-sm"> 
        <input type="hidden" name="add[{{request()->key}}][item_detail][0][mutha]"  placeholder="Mutha" class="mutha_input">
        <span class="f-12"> Bundle: <span class="mutha_text"></span></span>
    </td>
    <td rowspan="1">
        <input type="file" name="add[{{request()->key}}][image]" class="form-control form-control-sm">
    </td>
    <td rowspan="1">
        <a class="btn btn-danger btn-xs" onclick="remove_article({{request()->key}},{{$item_detail->id}},{{$item->id}})" href="javascript:void(0)">-</a>
    </td>
</tr>
<!-- totals row (always last for that article group) -->
<tr id="total_row_{{$item_detail->id}}">
    <td colspan="7" class="text-end">TOTAL</td>
    <td><span id="total_opening_stock_{{$item_detail->id}}">0</span></td>
    <td><span id="total_mutha_{{$item_detail->id}}">0</span></td>
    <td></td>
</tr>