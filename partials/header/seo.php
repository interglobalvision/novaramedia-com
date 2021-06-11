<?php
$twitter = IGV_get_option('_igv_socialmedia_twitter');

if ($twitter) {
  echo '<meta name="twitter:site" value="' . $twitter . '">';
}

$fb_app_id = IGV_get_option('_igv_og_fb_app_id');

if ($fb_app_id) {
  echo '<meta name="fb:app_id" value="' . $fb_app_id . '">';
}

?>
  <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
  <meta name="twitter:card" value="summary_large_image">
<?php
global $post;

$og_image_url = get_stylesheet_directory_uri() . '/dist/img/favicon-32x32.png'; // fallback to favicon
$og_image_default_setting = wp_get_attachment_image_src(IGV_get_option('_igv_og_image_id'), 'opengraph');

if (!empty($og_image_default_setting)) { // try settings default
  $og_image_url = $og_image_default_setting[0];
}

if (is_tax('focus')) { // if is focus archive get the splash image
  $splash_image_id = get_term_meta(get_queried_object_id(), '_nm_focus_splash_id', true);
  
  if (!empty($splash_image_id)) {
    $og_image_url = wp_get_attachment_image_src($splash_image_id, 'opengraph')[0];
  }
}

if ((is_single() || is_page()) && has_post_thumbnail($post)) { // if is a single post with a thumbnail get that
  $alt_thumb = get_post_meta($post->ID, '_cmb_alt_social_id', true); // try alternative thumbnail meta
  
  if (!empty($alt_thumb)) {
    $thumb_id = $alt_thumb; // if alt thumb is set we use it
  } else {
    $thumb_id = get_post_thumbnail_id($post->ID); // otherwise use the default
  }
  
  $og_image_url = wp_get_attachment_image_src($thumb_id, 'opengraph')[0];
}
?>
  <meta property="og:image" content="<?php echo $og_image_url; ?>" />
<?php
if (is_home()) {
?>
  <meta property="og:url" content="<?php bloginfo('url'); ?>"/>
  <meta property="og:description" content="<?php bloginfo('description'); ?>" />
  <meta property="og:type" content="website" />
<?php
} else if (is_single()) {
  global $post;

  $twitterAuthor = get_post_meta($post->ID, '_cmb_author_twitter', true);

  if ($twitterAuthor) {
    if (!is_array($twitterAuthor)) { // if this isn't an array then make into array
      $twitterAuthor = array($twitterAuthor);
    }

    if (count($twitterAuthor) === 1) { // if there is only one author then set the twitter creator og tag. tag doesn't support multiple authors
      echo '<meta name="twitter:creator" value="' . $twitterAuthor[0] . '">';
    }
  }

  $description = get_post_meta($post->ID, '_cmb_short_desc', true);

  if ($description) {
    // strip shortcodes from short_desc
    $excerpt = strip_shortcodes($description);
    // strip html tags
    $excerpt = strip_tags(html_entity_decode($excerpt));
  } else {
    // strip shortcodes from post_content
    $excerpt = strip_shortcodes($post->post_content);
    // strip html tags
    $excerpt = strip_tags(html_entity_decode($excerpt));
    // trim post content by 600 chars
    $excerpt = substr($excerpt, 0, 600);
    // add ... to end
    $excerpt = $excerpt . '…';
  }

  // clean special cars
  $excerpt = htmlspecialchars($excerpt);
?>
  <meta property="og:url" content="<?php the_permalink(); ?>"/>
  <meta property="og:description" content="<?php echo $excerpt; ?>" />
  <meta property="og:type" content="article" />
<?php
} else {
?>
  <meta property="og:url" content="<?php the_permalink() ?>"/>
  <meta property="og:description" content="<?php bloginfo('description'); ?>" />
  <meta property="og:type" content="website" />
<?php
}
?>