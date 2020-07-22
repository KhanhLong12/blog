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
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if(count($items)>0)
                @foreach($items as $key => $item)
                    @php
                        $index           = $key+1;
                        $name            = Highlight::show($item->name,$params,'name');
                        $id              = Highlight::show($item->id,$params,'id');
                        $link            = Highlight::show($item->link,$params,'link');
                        $description     = Highlight::show($item->description,$params,'description');
                        $thumb           = Template::showThumb($item->thumb, $item->name);
                        $status          = Template::showStatus($controllerName, $id, $item->status);
                        // $status          = $item->status;
                        $createdHistory  = Template::showItemHistory($item->created_by, $item->created);
                        $modifiedHistory = Template::showItemHistory($item->modified_by, $item->modified);
                        $btn             = Template::showButton($controllerName, $id);

                    @endphp
                    <tr class="odd pointer">
                        <td class="">{{ $index }}</td>
                        <td width="40%">
                            <p><strong>Name:</strong> {!! $name !!}</p>
                            <p><strong>Description:</strong> {!! $description !!}</p>
                            <p><strong>link:</strong> {!! $link !!}</p>
                            {!! $thumb !!}
                        </td>
                        <td >{!! $status !!}</td>
                        <td>
                            {!! $createdHistory !!}
                        </td>
                        <td>
                            {!! $modifiedHistory !!}
                        </td>
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
{{-- <script type="text/javascript">
    $("#myButton").click(function(){
        alert('abc');
    });
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $("#myButton").click(function(e){
        alert('av');
        e.preventDefault();
        $.ajax({

           type:'GET',

           url:{{route($controllerName . '/status', ['status' => $status, 'id' => $id])}},

           data:{
            status : status
            id : id
        },

           success:function(data){
            if (response == 1) {
                   $.notify('Cập nhật', {align:"right", verticalAlign:"top", close: true, color: "#fff", background: "#4B7EE0"});
            }
                
           }

        });



    }); --}}