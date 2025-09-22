
@forelse($item_detail as $item)
<option value="{{$item->id}}">{{ $item->article_name }}-{{$item->size}}</option>
@empty
@endforelse