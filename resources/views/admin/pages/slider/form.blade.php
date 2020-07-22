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
            'label'     => Form::label('description', 'Description',    $formLabelAtr),
            'element'   => Form::text('description',  $item['description'], $formInputAtr)
        ],
        [
            'label'     => Form::label('status', 'Status',    $formLabelAtr),
            'element'   => Form::select('status', $optionArray, $item['status'] , $formInputAtr)

        ],
        [
            'label'     => Form::label('link', 'Link',    $formLabelAtr),
            'element'   => Form::text('link',  $item['link'],               $formInputAtr)
        ],
        [
            'label'     => Form::label('thumb', 'Thumb', $formLabelAtr),
            'element'   => Form::file('thumb', $formInputAtr),
            'thumb'     => (!empty($item['id'])) ? Template::showThumb($item['thumb'], $item['name']) : null,
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
            {{-- <form method="POST" action="http://proj_news.xyz/admin123/slider/save" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
                <input name="_token" type="hidden" value="m4wsEvprE9UQhk4WAexK6Xhg2nGQwWUOPsQAZOQ5">
                
                <div class="form-group">
                    <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb">
                        <p style="margin-top: 50px;"><img src="http://proj_news.xyz/images/slider/LWi6hINpXz.jpeg" alt="Ưu đãi học phí" class="zvn-thumb"></p>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
</div>
<!--end-box-lists-->
@endsection