<?php

if ( isset( $args ) ) extract( $args ); // extract passed variables.
if ( !isset( $num_posts ) ) { $num_posts = array(); }

$recent_posts = new WP_Query( array(
  'post_type' => 'post',
  'posts_per_page' => $num_posts,
  ) );
  if ( $recent_posts->have_posts() ) :
    echo '<ul class="border rounded-lg py-5 px-6 my-4 overflow-y-auto h-80">';
    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
      echo '<li>';
        narasix_get_template_part('template-parts/content/content-landscape-no-thumb' );
      echo '</li>';
    endwhile;
    echo '</ul>';
  endif;
?>
