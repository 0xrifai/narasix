<?php
/**
 * Page Content
 */
?>
<div class="section w-full">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-post-content-wrapper">
      <div class="wysiwyg wysiwyg-slate max-w-full space-y-4 sm:space-y-6 dark:wysiwyg-invert clearfix">
        <?php
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
      </div>
    </div>
  </div>
</div>

<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
?>
  <div class="nsix-section w-full post-comments-section">
    <div class="container-post-body">
      <?php comments_template(); ?>
    </div>
  </div>
<?php
}