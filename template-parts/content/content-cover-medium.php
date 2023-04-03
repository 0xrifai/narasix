<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';

$post_class = array_merge( $post_class, array(
	'post-item',
	'post-overlay',
) );

$post_link =  get_permalink();

$post_class = array(
  'relative',
  'h-[14rem]',
  'w-full',
  'bg-cover',
  'bg-center',
  'bg-no-repeat'
);
?>

<div <?php post_class( $post_class ); ?> <?php if ( has_post_thumbnail() ) { ?> style="background-image: url('<?php the_post_thumbnail_url( $thumb_size ); ?> ');"<?php } ?>>

  <div class="absolute flex justify-between w-full top-0 px-3 mt-3">
    <?php  
      if ( $post_meta_category == 'yes' ) { ?>
        <span class="font-meta w-[80%]">
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
  <div class="absolute bottom-0 w-full rounded_b p-4 pt-32 text-charcoal-100 bg-gradient-to-t from-charcoal-900/90 via-transparent"> <!--BG -->
    <h3 class="font-heading line-clamp-2">
      <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h3>
    <div class="font-meta flex justify-between items-center space-x-2 meta-scroll overflow-auto text-[14px] border-t border-charcoal-100 mt-2 pt-2">
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