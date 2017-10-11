<?php  
	// This is done by direct way
	// wp_nav_menu(array('menu' => 'Main Nav Menu', 'menu_class' => 'menu-item', 'container' => '', 'items_wrap'    => '%3$s'));
	// Indirectly we do
	$args = array(
		'menu' => 'Main Nav Menu', 
		'menu_class' => 'menu-item', 
		'container' => '',  //avoid for container
		'items_wrap'    => '%3$s' //avoid for default ul
		);
	// Then call 
	wp_nav_menu($args);