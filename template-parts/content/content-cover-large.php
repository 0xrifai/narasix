<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';

$post_class = array_merge( $post_class, array(
	'post-item',
	'post-overlay',
) );

$post_link =  get_permalink();

$post_class = array(
  'relative',
  'max-lg:h-[20rem]',
  'h-full',
  'w-full',
  'bg-cover',
  'bg-center',
  'bg-no-repeat'
);
?>

<div <?php post_class( $post_class ); ?> <?php echo narasix_css_background_img( $thumb_size ); ?>>
  <div class="absolute bottom-0 w-full rounded_b p-4 pt-40 text-charcoal-100 bg-gradient-to-t from-charcoal-900/90 via-transparent">
    
      <?php  
        if ( $post_meta_category == 'yes' ) { ?>
          <span class="!text-[15px] sm:!text-lg">
            <?php narasix_post_categories_with_background(); ?>
          </span>
          <?php
        }
      ?>
   
    <h3 class="font-heading heading-primary text-xl lg:text-2xl line-clamp-2">
      <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h3>
    <div class="font-meta meta-scroll flex justify-between items-center text-[14px] border-t border-charcoal-100 mt-2 pt-2">
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