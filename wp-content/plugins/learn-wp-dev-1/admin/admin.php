<?php

require_once('menu_class.php');
add_action('init', array('menu_class', 'hide_admin_bar'));
add_action('admin_init', array('menu_class', 'register_our_settings'));
add_action('admin_menu', array('menu_class', 'createMenu'));