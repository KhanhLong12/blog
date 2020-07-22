@extends('admin.main')

@php
    use App\Helps\Template as Template;

    $countFilter  =  Template::showButtonFilter($controllerName, $itemsCountStatus, $params);//trong params chứa ['search'] và ['filter']
    $showAreaSearch  =  Template::showAreaSearch($controllerName, $params['search']);
@endphp
@section('content')
    @include('admin.template.page_header',['pageHome' => true])

@include('admin.template.notify')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title' => 'Bộ lọc'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-7">
                        {!! $countFilter !!}
                    </div>
                    <div class="col-md-5">
                        {!! $showAreaSearch !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title' => 'Danh sách'])
            @include('admin.pages.article.list')
        </div>
    </div>
</div>
<!--end-box-lists-->
<!--box-pagination-->
    @if(count($items)>0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.template.x_title',['title' => 'Phân trang'])
                    @include('admin.template.pagination')
                </div>
            </div>
        </div>
    @endif
@endsection