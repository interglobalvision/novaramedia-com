<?php

// Custom filters (like pre_get_posts etc)


// Add classes to oembed elements
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="margin-top-basic margin-bottom-basic"><div class="u-video-embed-container">' . $html . '</div></div>';
}
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);


// Custom img attributes to be compatible with lazysize
function add_lazysize_on_srcset($attr) {

  // Add lazysize class
  $attr['class'] .= ' lazyload';

  if (isset($attr['srcset'])) {
    // Add lazysize data-srcset
    $attr['data-srcset'] = $attr['srcset'];
    // Remove default srcset
    unset($attr['srcset']);
  } else {
    // Add lazysize data-src
    $attr['data-src'] = $attr['src'];
  }

  // Remove default src
  unset($attr['src']);

  $attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';

  return $attr;

}
add_filter('wp_get_attachment_image_attributes', 'add_lazysize_on_srcset');