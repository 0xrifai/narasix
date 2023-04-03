<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $post_class ) ) || $post_class = array();
( isset( $post_meta_category ) ) || $post_meta_category = 'yes';
( isset( $post_meta_author ) ) || $post_meta_author = 'yes';
( isset( $post_meta_date ) ) || $post_meta_date = 'yes';

$post_link =  get_permalink();
$post_class = array_merge( $post_class, array(
	'group',
	'content-small',
	'flex',
	'items-center',
	'justify-between',
) );

?>

<div <?php post_class( $post_class ); ?>>
  <div class="mr-2 w-full">
		<?php  
      if ( $post_meta_category == 'yes' ) { ?>
        <div class="mt-1 flex items-center text-slate-800 dark:text-slate-100">
          <?php narasix_post_categories(); ?>
        </div>
      <?php
      }
    ?>
    <h3 class="line-clamp-2 mb-1">
			<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>

    <div class="font-meta meta-scroll flex justify-between overflow-x-auto text-[14px] border-t mt-2 pt-2">
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