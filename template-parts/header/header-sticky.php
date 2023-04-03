<?php
/**
 * Standard header template
 */

$show_login = narasix_get_option( 'header_show_login', 'yes' );
$section_class = 'backdrop-blur-[8px] shadow-lg site-header-fixed max-lg:!hidden lg:block js-sticky-header';
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$social_sortable = narasix_get_option( 'social_media_sites' );
$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );

if ($content_layout_width === 'default' ) {
	$header_class = 'max-w-7xl';
} else {
	$header_class = 'max-w-' . $content_layout_width;
}

?>
<div class="<?php echo esc_attr( $section_class ); ?>" style="display: none;">
  <div class="<?php echo esc_attr( $header_class ); ?> mx-auto px-4 py-4 flex items-center justify-between lg:px-16">
    <div class="site-header-logo flex">
      <?php get_template_part( 'template-parts/header/component/header-branding', NULL, array( 'logo_variant' => 'sticky' ) ); ?>
      <?php
        if ( has_nav_menu( 'site-header' ) ) {
        ?>
          <div class="site-header-navigation flex items-center ml-5">
            <?php get_template_part( 'template-parts/header/component/navigation-top', 'bar' ); ?>
          </div><!-- .navigation-top -->
        <?php
        }
      ?>
    </div>
    <div>
      <div class="flex items-center space-x-4">
        <?php
					if ( $darkmode_mode_switch === 'yes' ) { ?>
						<button onclick="toggleDarkMode()" class="active:scale-95 mt-[3px]" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix' ) ?>">
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
    </div>
  </div>
</div>


