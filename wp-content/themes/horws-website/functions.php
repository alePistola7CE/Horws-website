<?php

  function wp_theme_setup(){
    add_theme_support('post-thumbnails');
  }

  if ( function_exists( 'add_image_size' ) ) {
	    add_image_size( 'homepage-thumb', 1172, 1080, true);
  }

  function mdc_remove_img($content) {
    $content = preg_replace("/<img[^>]+\>/i", "", $content);
    return $content;
  }

  add_filter( 'the_content', 'mdc_remove_img' );

?>
