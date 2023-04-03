<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm_4_3';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';
( isset( $excerpt_length ) ) || $excerpt_length = 0;
( isset( $lazyload ) ) || $lazyload = true;

$post_class = array_merge( $post_class, array(
	'relative',
	'transition',
) );

$post_link =  get_permalink();

?>

<div <?php post_class( $post_class ); ?>>
  <div class="relative">
    <?php
      narasix_featured_img( array(
        'size' => $thumb_size,
        'icon' => $post_format_icon,
        'lazyload' => $lazyload,
        'class' => 'aspect-autos h-full',
      ) );
    ?>
    
    <div class="absolute flex justify-between w-full top-0 px-3 mt-3">
      <?php  
        if ( $post_meta_category == 'yes' ) {
          narasix_post_categories_with_background(); 
        }
      ?>

      <?php if ( isset( $post_index ) ) { ?>
        <span class="absolute text-charcoal-100 right-[0.7rem] -mt-2 italic text-[30px] sm:text-4xl font-[fangsong]">
          <?php echo esc_html( sprintf( '%02d', $post_index ) ); ?>
        </span>
      <?php } ?>
    </div>

  </div>

  <div class="w-full p-2">

    <h3 class="font-heading secondary line-clamp-2">
      <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h3>

    <?php
      if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
        ?>
          <p class="line-clamp-1 xs:line-clamp-2 sm:line-clamp-3 mt-2 text-sm leading-relaxed opacity-50">
            <?php narasix_excerpt( $excerpt_length, true ); ?>
          </p>
        <?php
      }
    ?>

    <div class="font-meta mt-1 flex justify-between items-center border-t secondary pt-1 text-sm">
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
