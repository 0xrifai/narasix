<?php
/**
 * Footer Layout C
 */
$footer_social_switch = narasix_get_option( 'footer_social_media_switch', 'yes' );
$footer_copyright = narasix_get_option( 'footer_copyright', 'Made by © <a href="#" target="_blank" rel="nofollow">Hidunks Studio</a>' );
$menu_class = 'flex flex-wrap space-x-4 text-center';
?>

<div class="mt-6 py-6 flex flex-col items-center justify-between space-y-3 md:flex-row">
  <?php get_template_part( 'template-parts/footer/component/footer-branding' ); ?>
  <nav aria-label="<?php esc_attr_e( 'Footer Menu', 'narasix' ); ?>">
      <?php
      wp_nav_menu( array(
      'theme_location' => 'footer',
      'menu_class'     => $menu_class,
      'container' 	 => false,
      ) );
      ?>
  </nav>
  <!-- #footer-navigation -->
</div>
<div class="flex justify-between items-center border-t py-5 justify-items-center mt-3 text-center max-sm:flex-col">
  <div>
  <?php if ( $footer_copyright !== '' ) {
  ?>
    <?php echo wp_kses_post( $footer_copyright ); ?>
  <?php
  } 
  ?>
  </div>
  
  <div class="order- max-sm:order-first max-sm:mb-3">
    <?php
      if ( $footer_social_switch === 'yes' ) {
        ?>
          <?php narasix_get_template_part( 'template-parts/misc/social-inline' ); ?>
        <?php
      }
    ?>
  </div>
</div>
