<?php
/**
 * Display user profile box.
 */

$show_info = narasix_get_option( 'single_author_box_info', 'yes' );
$author_bio = get_the_author_meta( 'description' );
if ( ( $author_bio === '' ) && is_single() ) {
	return; // do not display author box on single page if there's no bio set.
}
$author_id = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name', $author_id );
// $author_website = get_the_author_meta( 'url', $author_id );
// $author_post_counts = count_user_posts( $author_id );
?>
<div class="not-wysiwyg rounded-lg shadow-lg bg-white dark:bg-charcoal-700">
  <div class="flex h-full flex-col">
    <!-- Card top -->
    <div class="flex-grow p-5">
      <div class="flex items-start justify-between">
        <!-- Image + name -->
        <header>
          <div class="mb-2 flex items-center">
            <a class="relative mr-5 inline-flex items-start" href="#0">
              <div class="absolute top-0 right-0 -mr-2 rounded-full bg-white shadow" aria-hidden="true">
                <svg class="h-8 w-8 fill-current text-yellow-500" viewBox="0 0 32 32">
                  <path d="M21 14.077a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 010 1.5 1.5 1.5 0 00-1.5 1.5.75.75 0 01-.75.75zM14 24.077a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z"/>
                </svg>
              </div>
              <div class="author-avatar-box">
								<?php echo get_avatar( $author_id, 100, '', esc_html__( 'avatar', 'narasix' ) ); ?>
							</div>
            </a>
            <div class="mt-1 pr-1">
              <div class="flex items-center"><span><?php echo esc_html__( 'Written by', 'narasix'  ); ?></span></div>
              <span class="inline-flex">
                <h2 class="justify-center text-xl font-semibold leading-snug">
                  <?php the_author_posts_link(); ?>
                </h2>
              </span>
              <div></div>
            </div>
          </div>
        </header>
      </div>
      <?php
      if ( $show_info === 'yes' ) {
      ?>
        <!-- Back to top button -->
        <div class="text-sm line-clamp-1 xs:line-clamp-2 sm:line-clamp-3 mt-2 leading-relaxed opacity-50"><?php echo esc_html( $author_bio ); ?></div>
      <?php
      }
      ?>
      
    </div>
  </div>
</div>