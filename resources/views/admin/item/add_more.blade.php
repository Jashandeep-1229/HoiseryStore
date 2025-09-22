{{-- <td>
    
   
    <input type="text" name="add[{{request()->key}}][item_detail][][color]" placeholder="Color" class="form-control form-control-sm">
</td> --}}
<td>
    <input type="hidden" name="add[{{request()->key}}][item_detail][][id]" value="{{$item_detail->id}}">
    <input type="text" name="add[{{request()->key}}][item_detail][][size]"  oninput="this.value = this.value.toUpperCase()" placeholder="Size" class="form-control form-control-sm">
</td>
<td>
    <input type="text" name="add[{{request()->key}}][item_detail][][purchase_price]"  oninput="this.value = this.value.toUpperCase()" placeholder="Purchase Price" class="form-control form-control-sm">
</td>
<td>
    <input type="text" name="add[{{request()->key}}][item_detail][][selling_price]" placeholder="Sale Price" class="form-control form-control-sm">
</td>
<td>
    <div class="input-group input-group-sm">
        <input class="form-control form-control-sm" type="text"  name="add[{{request()->key}}][item_detail][][quantity]" oninput="recalculate_totals({{$item_detail->id}})"  class="item-detail-{{request()->item_detail_id}}" placeholder="Quantity" aria-label="Quantity" aria-describedby="button-addon2">
        <button type="button" class="btn btn-outline-danger btn-remove-detail"
            onclick="remove_more(this,{{$item_detail->id}})">-</button>
        {{-- <button class="btn btn-outline-danger" id="button-addon2" onclick="remove_more({{$item_detail->id}})" type="button">-</button> --}}
      </div>
</td>
<td>
    <input type="text" name="add[{{request()->key}}][item_detail][][opening_stock]" oninput="recalculate_totals({{$item_detail->id}})"  placeholder="Opening Stock" class="form-control form-control-sm">
    <input type="hidden" name="add[{{request()->key}}][item_detail][][mutha]"  placeholder="Mutha" class="mutha_input">
    <span class="f-12"> Bundle: <span class="mutha_text"></span></span>
</td>