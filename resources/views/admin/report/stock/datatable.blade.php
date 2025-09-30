
<table class="display" id="basic-test">
    <thead>
        <tr>
            <th class="all">#</th>
            <th class="all">Brand</th>
            <th class="all">Article</th>
            <th class="all">Qty</th>
            <th class="all">View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $key => $item)
        @php
        if($item->classification == 'Zero Stock'){
            $color_value = '#ffe0e0';
        }
        else if($item->classification == 'Alert Stock'){
            $color_value = '#ffffe0';
        }
        else{
            $color_value = '#e2e0ff';
        }
        @endphp
        <tr style="background-color:{{$color_value}}">
            <td>{{++$key}}</td>
            <td>{{$item->item_detail->brand->name ?? ''}} <small>({{$item->item_detail->category->name ?? ''}})</small></td>
            <td>{{$item->item_detail->article_name}} {{$item->item_detail->size ?? ''}}</td>
          
            <td><b>{{formatIndianNumber($item->remaining)}}</b></td>
            <td>
                <a  href="{{route('view_statement',$item->item_detail_id)}}" class="btn btn-sm btn-info p-1"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
   
</table>