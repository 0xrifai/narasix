<?php

if ( isset( $args ) ) extract( $args ); // extract passed variables.
if ( !isset( $num_posts ) ) {
  $num_posts = array();
}

$recent_posts = new WP_Query( array(
  'post_type' => 'post',
  'posts_per_page' => $num_posts,
  ) );
  if ( $recent_posts->have_posts() ) :
    echo '<div class="overflow-hidden">';
    echo '<div class="relative swiper widget-slider">';
    echo '<div class="swiper-wrapper">';
    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
      echo '<div class="swiper-slide">';
      narasix_get_template_part('template-parts/content/content-cover' );
      echo '</div>';
    endwhile;
    echo '</div>';
    echo '<div class="swiper-pagination"></div>';
    echo '</div>';
    echo '</div>';
  endif;
?>
