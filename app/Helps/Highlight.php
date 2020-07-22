<?php
namespace App\Helps;


	class Highlight {

		public static function show($input, $params, $field){
			if ($params['search']['value'] == null) {
				return $input;
			}
			if ($params['search']['field'] == 'all' || $params['search']['field'] == $field) {
				return preg_replace("/".preg_quote($params['search']['value'], "/"). "/i", "<span style='background: yellow'>$0</span>", $input);// tìm trong $input cái nào chứa giá trị người dùng nhập vào thì cho vào highlight
				
			}
			return $input;
			
		}  
	}
?>