<?php
/**
 * Footer Layout A
 */
$footer_social_switch = narasix_get_option( 'footer_social_media_switch', 'yes' );
$footer_copyright = narasix_get_option( 'footer_copyright', 'Made by © <a href="#" target="_blank" rel="nofollow">Hidunks Studio</a>' );
$footer_about = narasix_get_option( 'footer_about', esc_html__( 'Doloribus consectetur quasi ipsa quo neque culpa blanditiis ducimus recusandae a veritatis optio cumque, in harum ad nam!', 'narasix' ) );
?>

<div class="mb-8 grid gap-16 pt-6 lg:grid-cols-6">
  <div class="md:max-w-md lg:col-span-2">
    <?php get_template_part( 'template-parts/footer/component/footer-branding' ); ?>
    <div class="mt-4 lg:max-w-sm">
      <?php if ( $footer_about !== '' ) {
        ?>
          <p class="text-sm "><?php echo wp_kses_post( $footer_about ); ?></p>
        <?php
      } ?>
    </div>
  </div>
  <div class="grid grid-cols-2 gap-4 md:gap-5 md:grid-cols-4 lg:col-span-4">
      <?php
        if ( is_active_sidebar( 'nsix-footer-1' ) ) {
        ?>
          <div>
            <?php dynamic_sidebar( 'nsix-footer-1' ); ?>
          </div>
        <?php
        }
      ?>
      <?php
        if ( is_active_sidebar( 'nsix-footer-2' ) ) {
        ?>
          <div>
            <?php dynamic_sidebar( 'nsix-footer-2' ); ?>
          </div>
        <?php
        }
      ?>
      <?php
        if ( is_active_sidebar( 'nsix-footer-3' ) ) {
        ?>
          <div>
            <?php dynamic_sidebar( 'nsix-footer-3' ); ?>
          </div>
        <?php
        }
      ?>
      <?php
        if ( is_active_sidebar( 'nsix-footer-4' ) ) {
        ?>
          <div>
            <?php dynamic_sidebar( 'nsix-footer-4' ); ?>
          </div>
        <?php
        }
      ?>
  </div>
</div>
<div class="flex flex-col justify-between border-t py-5 sm:flex-row">  
  <?php if ( $footer_copyright !== '' ) {
    ?>
      <p class="text-sm"><?php echo wp_kses_post( $footer_copyright ); ?></p>
    <?php
  } ?>

  <div class="mt-4 flex items-center space-x-4 sm:mt-0">
    <?php
      if ( $footer_social_switch === 'yes' ) {
        ?>
          <?php narasix_get_template_part( 'template-parts/misc/social-inline' ); ?>
        <?php
      }
    ?>
  </div>
</div>