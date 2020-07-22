@php
	$title = 'Danh sách ' . ucwords($controllerName);
	$link  = route($controllerName);
	$button= 'btn-info';
	$icon  = 'fa-arrow-left';
	$name  = 'Back';

	if ($pageHome == true) {
		$link  = route($controllerName . '/form');
		$button= 'btn-success';
		$icon  = 'fa-plus-circle';
		$name  = 'Thêm mới';
	}
	$pageButton = sprintf('<a href="%s" class="btn %s"><i
                class="fa %s"></i> %s</a>', $link, $button, $icon, $name);
@endphp


<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $title }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
    	{!! $pageButton !!}
    </div>
</div>