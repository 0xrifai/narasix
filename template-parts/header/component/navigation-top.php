<?php
/**
 * Displays top navigation
 */

$show_login = narasix_get_option( 'header_show_login', 'yes' );
$uppercase_menu = narasix_get_option( 'header_uppercase_menu', 'no' );
$menu_class = 'nsix-navigation nsix-navigation-top navigation flex space-x-5 whitespace-nowrap';
$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );

if ( $uppercase_menu === 'yes' ) {
	$menu_class .= ' uppercase';
}

?>
<nav class="relative flex items-center content-between justify-between py-3">
	<div class="navbar-nav-wrapper hidden lg:flex">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'site-header',
			'menu_id'        => 'top-menu',
			'menu_class'	 => $menu_class,
			'container'		 => false,
			'item_spacing'	 => 'discard',
		) );
		?>
	</div>

	<div class="flex items-center space-x-4">
		<?php
			if ( $darkmode_mode_switch === 'yes' ) { ?>
				<button onclick="NARASIX.documentOnReady.toggleDarkMode()" class="active:scale-95 mt-[3px]" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix' ) ?>">
					<?php echo narasix_svg_icon( array( 'icon' => 'darkmode' ) ) ;?>
				</button>
			<?php }
		?>
		<button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="<?php echo esc_attr( 'Search', 'narasix' ) ?>">
			<?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
		</button>

		<?php
		if ( ( $show_login === 'yes' ) && !is_user_logged_in() ) {
			$header_login_url = narasix_get_option( 'header_login_url', '' );
			if ( $header_login_url !== '' ) {
		?>
			<a href="<?php echo esc_url( $header_login_url ); ?>" class="hidden lg:inline-block"><?php echo narasix_svg_icon( array( 'icon' => 'user' ) ) ;?></a>
		<?php
			} else {
		?>
			<button class="hidden lg:inline-block modal-open" type="button" data-modal="#nsix-login-modal" aria-label="<?php echo esc_attr( 'Login', 'narasix' ) ?>">
				<?php echo narasix_svg_icon( array( 'icon' => 'user' ) ) ;?>
			</button>
		<?php
			}
		}
		?>
	</div>
</nav>
