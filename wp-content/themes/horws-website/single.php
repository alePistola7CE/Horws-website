<?php get_header(); ?>

<header>
  <?php $post_id = get_the_ID(); ?>
  <?php if(has_post_thumbnail($post_id)): ?>
    <img src="<?php the_post_thumbnail_url($post_id); ?>" alt="Mountains" style="opacity: 0.90;">
  <?php else: ?>
    <img src="<?php bloginfo('template_url'); ?>/images/all.jpg" alt="Mountains" style="opacity: 0.90;">
  <?php endif; ?>

  <div class="name fancy-font">
        <a class="nope" href="<?php bloginfo('template_url'); ?>/index.php">Horws </a>
  </div>
  <div class="titles2">
    <h1>Hello! <span>I'm horws</span></h1>
    <h2>These are some photos taken in <?php the_title(); ?></h2><br>
    <h2><span><a class="nope" href=#Canazei>Canazei</a></span> - <span><a class="nope" href=#Riviera-del-conero>Riviera del conero</a></span> - <span><a class="nope" href=#Roma>Roma</a></span><h2>
  </div>
  <div class="social">
    <a class="instagram" target="_blank" href="https://www.instagram.com/__horws/?hl=ithttps://www.instagram.com/__horws/?hl=it">Instagram</a>
    <a class="foto" href="<?php bloginfo('template_url'); ?>/photos.php">Foto</a>
    <a class="mail" href="#mail">Mail to</a>
  </div>
</header>

<!--MODALL-->
<div id="myModal" class="modal">
  <span class="close">Close</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<!--MODAL -->

<!-- instagrammmmm -->
<section class="instagram-wrap">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php if(have_posts()) : ?>
          <?php while(have_posts()) : the_post(); ?>
            <div class="instagram-content">
                <h3><?php the_title(); ?></h3>
              <span class="descrizione">
                <?php the_content(); ?>
              </span>

              <div>
                <?php
                  $attachments = get_posts( array(
                    'post_type'   => 'attachment',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => $post->ID
                  ) );


                  if ( $attachments ) {
                    foreach ( $attachments as $attachment ) {
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                          <div class="photo-box">
                            <div class="image-wrap">
                              <?php echo wp_get_attachment_image( $attachment->ID, "homepage-thumb", "", array( "class" => "photo" ) ); ?>
                              <div class="likes">
                                <img src="http://localhost/Horws-web/wordpress-horws/wp-content/uploads/2018/02/gps.png" alt="Gps, position" style="width: 22px; display: inline-block;">
                                <span><?php the_title(); ?></span>
                              </div>
                            </div>
                            <div class="description"><?php echo get_post_meta( $attachment->ID,'_wp_attachment_image_alt', true); $meta = wp_get_attachment_metadata( $attachment->ID, true );
                                  $prova = $meta['image_meta']; ?>
                              <div class="date" style="margin-top: 3px;"><?php if(!$prova["credit"]) {
                                $out = "Author Horws &copy;";
                              } else {
                                $out = "Author".$prova["credit"]."&copy;";
                              }
                               echo $out; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                    }
                  ?>
              </div>

              <div style="text-align: right; position: static; margin-right: 20px;">
                <a href="<?php bloginfo('url'); ?>">Go back</a>
              </div>

              <!--ricordati di fare il controllo sul post format in quanti gli widget vairano in base al post -->
              <div class="widgets">
                <?php if(is_active_sidebar('sidebar')): ?>
                  <?php dynamic_sidebar('sidebar'); ?>

                <?php endif; ?>
              </div>
              <?php comments_template(); ?>

              </div>
          <?php endwhile; ?>
        <?php else : ?>
          <p> <?php __('No post found'); ?></p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
