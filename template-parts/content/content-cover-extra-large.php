<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.
( isset( $thumb_size ) ) || $thumb_size = 'narasix_lg';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';

$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

$post_link =  get_permalink();
?>

<div class="h-[26rem] overflow-hidden bg-cover bg-center bg-no-repeat" <?php echo narasix_css_background_img( $thumb_size ); ?>>
  <div class="h-full e_bg-gradient-to-top mt-12"></div>
</div>
<div class="e_bg-charcoal-700 space-y-3">
  <div class="<?php echo esc_attr( $content_class ); ?> mx-auto z-10 py-1 px-4 -mb-[6px] lg:px-16">
    <div class="carousel-main my-4">
      <?php  
        if ( $post_meta_category == 'yes' ) {
          narasix_post_categories_with_background(); 
        }
      ?>
      <h2 class="font-heading line-clamp-2 mt-2">
        <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h2>
      <div class="font-meta w-[12rem] flex space-x-3 opacity-70">
        <?php
          narasix_post_meta( array(
            'meta_categories' => 'no',
            'meta_author' => $post_meta_author,
            'meta_date' => $post_meta_date,
          ) );
        ?>
      </div>
    </div>
  </div>
</div>