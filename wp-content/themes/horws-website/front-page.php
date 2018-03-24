<?php get_header(); ?>

  <!-- HEADERRRRRRR -->
    <header>
      <img src="<?php echo get_theme_mod('showcase_image', get_bloginfo('template_url').'/images/mountains.jpg'); ?>" alt="Mountains" style="opacity: 0.90;">
      <div class="name fancy-font">
            <a class="nope" href="<?php echo get_home_url(); ?>">Horws</a>
      </div>
      <div class="titles">
        <h1><?php echo get_theme_mod('showcase_heading1', 'Hello! '); ?><span><?php echo get_theme_mod('showcase_heading2', "I'm Horws" ); ?></span></h1>
        <h2><?php echo get_theme_mod('showcase_text', 'I love to travel all around the world and shot beautiful landscapes'); ?></h2>
        <div class='ico'>
          <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F&quote=Horws%20photography&t=<?php the_title(); ?>" title="Share on Facebook" target="_blank"><img alt="Share on Facebook" class='socialimg' src="<?php bloginfo('template_url'); ?>/images/simple_icons/Facebook.png" /></a>
          <a href="https://plus.google.com/share?url=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F" target="_blank" title="Share on Google+"><img class='socialimg2' alt="Share on Google+" src="<?php bloginfo('template_url'); ?>/images/simple_icons/Google+.png" /></a>
          <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fhorws-photography.hostinggratis.it%2F&text=Horws%20photography:%20http%3A%2F%2Fhorws-photography.hostinggratis.it%2F" target="_blank" title="Tweet"><img class='socialimg3' alt="Tweet" src="<?php bloginfo('template_url'); ?>/images/simple_icons/Twitter.png" /></a>
        </div>
      </div>
      <div class="social">
        <a class="instagram" target="_blank" href="<?php echo get_theme_mod('showcase_link_insta', 'https://www.instagram.com/__horws/'); ?>">Instagram</a>
        <a class="foto" href="articles/">Foto</a>
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
        <div class="row first-page">
            <div class="col-xs-12">
                <div class="instagram-content">
                    <h3 class='first-page'>Latest Photos</h3>
                    <div class="row first-page photos-wrap">
                    <!-- Instafeed target div -->
                      <div id="instafeed"></div>
                      <!--<div id="instafeed2"><div class="row"></div></div>-->

                    </div>

                </div>
              </div>
            </div>
      </div>
    </section>


<?php get_footer(); ?>
