<?php
namespace App\Helps;
use Config;

	class Template
	{
		public static function showButtonFilter($controllerName, $itemsCountStatus, $params){
			$tmpStatus = Config::get('zvn.template.status');
			$xhtml = null;
			if ($itemsCountStatus > 0) {
				array_unshift($itemsCountStatus, [
					'count' 	=> array_sum(array_column($itemsCountStatus, 'count')),
					'status' 	=> 'all'
				]);//thêm phần tử all vào đầu dnah sách $itemsCountStatus
				foreach ($itemsCountStatus as $item) { //$item = [count , status]
					$statusValue = $item['status'];

					$statusValue = array_key_exists($statusValue, $tmpStatus) ? $statusValue : 'default';

					$currenTemplateStatus = $tmpStatus[$statusValue];

					$link = route($controllerName) . '?filter_status='. $statusValue;

					if ($params['search']['value'] !== '') {
						$link .= '&search_field=' . $params['search']['field'] . '&search_value=' . $params['search']['value'];
					}

					$class = ($params['filter']['status'] == $statusValue)? 'btn-danger': 'btn-primary'; //đổi màu khi ở trạng thái nào đó

					$xhtml .= sprintf('
							<a
	                            href="%s" type="button"
	                            class="btn %s">
	                        %s <span class="badge bg-white">%s</span></a>', $link, $class, $currenTemplateStatus['name'], $item['count'] );
				}
			}
			return $xhtml;

		}

		public static function showAreaSearch($controllerName, $paramsSearch){
			$xhtml = null;
			$tmpField = Config::get('zvn.template.search');

			$fieldInController = Config::get('zvn.config.search');

			$controllerName = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';//kiểm tra index có tồn tại trong mảng hay không

			$xhtmlField = null;

			foreach ($fieldInController[$controllerName] as $field) {// $field = [all, id]
				$xhtmlField .= sprintf('
					<li><a href="#"
                     	class="select-field" data-field="%s">%s</a></li>
                        ', $field, $tmpField[$field]['name']);
			}

			$seacrhField = (in_array($paramsSearch['field'], $fieldInController[$controllerName])) ? $paramsSearch['field'] : 'all';//kiểm tra xem value có tồn tại trong $fieldInController[$controllerName] hay không

			$xhtml = sprintf(
				'<div class="input-group">
                    <div class="input-group-btn">
                        <button type="button"
                                class="btn btn-default dropdown-toggle btn-active-field"
                                data-toggle="dropdown" aria-expanded="false">
                            %s <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            %s
                        </ul>
                    </div>
                    <input type="text" class="form-control" name="search_value" value="%s">
                    <input type="hidden" name="search_field" value="%s">
                    <span class="input-group-btn">
	                <button id="btn-clear" type="button" class="btn btn-success"
	                        style="margin-right: 0px">Delete</button>
	                <button id="btn-search" type="button" class="btn btn-primary">Search</button>
	                </span>
                </div>',$tmpField[$seacrhField]['name'] , $xhtmlField, $paramsSearch['value'], $seacrhField);
			return $xhtml;

		}


		public static function showItemHistory($by, $time){
			$xhtml = sprintf('
			<p><i class="fa fa-user"></i> %s</p>

            <p><i class="fa fa-clock-o"></i>%s</p>',$by, date(Config::get('zvn.Format.short_time'), strtotime($time)) );

			return $xhtml;
		}

		public static function showStatus($controllerName, $id, $status){
		 	$tmpStatus = Config::get('zvn.template.status');

		 	$statusValue = array_key_exists($status, $tmpStatus) ? $status : 'default';

		 	$currenTemplateStatus = $tmpStatus[$statusValue];//khi trang thái là active thì sẽ ứng vào 1
		 	$link = route($controllerName . '/status', ['status' => $status, 'id' => $id]);
		 	
		 	$xhtml = sprintf('
			<a href="%s" class="test" style="color: %s">%s</a>',$link , $currenTemplateStatus['color'], $currenTemplateStatus['name']);

			return $xhtml;
		}

		public static function showIsHome($controllerName, $id, $isHome){
		 	$tmpIsHome = Config::get('zvn.template.is_home');

		 	$isHomeValue = array_key_exists($isHome, $tmpIsHome) ? $isHome : '1';

		 	$currenTemplateIsHome = $tmpIsHome[$isHomeValue];//khi trang thái là active thì sẽ ứng vào 1
		 	$link = route($controllerName . '/isHome', ['isHome' => $isHome, 'id' => $id]);
		 	
		 	$xhtml = sprintf('
			<a href="%s" class="test" style="color: %s">%s</a>',$link , $currenTemplateIsHome['color'], $currenTemplateIsHome['name']);

			return $xhtml;
		}

		public static function showStyleDisplay($controllerName, $id, $displayItem){
		 	$tmpDisplayItem = Config::get('zvn.template.display_item');
		 	// dd($tmpDisplayItem);
		 	// $isHomeValue = array_key_exists($isHome, $tmpIsHome) ? $isHome : '1';
		 	$xhtmlDisplayItem = null;

		 	$link = route($controllerName . '/display', ['display' => 'value_new', 'id' => $id]);

		 	$xhtmlDisplayItem = sprintf('<select data-url="%s" class="form-control select_change_attr">',$link);

		 	foreach ($tmpDisplayItem as $key => $value) {
		 		$xhtmlSelected = null;
		 		if ($key == $displayItem)
		 			$xhtmlSelected = 'selected';
		 		
			 		$xhtmlDisplayItem .= sprintf('
					<option value="%s" %s >%s</option>',$value['name'],$xhtmlSelected ,$value['name']);
		 	}

			$xhtmlDisplayItem .= sprintf('</select>');

			return $xhtmlDisplayItem;
		}

		public static function showThumb($thumbName, $thumbAlt){
		 	$xhtml = sprintf('
				<img src="%s"
                 alt="%s" class="zvn-thumb">',asset('images/slider/' .$thumbName), $thumbAlt);

			return $xhtml;
		}

		public static function showThumbArticle($thumbName, $thumbAlt){
		 	$xhtml = sprintf('
				<img src="%s"
                 alt="%s" class="zvn-thumb">',asset('images/article/' .$thumbName), $thumbAlt);

			return $xhtml;
		}

		public static function showThumbNews($thumbName, $thumbAlt){
		 	$xhtml = sprintf('
				<img src="%s"
                 alt="%s" class="background_image">',asset('admin/images/slider/' .$thumbName), $thumbAlt);

			return $xhtml;
		}

		public static function showButton($controllerName, $id){
		 	$tblButton = Config::get('zvn.template.button');// tạo ra các trường mặc định edit delete view

		 	$ButtonDefault = Config::get('zvn.config.button');// tạo ra trường cho trang chỉ định

		 	$controllerName = (array_key_exists($controllerName, $ButtonDefault)) ? $controllerName : 'default';// (2) //kiểm tra phần tử $controllerName có trong $ButtonDefault hay không
 
		 	$listButton = $ButtonDefault[$controllerName];// của (2) => ['edit','delete']
		 	$xhtml = '<div class="zvn-box-btn-filter">';
		 	foreach ($listButton as $btn) {
		 		$currenButton = $tblButton[$btn];//foreach các giá trị 1, 2, 3
		 		$link = route($controllerName . $currenButton['route-name'], ['id' => $id]);
		 		$xhtml .= sprintf('
					<a
                      href="%s"
                        type="button" class="btn btn-icon %s" data-toggle="tooltip"
                        data-placement="top" data-original-title="%s">
                   	 <i class="fa %s"></i>
               	 	</a>',$link, $currenButton['class'], $currenButton['name'], $currenButton['icon']);
		 	}
		 	$xhtml .= '</div>';

			return $xhtml;
		}
	}
 ?>