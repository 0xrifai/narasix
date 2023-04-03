<?php
/**
 * Template Name: Narasix Blank Page
 *
 * This is the blank template for using with page builder.
 */

get_header();
?>
<main class="site-main">

	<?php
	while ( have_posts() ) {
		the_post();?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->

	<?php
	} // End of the loop.
	?>

</main><!-- #main -->
<?php
get_footer();