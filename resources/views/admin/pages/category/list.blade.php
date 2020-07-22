@php
    use App\Helps\Template as Template;
    use App\Helps\Highlight as Highlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Name</th>
                <th class="column-title">Status</th>
                <th class="column-title">Show</th>
                <th class="column-title">Style display</th>
                {{-- <th class="column-title">Tạo mới</th> --}}
                {{-- <th class="column-title">Chỉnh sửa</th> --}}
                <th class="column-title">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($items)>0)
                @foreach($items as $key => $item)
                    @php
                        $index           = $key+1;
                        $name            = Highlight::show($item->name,$params,'name');
                        $id              = Highlight::show($item->id,$params,'id');
                        $status          = Template::showStatus($controllerName, $id, $item->status);
                        $isHome          = Template::showIsHome($controllerName, $id, $item->is_home);
                        $styleDisplay    = Template::showStyleDisplay($controllerName, $id, $item->display);
                        // $status          = $item->status;
                        $createdHistory  = Template::showItemHistory($item->created_by, $item->created);
                        $modifiedHistory = Template::showItemHistory($item->modified_by, $item->modified);
                        $btn             = Template::showButton($controllerName, $id);

                    @endphp
                    <tr class="odd pointer">
                        <td class="">{{ $index }}</td>
                        <td width="40%">
                            <p><strong></strong> {!! $name !!}</p>
                        </td>
                        <td >{!! $status !!}</td>
                        <td >{!! $isHome !!}</td>
                        <td >{!! $styleDisplay !!}</td>
                        {{-- <td>
                            {!! $createdHistory !!}
                        </td>
                        <td>
                            {!! $modifiedHistory !!}
                        </td> --}}
                        <td class="last">
                            {!! $btn !!}
                        </td>
                    </tr>
                @endforeach
            @else
                @include('admin.template.list_empty', [ 'colspan' => '7'])
            @endif
            </tbody>
        </table>
    </div>
</div>
