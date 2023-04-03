<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm_4_3';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';
( isset( $excerpt_length ) ) || $excerpt_length = 40;
( isset( $lazyload ) ) || $lazyload = true;

$post_class = array_merge( $post_class, array(

	'flex',
	'transition',
) );

$post_link =  get_permalink();

?>

<div <?php post_class( $post_class ); ?>>
  <div class="relative block basis-24 md:basis-80">
    <?php
      narasix_featured_img( array(
        'size' => $thumb_size,
        'icon' => $post_format_icon,
        'lazyload' => $lazyload,
        'class' => 'aspect-autos h-full md:h-48 lg:h-44',
      ) );
    ?>
  </div>

  <div class="flex flex-1 items-center justify-between">
    <div class="pl-4">  
      <?php  
        if ( $post_meta_category == 'yes' ) { ?>
          <span class="w-[80%] text-[14px]">
            <?php narasix_post_categories(); ?>
          </span>
        <?php
        }
      ?>
      <h3 class="font-heading line-clamp-2 lg:text-2xl">
        <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h3>

      <?php
        if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
          ?>
            <p class="line-clamp-1 xs:line-clamp-2 md:line-clamp-3 mt-2 leading-relaxed opacity-50">
              <?php narasix_excerpt( $excerpt_length, true ); ?>
            </p>
          <?php
        }
      ?>

      <div class="mt-1 flex justify-between items-center border-t pt-1 text-sm">
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