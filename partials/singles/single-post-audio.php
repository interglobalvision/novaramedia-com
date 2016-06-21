<?php
  $meta = get_post_meta($post->ID);

  $category_id = get_cat_ID('Audio');
  $category_link = get_category_link( $category_id );

  if (!empty($meta['bitly_url'])) {
    $share_url = $meta['bitly_url'][0];
  } else {
    $share_url = get_the_permalink($post->ID);
  }
?>

<div class="row">
  <div class="col col24 margin-bottom-basic">
    <h4><a href="<?php echo $category_link; ?>">Audio</a></h4>
  </div>
</div>

<header class="row margin-bottom-small">
  <div class="col col12">
    <h1 class="js-fix-widows"><?php the_title(); ?></h1>
  </div>

  <div class="col col12 text-copy font-italic padding-top-micro">
    <?php the_content(); ?>
  </div>
</header>

<div class="row margin-bottom-basic font-smaller">
  <div class="col col12">
    <ul class="inline-action-list">
      <li>Published <?php the_time('jS F Y'); ?></li>
      <li><a href="http://podcast.novaramedia.com" target="_blank">Subscribe to Podcast</a></li>
    <?php
      if (!empty($meta['_cmb_dl_mp3'])) {
        echo '<li><a class="font-smaller" href="' . $meta['_cmb_dl_mp3'][0] . '">Download mp3</a></li>';
      }
    ?>
    </ul>
  </div>
  <div class="col col12">
    <ul class="inline-action-list">
      <li><?php render_tweet_link($share_url, $post->post_title, 'Tweet Episode'); ?></li>
      <li><?php render_facebook_share_link($share_url); ?></li>
    </ul>
  </div>
</div>

<div class="row margin-bottom-large">
  <div class="col col24">
    <?php
      if (!empty($meta['_cmb_sc'][0])) {
    ?>
        <iframe src="https://w.soundcloud.com/player/?url=<?php echo urlencode($meta['_cmb_sc'][0]); ?>" width="100%" height="200" scrolling="no" frameborder="no"></iframe>

      <?php
        if (!empty($meta['_cmb_is_resonance']) && $meta['_cmb_is_resonance'][0]) {
      ?>
        <div class="font-mono font-smaller">
        	<a target=_blank href="http://resonancefm.com/">powered by: Resonance FM</a>
        </div>
      <?php
        }
      } else {
        echo 'Someone messed up :/';
      }
    ?>
  </div>
</div>