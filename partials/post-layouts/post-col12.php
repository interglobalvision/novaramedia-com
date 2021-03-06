<?php
  $meta = get_post_meta($post->ID);
?>

<a href="<?php the_permalink() ?>">
  <article <?php post_class('col col12'); ?> id="post-<?php the_ID(); ?>">

    <div class="post-col12-image">
    <?php the_post_thumbnail('col12-1to2point3', array('class' => 'u-display-block only-desktop')); ?>
    <?php the_post_thumbnail('mobile-16to9', array('class' => 'only-mobile')); ?>

      <div class="post-col12-image-overlay only-desktop"></div>
      <div class="post-col12-text font-color-white">
        <h3 class="js-fix-widows mobile-margin-bottom-micro"><?php render_post_title($post->ID); ?></h3>
    <?php
        if (!empty($meta['_cmb_author'])) {
    ?>
        <h5 class="margin-top-tiny">by <?php echo $meta['_cmb_author'][0]; ?></h5>
    <?php
        }
    ?>

      </div>
    </div>
  </article>
</a>