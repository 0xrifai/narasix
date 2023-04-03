<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';
( isset( $excerpt_length ) ) || $excerpt_length = 100;
( isset( $lazyload ) ) || $lazyload = true;

$post_class = array_merge( $post_class, array(
	'max-md:flex-col',
	'md:flex',
	'transition',
) );

$post_link =  get_permalink();
$post_time_attr = get_the_time( 'c' );
$post_time = get_the_time( get_option( 'date_format' ) );

?> 
<div class="grid gap-8 lg:grid-cols-5 lg:gap-12">
  <div class="lg:col-span-3">
    <div class="overflow-hidden max-lg:h-96 lg:aspect-square">
      <?php
        narasix_featured_img( array(
          'size' => $thumb_size,
          'icon' => $post_format_icon,
          'lazyload' => $lazyload,
          'class' => 'aspect-autos absolute inset-0 h-full w-full object-cover',
        ) );
      ?>
    </div>
  </div>
  <div class="lg:col-span-2 lg:flex lg:flex-col lg:justify-center">

    <div class="font-meta mb-3">
      <?php
      if ( $post_meta_author == 'yes' ) {
        echo '<span class="dots text-[17px]">'. get_the_author_posts_link() . '</span>';
      }
      ?>

      <?php  
        if ( $post_meta_category == 'yes' ) { ?>
          <span class="dot text-[17px]">
            <?php narasix_post_categories();  ?>
          </span>
        <?php
        }
      ?>

      <?php  
        if ( $post_meta_date == 'yes' ) { ?>
          <?php 
            echo '<span class="text-[17px]">';
            echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
            echo '</span>';
          ?>
          
        <?php
        }
      ?>
    </div>

    <h2 class="mb-4 font-heading text-2xl font-bold sm:text-3xl md:mb-6">
      <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"> <?php the_title(); ?> </a>
    </h2>

    <?php
      if( get_the_excerpt() && ( $excerpt_length > 0 ) ) { 
      ?> 
        <p class="descripiton mt-4 leading-relaxed opacity-50"> <?php narasix_excerpt( $excerpt_length, true ); ?> </p> <?php
    } ?> 
    <a href="<?php echo esc_url( $post_link ); ?>" class="e_button rounded-md border border-blue-500 px-4 py-2 font-medium text-blue-600 transition hover:bg-blue-500 hover:text-white">
      <span> Learn more </span>
    </a>
  </div>
</div>
