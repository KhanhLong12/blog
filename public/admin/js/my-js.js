$(document).ready(function() {
	

	let $btnSearch        = $("button#btn-search");//trỏ đến button có class btn-search
	let $btnClearSearch	  = $("button#btn-clear");

	let $inputSearchField = $("input[name  = search_field]");
	let $inputSearchValue = $("input[name  = search_value]");

	// let $selectFilter     = $("select[name = select_filter]");
	// let $selectChangeAttr = $("select[name =  select_change_attr]");
	// let $selectChangeAttrAjax = $("select[name =  select_change_attr_ajax]");


	$("a.select-field").click(function(e) {
		e.preventDefault();

		let field 		= $(this).data('field');
		let fieldName 	= $(this).html();
		$("button.btn-active-field").html(fieldName + ' <span class="caret"></span>');
    	$inputSearchField.val(field);
	});

	$btnSearch.click(function() {

		var pathname	= window.location.pathname;//lấy đường dẫn hiện tại
		
		let params = ['filter_status'];
		// params 			= ['page', 'filter_status', 'select_field', 'select_value'];
		let searchParams= new URLSearchParams(window.location.search);//lấy giá trị search trên url filter_status = active

		let link		= "";
		// $.each( params, function( key, value ) {
		// 	if (searchParams.has(value) ) {
		// 		link += value + "=" + searchParams.get(value) + "&"
		// 	}
		// });
		$.each( params, function( key, param ) {//filter_status
			if (searchParams.has(param) ) {//kiểm tra
				link += param + "=" + searchParams.get(param) + "&" //giữ lại filter_status = active
			}
		});

		let search_field = $inputSearchField.val();
		let search_value = $inputSearchValue.val();
		if (search_value.replace(/\s/g, "") == "") {
			alert('Nhập vào giá trị cần tìm')
		} else {
			window.location.href = pathname + "?" + link + 'search_field='+ search_field + '&search_value=' + search_value;
		}

		
		// window.location.href = pathname + "?" + link + 'search_field='+ search_field + '&search_value=' + search_value.replace(/\s+/g, '+').toLowerCase();
	});

	$btnClearSearch.click(function() {
		var pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);

		params 			= ['filter_status'];
		// params 			= ['page', 'filter_status', 'select_filter'];

		let link		= "";
		$.each( params, function( key, param ) {
			if (searchParams.has(param) ) {
				link += param + "=" + searchParams.get(param) + "&"
			}
		});

		window.location.href = pathname + "?" + link.slice(0,-1);
	});

	$('.btn-delete').click(function(){
		var r = confirm("bạn có muốn xóa không");
       	if (r === false) {
           return false;
        }
	});

	$('.select_change_attr').on('change', function () {
     	var selectVal = $(this).val();//chọn giá trị khi click
     	var url = $(this).attr('data-url');
     	// console.log(selectVal);
     	window.location.href = url.replace('value_new', selectVal);//thay giá trị value_new bên controller thành giá trị được chọn
	});

	// //Event onchange select filter
	// $selectFilter.on('change', function () {
	// 	var pathname	= window.location.pathname;
	// 	let searchParams= new URLSearchParams(window.location.search);

	// 	params 			= ['page', 'filter_status', 'search_field', 'search_value'];

	// 	let link		= "";
	// 	$.each( params, function( key, value ) {
	// 		if (searchParams.has(value) ) {
	// 			link += value + "=" + searchParams.get(value) + "&"
	// 		}
	// 	});

	// 	let select_field = $(this).data('field');
	// 	let select_value = $(this).val();
	// 	window.location.href = pathname + "?" + link.slice(0,-1) + 'select_field='+ select_field + '&select_value=' + select_value;
 // 	});

	// // Change attributes with selectbox
	// // $selectChangeAttr.on('change', function() {
	// // 	let item_id = $(this).data('id');
	// // 	let url = $(this).data('url');
	// // 	let csrf_token = $("input[name=csrf-token]").val();
	// // 	let select_field = $(this).data('field');
	// // 	let select_value = $(this).val();
	// //
	// // 	$.ajax({
	// // 		url : url,
	// // 		type : "post",
	// // 		dataType: "html",
	// // 		headers: {'X-CSRF-TOKEN': csrf_token},
	// // 		data : {
	// // 			id : item_id,
	// // 			field: select_field,
	// // 			value: select_value
	// // 		},
	// // 		success : function (result){
	// // 			if(result == 1)
	// // 				alert('Bạn đã cập nhật giá trị thành công!');
	// // 			else
	// // 				console.log(result)
	// //
	// // 		}
	// // 	});
	// // });

	// $selectChangeAttr.on('change', function() {
	// 	let select_value = $(this).val();
	// 	let $url = $(this).data('url');
	// 	window.location.href = $url.replace('value_new', select_value);
	// });

	// $selectChangeAttrAjax.on('change', function() {
	// 	let select_value = $(this).val();
	// 	let $url = $(this).data('url');
	// 	let csrf_token = $("input[name=csrf-token]").val();

	// 	$.ajax({
	// 		url : $url.replace('value_new', select_value),
	// 		type : "GET",
	// 		dataType: "json",
	// 		headers: {'X-CSRF-TOKEN': csrf_token},
	// 		success : function (result){
	// 			if(result) {
	// 				$.notify({
	// 					message: "Cập nhật giá trị thành công!"
	// 				}, {
	// 					delay: 500,
	// 					allow_dismiss: false
	// 				});
	// 			}else {
	// 				console.log(result)
	// 			}
	// 		}
	// 	});

	// });

	// //Init datepicker
	// $('.datepicker').datepicker({
	// 	format: 'dd-mm-yyyy',
	// });


	// //Confirm button delete item
	// $('.btn-delete').on('click', function() {
	// 	if(!confirm('Bạn có chắc muốn xóa phần tử?'))
	// 		return false;
	// });
});