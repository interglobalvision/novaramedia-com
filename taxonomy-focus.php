<?php
get_header();

$term = $wp_query->get_queried_object();

$splash_image_id = get_term_meta($term->term_id, '_nm_focus_splash_id', true);
$splash_image_caption = wp_get_attachment_caption($splash_image_id);
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">
    
    <div class="flex-grid-row margin-bottom-mid">
      <div class="flex-grid-item flex-item-s-12 flex-item-l-6 flex-item-xxl-4">
        <h4 class="margin-bottom-micro">Focus</h4>
        <div class="only-desktop">
          <h1 class="margin-bottom-micro"><?php single_cat_title(); ?></h1>
          <div class="font-size-h2">
            <?php echo category_description(); ?>
          </div>
        </div>
      </div>
      <div class="flex-grid-item flex-item-s-12 flex-item-l-6 flex-item-xxl-8">
        <?php echo wp_get_attachment_image($splash_image_id, 'col18-16to9', false, array('class' => 'focus-archive__splash')); ?>

        <?php        
          if ($splash_image_caption) {
        ?>
        <div class="font-smaller">
          <?php echo $splash_image_caption; ?>
        </div>
        <?php
          }
        ?>
        <div class="only-mobile">
          <h1 class="margin-top-micro margin-bottom-micro"><?php single_cat_title(); ?></h1>
          <div class="font-size-h3">
            <?php echo category_description(); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row margin-bottom-basic">
<?php
if( have_posts() ) {
  $i = 0;
  while( have_posts() ) {
    the_post();

    if ($i % 3 === 0 && $i !== 0) {
      echo "</div>\n<div class=\"row margin-bottom-basic\">";
    }

    get_template_part('partials/post-layouts/post-col8');

    $i++;
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
    </div>
    <div class="row margin-bottom-basic">
      <div class="col col24">
        <?php get_template_part('partials/pagination'); ?>
      </div>
    </div>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>