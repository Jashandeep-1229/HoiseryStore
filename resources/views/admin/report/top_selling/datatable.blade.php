
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
        @foreach ($querry as $key => $item)
        @php
       
            $color_value = '#e2e0ff';
        
        @endphp
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->brand_name ?? ''}} <small>({{$item->category_name ?? ''}})</small></td>
            <td>{{$item->article_name ?? ''}} {{$item->size ?? ''}}</td>
          
            <td><b>{{$item->total_out}}</b></td>
           <td>
                <a  href="#" class="btn btn-sm btn-info p-1"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
   
</table>