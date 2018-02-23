<?php get_header(); ?>

  <!-- HEADERRRRRRR -->
    <header>
      <img src="<?php bloginfo('template_url'); ?>/images/mountains.jpg" alt="Mountains" style="opacity: 0.90;">
      <div class="name fancy-font">
            <a class="nope" href="<?php echo get_home_url(); ?>">Horws</a>
      </div>
      <div class="titles">
        <h1>Hello! <span>I'm horws</span></h1>
        <h2>I love to travel all around the world and shot beautiful landscapes</h2>
      </div>
      <div class="social">
        <a class="instagram" target="_blank" href="https://www.instagram.com/__horws/?hl=ithttps://www.instagram.com/__horws/?hl=it">Instagram</a>
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
