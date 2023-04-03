<?php
/**
 * Menu Canvas Mobile
 */
?>
<div id="nsix-offcanvas-primary" class="js-nsix-offcanvas nsix-offcanvas">
	<header class="flex h-16 items-center justify-between border-b mb-2 py-4 px-4">
		<?php
			$offcanvas_logo = narasix_get_option( 'offcanvas_logo', array() );
			if ( !empty( $offcanvas_logo ) ) {
			?>
				<div class="offcanvas-logo text-center">
					<?php
					narasix_get_template_part( 'template-parts/header/component/header-branding', NULL,
						array(
							'logo_variant' => 'offcanvas',
						)
					);
					?>
				</div>
			<?php
			}
		?>

		<a href="" class="offcanvas-close pb-[5px] pt-[2px] px-[10px] bg-yellow-500 rounded-md js-nsix-offcanvas-close" role="button" aria-label="<?php echo esc_attr( 'Close', 'narasix' ); ?>">
			<?php echo narasix_svg_icon( array( 'icon' => 'x-circle', 'class' => 'icons-md' ) ) ;?>
		</a>
	</header>

	<?php
	if ( has_nav_menu( 'mobile' ) || ( ( !has_nav_menu( 'mobile' ) && ( has_nav_menu( 'site-header' ) ) ) ) ) {
	?>
	<div class="offcanvas-navigation px-6 dark:text-charcoal-900">
		<?php
		if ( has_nav_menu( 'offcanvas' ) ) {
			$menu_location = 'offcanvas';
		} else {
			$menu_location = 'site-header';
		}

		$uppercase_menu = narasix_get_option( 'header_uppercase_menu', 'no' );
		$bold_menu = narasix_get_option( 'header-menu-bold', true );
		$menu_class = 'offcanvas-menu nsix-navigation navigation';

		if ( $uppercase_menu === 'yes' ) {
			$menu_class .= ' uppercase';
		}

		wp_nav_menu( array(
			'theme_location' => $menu_location,
			'menu_id'        => 'offcanvas-menu',
			'menu_class'	 => $menu_class,
			'container'		 => false,
			'item_spacing'	 => 'discard',
		) );
		?>
	</div>
	<?php
	}
	?>

	<?php
	if ( is_active_sidebar( 'nsix-offcanvas' ) ) {
	?>
		<div class="offcanvas-widget-area offcanvas-section">
			<?php dynamic_sidebar( 'nsix-offcanvas' ); ?>
		</div>
	<?php
	}
	?>

	<div class="offcanvas-social flex items-center py-4 px-6 border-t justify-between">
		<?php
			$show_login = narasix_get_option( 'header_show_login', 'yes' );
			if ( ( $show_login === 'yes' ) && !is_user_logged_in() ) {
				$header_login_url = narasix_get_option( 'header_login_url', '' );
				if ( $header_login_url !== '' ) {
			?>
				<a href="<?php echo esc_url( $header_login_url ); ?>" class="offcanvas-login-toggler"><?php echo narasix_svg_icon( array( 'icon' => 'user', 'class' => 'icons-md' ) ) ;?></a>
			<?php
				} else {
			?>
				<button class="navbar-login-toggler modal-open" type="button" data-modal="#nsix-login-modal" aria-label="<?php echo esc_attr( 'Login', 'narasix' ) ?>">
					<?php echo narasix_svg_icon( array( 'icon' => 'user' ) ) ;?>
				</button>
			<?php
				}
			}
		?>
		<?php get_template_part( 'template-parts/misc/social-inline' ); ?>
	</div>
</div>