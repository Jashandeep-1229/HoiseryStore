<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Image</th>
                <th class="all">Brand</th>
                <th class="all">Category</th>
                <th class="all">Article</th>
                <th class="all">Details</th>
                <th class="all">Barcode</th>
                <th class="all">Status</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item as $key => $list)
            <tr>
                <td>{{ $item->firstItem() + $key }}</td>
                <td>
                    @if($list->image ?? 0)
                    <a href="{{ asset('uploads/' . $list->image) }}" data-lightbox="product-image">
                        <img src="{{ asset('uploads/' . $list->image) }}" width="60" height="60" style="cursor: pointer;">
                    </a>
                @else
                    <a href="{{ asset('no_product.jpg') }}" data-lightbox="product-image">
                        <img src="{{ asset('no_product.jpg') }}" width="60" height="60" style="cursor: pointer;">
                    </a>
                @endif
                </td>
                <td>
                    {{$list->brand->name ?? ''}} <small>({{$list->season->name ?? ''}})</small>
                </td>
                <td>
                    {{$list->category->name ?? ''}}
                </td>
                <td>
                    {{$list->article_name ?? ''}}
                </td>
                <td>
                    @foreach($list->details ?? '[]' as  $xyz => $det)
                    {{$det->size}}
                    
                    @if(!$loop->last)
                    <br>
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($list->details ?? '[]' as  $xyz => $det)
                    <span class="text-primary">{{$det->barcode_value ?? ''}}</span>
                    
                    @if(!$loop->last)
                    <br>
                    @endif
                    @endforeach
                </td>
                <td>
                    <div class="media-body text-start ">
                        <label class="switch">
                          <input type="checkbox" {{$list->status == 1 ? 'checked':''}} onchange="change_status({{$list->id}})"><span class="switch-state"></span>
                        </label>
                      </div>
                </td>
                <td>
                   
                   
                    @if (auth()->user()->role_as == 'Admin')
                    <a href="{{route('item.edit',$list)}}" class="btn btn-warning btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                        <a onclick="delete_article({{$list->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<div class="mt-2">
    {{$item->onEachSide(1)->links()}}
</div>