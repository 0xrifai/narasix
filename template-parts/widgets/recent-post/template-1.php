<?php

if ( isset( $args ) ) extract( $args ); // extract passed variables.
if ( !isset( $num_posts ) ) { $num_posts = array(); }

$recent_posts = new WP_Query( array(
  'post_type' => 'post',
  'posts_per_page' => $num_posts,
  ) );
  if ( $recent_posts->have_posts() ) :
    echo '<div class="border rounded-lg">';
    echo '<div class="widget-with-cover">';
    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
        if( $recent_posts->current_post == 0 ) {
            narasix_get_template_part('template-parts/content/content-cover' );
        } 
    endwhile;
    echo '</div>';
    echo '<ul class="px-6 my-4 overflow-y-auto h-48">';
    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
        if( $recent_posts->current_post >= 1 ) {
            echo '<li>';
              narasix_get_template_part('template-parts/content/content-landscape-no-thumb' );
            echo '</li>';
        }
    endwhile;
    echo '</ul>';
    echo '<div>';
  endif;
?>