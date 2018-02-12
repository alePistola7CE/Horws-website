<?php

  function wp_theme_setup(){
    add_theme_support('post-thumbnails');
  }

  if ( function_exists( 'add_image_size' ) ) {
	    add_image_size( 'homepage-thumb', 350, 252 ); 
}

?>
