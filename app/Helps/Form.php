<?php
namespace App\Helps;
use Config;

	class Form
	{
		public static function show($elements){
			$xhtml = null;

			foreach ($elements as $value) {
				$xhtml .= self::formGroup($value);
				// $type = isset($value['type']) ? $value['type'] : 'input';
				// if ( $type == 'input') {
				// 	$xhtml .= sprintf(
				// 		'<div class="form-group">
				// 		    %s
				// 		    <div class="col-md-6 col-sm-6 col-xs-12">
				// 		        %s
				// 		    </div>
				// 		</div>',$value['label'],$value['element']
				// 	);
				// }
				// elseif ($type = 'btn-submit') {
				// 	$xhtml .= sprintf(
				// 		'<div class="ln_solid"></div>
				// 		<div class="form-group">
				// 		    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				// 		        <input name="id" type="hidden" value="3">
				// 		        <input name="thumb_current" type="hidden" value="LWi6hINpXz.jpeg">
				// 		        %s
				// 		    </div>
				// 		</div>',$value['element']
				// 	);
				// }
			}
			
			return $xhtml;
		}

		public static function formGroup($value){
			$xhtml = null;
			$type = isset($value['type']) ? $value['type'] : 'input';
			switch ($type) {
				case 'input':
					$xhtml .= sprintf(
						'<div class="form-group">
						    %s
						    <div class="col-md-6 col-sm-6 col-xs-12">
						        %s
						    </div>
						</div>',$value['label'],$value['element']);
					break;

				case 'btn-submit':
					$xhtml .= sprintf(
						'<div class="ln_solid"></div>
							<div class="form-group">
							    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							        %s
							    </div>
							</div>',$value['element']);
					break;
				
				case 'thumb':
					$xhtml .= sprintf(
						'<div class="form-group">
						    %s
						    <div class="col-md-6 col-sm-6 col-xs-12">
						        %s
						        <p style="margin-top: 50px;">%s</p>
						    </div>
						</div>',$value['label'],$value['element'],$value['thumb']);
					break;
			}
			return $xhtml;
		}
	}
 ?>




 