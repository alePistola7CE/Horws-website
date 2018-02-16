<?php

  if ( function_exists( 'add_image_size' ) ) {
	    add_image_size( 'homepage-thumb', 1172, 1080, true);
  }

  function mdc_remove_img($content) {
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    return $content;
  }

  add_filter( 'the_content', 'mdc_remove_img' );

  //widget Location
  function wpb_init_widgets($id){
    register_sidebar(array(
      'name'   => 'Sidebar',
      'id'     => 'sidebar',
      'before_widget' => '<div class="sidebar-module">',
      'after_widget'  =>  '</div>',
      'before_tile'   =>  '<h3>',
      'after_title'   =>  '</h3>'
    ));
  }

add_action('widgets_init', 'wpb_init_widgets');
add_theme_support( 'post-thumbnails' );


?>
