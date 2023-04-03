<?php
/**
 * The template for displaying the 404 template.
 *
 */

// Get options.
$page_404_title = narasix_get_option( 'page_404_title', esc_html__( 'Page not found', 'narasix' ) );
$page_404_body_text = narasix_get_option( 'page_404_body_text', 'The page you were looking for could not be found.<br/> It might have been removed, renamed, or did not exist in the first place.' );

get_header();
?>
<div class="flex h-[calc(100vh-80px)] items-center justify-center p-5 w-full">
  <div class="text-center">
    <div class="inline-flex rounded-full bg-yellow-100 p-4">
      <div class="rounded-full stroke-yellow-600 bg-yellow-200 p-4">
        <svg class="w-16 h-16" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.0002 9.33337V14M14.0002 18.6667H14.0118M25.6668 14C25.6668 20.4434 20.4435 25.6667 14.0002 25.6667C7.55684 25.6667 2.3335 20.4434 2.3335 14C2.3335 7.55672 7.55684 2.33337 14.0002 2.33337C20.4435 2.33337 25.6668 7.55672 25.6668 14Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </div>
    </div>
		<?php
			if ( $page_404_title !== '' ) {
				?>
					<h1 class="mt-5 !text-[36px] font-bold !lg:text-[50px]"><?php echo wp_kses_post( $page_404_title ); ?></h1>
				<?php
			}
		?>
		<?php
			if ( $page_404_body_text !== '' ) {
				?>
					<p class="text-slate-600 mt-5 lg:text-lg"><?php echo wp_kses_post( $page_404_body_text ); ?></p>
				<?php
			}
		?>
  </div>
</div>
<?php get_footer();