
<?php if(is_single()) : ?>
  <div class="instagram-content">
      <h3><?php the_title(); ?></h3>
      <div style="text-align: left; position: static; margin-left: 20px; margin-top: -30px;">
        <ul class="share-buttons">
          <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F&quote=Horws%20photography&t=<?php the_title(); ?>" title="Share on Facebook" target="_blank"><img class="socialContent" alt="Share on Facebook" src="<?php bloginfo('template_url'); ?>/images/simple_icons_black/Facebook.png" /></a></li>
          <li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F&text=Horws%20photography:%20http%3A%2F%2Fhorws-photography.hostinggratis.it%2F" target="_blank" title="Tweet"><img class="socialContent" alt="Tweet" src="<?php bloginfo('template_url'); ?>/images/simple_icons_black/Twitter.png" /></a></li>
          <li><a href="https://plus.google.com/share?url=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F" target="_blank" title="Share on Google+"><img class="socialContent" alt="Share on Google+" src="<?php bloginfo('template_url'); ?>/images/simple_icons_black/Google+.png" /></a></li>
        </ul>
      </div>
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
                      <img src="<?php bloginfo('template_url'); ?>/images/gps.png" alt="Gps, position" style="width: 22px; display: inline-block;">
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
    <div class="widgets col-xs-12">
      <?php if(is_active_sidebar('sidebar')): ?>
        <?php dynamic_sidebar('sidebar'); ?>

      <?php endif; ?>
    </div>
    <?php comments_template(); ?>

    </div>

  <?php else: ?>

    <div class="instagram-content">
        <h3><a class="titleLink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <span class="descrizione">
        <?php the_excerpt(); ?>
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
            $z = 0;
            foreach ( $attachments as $attachment ) {
              if ( $z < 3) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div class="photo-box">
                    <div class="image-wrap">
                      <?php echo wp_get_attachment_image( $attachment->ID, "homepage-thumb", "", array( "class" => "photo" ) ); ?>
                      <div class="likes">
                        <img src="<?php bloginfo('template_url'); ?>/images/gps.png" alt="Gps, position" style="width: 22px; display: inline-block;">
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
                $z++; }
              }
            }
          ?>
      </div>

      <div style="text-align: right; position: static; margin-right: 20px;">
        See more about <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </div>

      </div>

  <?php endif; ?>
