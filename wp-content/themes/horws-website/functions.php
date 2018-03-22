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
add_theme_support( 'post-formats', array('status') );
// enqueue font awesome
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
function prefix_enqueue_awesome() {
  wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array(), '4.1.0' );
}



//customizer file
require get_template_directory(). '/inc/customizer.php';


?>
