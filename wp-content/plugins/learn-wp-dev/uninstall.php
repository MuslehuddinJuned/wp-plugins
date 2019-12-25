<?php

defined('ABSPATH') or die();

global $wpdb;
$table_name = $wpdb->prefix . 'learn_wp_db';
$wpdb->query( "DROP TABLE IF EXISTS $table_name" );