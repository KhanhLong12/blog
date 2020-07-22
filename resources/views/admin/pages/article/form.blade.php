@extends('admin.main')

@php
    use App\Helps\Form as FormTemplate;
    use App\Helps\Template;

    // $nameLabel = Form::label('name', 'Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);
    // $nameInput = Form::text('name', '',['class' => 'form-control col-md-6 col-xs-12']);

    $formInputAtr = Config::get('zvn.template.form_input');
    $formLabelAtr = Config::get('zvn.template.form_label');

    $optionArray = ['default' => 'Select status', 'active' => Config::get('zvn.template.status.active.name'), 'inactive' => Config::get('zvn.template.status.inactive.name')];

    $inputHidden = Form::hidden('id', $item['id']);

    $inputHiddenThumb = Form::hidden('thumb_current', $item['thumb']);


    $elements = [
        [
            'label'     => Form::label('name', 'Name',  $formLabelAtr),
            'element'   => Form::text('name', $item['name'],       $formInputAtr)
        ],

        [
            'label'     => Form::label('content', 'Content',    $formLabelAtr),
            'element'   => Form::textarea('content',  $item['content'], ['id' => 'summary-ckeditor', 'class' => 'form-control col-md-6 col-xs-12'] )
        ],

        [
            'label'     => Form::label('status', 'Status',    $formLabelAtr),
            'element'   => Form::select('status', $optionArray, $item['status'] , $formInputAtr)

        ],

        [
            'label'     => Form::label('category_id', 'Category',    $formLabelAtr),
            'element'   => Form::select('category_id', $itemCategories, $item['category_id'] , $formInputAtr)

        ],

        [
            'label'     => Form::label('thumb', 'Thumb', $formLabelAtr),
            'element'   => Form::file('thumb', $formInputAtr),
            'thumb'     => (!empty($item['id'])) ? Template::showThumbArticle($item['thumb'], $item['name']) : null,
            'type'      => 'thumb'
        ],

        [
            'element'   => $inputHidden . $inputHiddenThumb . Form::submit('Save',['class' => 'btn btn-success']),
            'type'      => 'btn-submit'
        ],
    ];
@endphp
@section('content')
    @include('admin.template.page_header',['pageHome' => false])
    @include('admin.template.error')
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title' => 'Form'])
            {!! Form::open([
                'url'           => route($controllerName . '/save'),
                'method'        => 'POST',
                'enctype'       => 'multipart/form-data',
                'class'         => 'form-horizontal form-label-left',
                'id'            => 'main-form'
                ]) !!}
                {!! FormTemplate::show($elements) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!--end-box-lists-->
@endsection