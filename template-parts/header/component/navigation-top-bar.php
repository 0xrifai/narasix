<?php
/**
 * Displays top navigation
 */

$uppercase_menu = narasix_get_option( 'header_uppercase_menu', 'no' );
$menu_class = 'nsix-navigation nsix-navigation-top navigation flex space-x-5 whitespace-nowrap';

if ( $uppercase_menu === 'yes' ) {
	$menu_class .= ' uppercase';
}

?>
<nav class="relative flex items-center content-between justify-between">
	<div class="navbar-nav-wrapper hidden lg:flex">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'site-header',
			'menu_id'        => 'top-menu-sticky',
			'menu_class'	 => $menu_class,
			'container'		 => false,
			'item_spacing'	 => 'discard',
		) );
		?>
	</div>
</nav>
