<?php
/**
 * Plugin Name:       My Custom Post
 * Plugin URI:        https://sustipe.com/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://sustipe.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

function myCustomPost(){
    register_post_type('Custom Post',
                    array(
                        'labels'      => array(
                            'name'          => __('Custom Posts'),
                            'singular_name' => __('Custom Post'),
                            'add_new' => __('New Post'),
                        ),
                        'taxonomies'  =>['category', 'post_tag'],
                        'supports'    => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                        'public'      => true,
                        'has_archive' => true,
                    )
    );
}

function customPostDisplay(){
    add_shortcode('tut', 'tut_cutom_post');
}

function tut_cutom_post(){
    $args = ['post_type' => 'Custom Post'];

    $postloop = new WP_Query($args);

    if($postloop->have_posts()){
        while($postloop->have_posts()){
            $postloop->the_post();
            echo '<h3>';the_title();echo'</h3>';
            the_post_thumbnail();
            the_content();
        }
    } else {echo "No Post Found.";}
}


 add_action('init', 'myCustomPost');
 add_action('init', 'customPostDisplay');



 add_action( 'init', 'create_custom_tax' );

function create_custom_tax() {
	register_taxonomy(
		'MyTaxo',
		'Custom Post',
		array(
			'label' => __( 'MyTaxo' ),
			'rewrite' => array( 'slug' => 'genre' ),
			'hierarchical' => true,
		)
	);
}