@php
    $totalItems = $items->total();
    $totalPage = $items->lastpage();
@endphp


<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">Tổng số phần tử : <span class="label label-info label-pagination">{{ $totalItems }}</span> &nbsp;&nbsp;&nbsp;&nbsp;Tổng số trang: <span class="label label-success label-pagination">{{ $totalPage }}</span> 
            </p>
            
        </div>
        <div class="col-md-6">
            {{-- {{ $items->links('pagination.pagination_zvn') }} --}}
            {!! $items->appends(request()->input())->links('pagination.pagination_zvn') !!}{{-- giữ lại phần tìm kiếm --}}
        </div>
    </div>
</div>