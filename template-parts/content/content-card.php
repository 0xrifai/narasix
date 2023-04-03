<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm_4_3';
( isset( $post_format_icon ) ) || $post_format_icon = 'yes';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';
( isset( $excerpt_length ) ) || $excerpt_length = 0;
( isset( $lazyload ) ) || $lazyload = true;

$post_class = array_merge( $post_class, array(
	'post-item',
) );

$post_link =  get_permalink();
$post_class_section = array(
  'relative',
	'rounded_box',
	'shadow-md',
);

?>
<div <?php post_class( $post_class_section ); ?>>
    <div class="relative content-card overflow-hidden">
      <?php
        narasix_featured_img( array(
          'size' => $thumb_size,
          'icon' => $post_format_icon,
          'lazyload' => $lazyload,
          'class' => 'aspect-portrait',
        ) );
      ?>
    </div>
  <div class="absolute flex justify-between w-full top-0 px-3 mt-3">
    <?php  
      if ( $post_meta_category == 'yes' ) { ?>
        <span class="w-[80%]">
          <?php narasix_post_categories_with_background(); ?>
        </span>
        <?php
      }
    ?>
    <?php if ( isset( $post_index ) ) { ?>
    <span class="absolute text-charcoal-100 right-[0.7rem] -mt-2 italic text-[30px] sm:text-4xl font-[fangsong]">
      <?php echo esc_html( sprintf( '%02d', $post_index ) ); ?>
    </span>
    <?php } ?>
  </div>
  <div class="mb-auto px-3 py-2 bg-charcoal-100 dark:bg-charcoal-700">
    <h4 class="font-heading secondary line-clamp-2">
      <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h4>
		<?php
      if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
      ?>
        <p class="text-limit opacity-50">
          <?php narasix_excerpt( $excerpt_length, true ); ?>
        </p>
      <?php
      }
		?>
  </div>
    <div class="font-meta meta-scroll flex flex-row items-center text-[14px] justify-between border-t secondary border_b rounded-t-none px-3 py-1">
      <?php
        narasix_post_meta( array(
          'meta_categories' => 'no',
          'meta_author' => $post_meta_author,
          'meta_date' => $post_meta_date,
        ) );
      ?>
    </div>
</div>
