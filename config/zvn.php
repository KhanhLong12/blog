<?php

return [
	'url' => [
		'prefix_admin' 	=> 'admin',
		'prefix_news' 	=> 'news',
	],

	'Format' => [
		'long_time' 	=> 'H:m:s d/m/Y',
		'short_time' 	=> 'd/m/Y',
	],

	'template' => [
		'status' => [
			'active' 	=> ['name' => 'active', 'color' => 'green'],//1
		 	'inactive' 	=> ['name' => 'inactive', 'color' => 'red'],//2
		 	'all' 		=> ['name' => 'All', 'color' => 'red'],//3
		 	'default'	=> ['name' => 'undefined', 'color' => 'blue']//4
		],

		'is_home' => [
			'1' 	=> ['name' => 'display', 'color' => 'green'],//1
		 	'0' 	=> ['name' => 'no display', 'color' => 'orange'],//2
		],

		'display_item' => [
			'list' 	=> ['name' => 'list'],//1
		 	'grid' 	=> ['name' => 'grid'],//2
		],

		'form_input' => [
			'class'	 => 'form-control col-md-6 col-xs-12',//1
		],
		
		'form_label' => [
		 	'class'  => 'control-label col-md-3 col-sm-3 col-xs-12',//2
		],

		'search' => [
			'all' 				=> ['name' => 'Search by All'],
			'id' 				=> ['name' => 'Search by ID'],
			'name' 				=> ['name' => 'Search by Name'],
			'username' 			=> ['name' => 'Search by UserName'],
			'fullname' 			=> ['name' => 'Search by Fullname'],
			'email' 			=> ['name' => 'Search by Email'],
			'link' 				=> ['name' => 'Search by Link'],
			'description' 		=> ['name' => 'Search by Description'],
			'content' 			=> ['name' => 'Search by Content'],
		 	
		],

		'button' => [
			'edit' 		=> ['name' => 'Edit',   'class'  => 'btn-success' , 'title'  => 'Edit' , 'icon' => 'fa-pencil', 'route-name' =>'/form'],//1

	 		'delete' 	=> ['name' => 'Delete', 'class'  => 'btn-danger btn-delete' , 	'title'  => 'Delete' , 'icon' => 'fa-trash', 'route-name' => '/delete'],//2

	 		'view'		=> ['name' => 'View',   'class'	 => 'btn-info' , 	'title'  => 'View', 'icon' => 'fa-eye' , 'route-name' => '/form']//3
		]
	],

	'config' => [
		'search' => [
			'default' 	=> ['all', 'id', 'fullname'],
			'slider'  	=> ['all', 'description', 'name', 'link'],
			'category'  => ['all', 'name',],
			'article'  	=> ['all', 'name', 'content'],
		],

		'button' => [
			'default' 	=> ['edit', 'delete'],
		 	'slider'  	=> ['view', 'edit', 'delete'],
		 	'category'  => ['view', 'edit', 'delete'],
		 	'article'   => ['view', 'edit', 'delete'],
		]
	],
];