<?php get_header(); ?>

<header>
  <?php $post_id = get_the_ID(); ?>
  <?php if(has_post_thumbnail($post_id)): ?>
    <img src="<?php the_post_thumbnail_url($post_id); ?>" alt="Mountains" style="opacity: 0.90;">
  <?php else: ?>
    <img src="<?php bloginfo('template_url'); ?>/images/all.jpg" alt="Mountains" style="opacity: 0.90;">
  <?php endif; ?>

  <div class="name fancy-font">
        <a class="nope" href="articles/"> Go back </a>
  </div>
  <div class="titles2">
    <h1>Hello! <span>I'm horws</span></h1>
    <h2>These are some photos taken in <?php the_title(); ?></h2><br>
    <h2><span><a class="nope" href="canazei/">Canazei</a></span> - <span><a class="nope" href="sirolo/">Sirolo</a></span> - <span><a class="nope" href=roma/>Roma</a></span><h2>
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
    <div class="row">
      <div class="col-xs-12">
        <?php if(have_posts()) : ?>
          <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
          <?php endwhile; ?>
        <?php else : ?>
          <p> <?php __('No post found'); ?></p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
