<?php
/**
 * The template for displaying all single posts
 */

// Get options.

$toc_switch = narasix_get_meta_box( 'post_table_of_content' );
if ( !$toc_switch || ( $toc_switch === 'global') ) {
	$toc_switch = narasix_get_option( 'single_toc_posts_switch', 'yes' );
}

$social_share_switch = narasix_get_option( 'single_social_share_switch', 'yes' );
$social_share_switch = narasix_get_option( 'single_social_share_switch', 'yes' );
$author_box_switch = narasix_get_option( 'single_author_box_switch', 'yes' );

// Setting up variables.
$post_url =  get_permalink();
$post_format = get_post_format();
$post_image = NULL;

$classes = array(
	'wysiwyg',
	'wysiwyg-slate',
	'max-w-full',
	'space-y-4',
	'sm:space-y-6',
	'dark:wysiwyg-invert',
);

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
 

    <?php 
    if ( $toc_switch === 'yes' ) {
      require get_template_directory() . '/template-parts/single/component/table-of-contents.php';
    }
    
    the_content(); 
    ?>
    

      <?php
      wp_link_pages( array(
        'before'      		=> '<div class="nsix-post-pagination font-meta">' . '<span class="nsix-post-pagination-heading">' . esc_html__( 'Pages:', 'narasix' ) . '</span>',
        'after'       		=> '</div>',
        'linkbefore'      		=> '<span class="nsix-post-pagination-item">' . esc_html__( 'Pages:', 'narasix' ),
        'linkafter'       		=> '</span>',
        'next_or_number'	=> 'next_and_number',
        'nextpagelink'     	=> esc_html__( 'Next page', 'narasix' ),
            'previouspagelink' 	=> esc_html__( 'Previous page', 'narasix' ),
      ) );
    ?>
    
    <div class="relative not-wysiwyg border-t pt-4">
        <?php
          $post_categories = get_the_category();
          if ( $post_categories ) {
          ?>
          <div class="flex items-center space-x-3">
            <h5 class="font-heading !text-lg whitespace-nowrap"><?php echo esc_html__( 'Filed under :', 'narasix' ) ?></h5>
            <?php
              narasix_post_categories_with_count();
            ?>
          </div>
          <?php
          }
        ?>

        <?php
          $post_tags = get_the_tags();
          if ( $post_tags ) {
          ?>
          <div class="flex items-center space-x-3">
            <h5 class="font-heading !text-lg whitespace-nowrap"><?php echo esc_html__( 'Tags :', 'narasix' ) ?></h5>
            <?php
              narasix_post_tags();
            ?>
          </div>
          <?php
          }
        ?>

      <?php
        $author_bio = get_the_author_meta( 'description' );
        if ( ( $author_bio !== '' ) && ( $author_box_switch === 'yes' ) ) {
          ?>
            <div class="mt-8">
              <?php
              get_template_part( 'template-parts/misc/author-box' );
              ?>
            </div>
          <?php
        }
      ?>

    </div>
    
    <div class="mt-6">
      <?php
      the_post_navigation( array(
        'prev_text' => '<div aria-hidden="true" class="nav-subtitle font-meta">' . esc_html__( 'Previous', 'narasix' ) . '</div><h4 class="nav-title">%title</h4>',
        'next_text' => '<div aria-hidden="true" class="nav-subtitle font-meta">' . esc_html__( 'Next', 'narasix' ) . '</div><h4 class="nav-title">%title</h4>',
      ) );
      ?>
    </div>
	</article>



