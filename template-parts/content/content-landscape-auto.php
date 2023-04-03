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
	'border',
	'transition',
) );
$post_image_class = 'post-image';
$post_link =  get_permalink();

?>

<div <?php post_class( $post_class ); ?>>
  <div class="rotate-180 p-2 [writing-mode:_vertical-lr]">
    <time datetime="2022-10-10" class="flex items-center justify-between gap-4 text-xs font-bold uppercase">
      <span><?php the_time('Y'); ?></span>
      <span class="w-px flex-1 bg-charcoal-900/70 dark:bg-fuchsia-200/70"></span>
      <span><?php the_time('M j'); ?></span>
    </time>
  </div>
  <div class="flex flex-1 flex-col justify-between border-l">
    <div class="p-4 sm:p-6">
    <?php  
        if ( $post_meta_category == 'yes' ) { ?>
          <span class="w-[80%] text-[14px]">
            <?php narasix_post_categories(); ?>
          </span>
        <?php
        }
      ?>
      <h3 class="font-heading ">
        <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h3>

      <?php
      if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
      ?>
       <p class="line-clamp-2 sm:line-clamp-3 mt-2 text-sm leading-relaxed opacity-50">
          <?php narasix_excerpt( $excerpt_length, true ); ?>
        </p>
      <?php
      }
      ?>
    </div>

    <div class="sm:flex sm:items-end sm:justify-end">
      <a href="<?php echo esc_url( $post_link ); ?>" class="block bg-yellow-300 px-5 py-3 text-center text-xs font-bold uppercase text-gray-900 transition hover:bg-yellow-400"> 
        <?php echo esc_html__( 'READ BLOG', 'narasix' ) ?>
      </a>
    </div>
  </div>
</div>
