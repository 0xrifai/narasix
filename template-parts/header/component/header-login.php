<?php
/**
 * Login form modal
 */
?>
<div id="nsix-login-modal" class="modal">
  <div class="modal-dialog md:w-[22rem]">
    <div class="dark:divide-charcoal-800/40 bg-charcoal-100 dark:bg-charcoal-700 h-[22rem] divide-y rounded-t-lg p-0 shadow-lg outline-0 sm:h-auto sm:rounded-lg">
      <div class="w-full space-y-4 rounded p-6">
        <div class="flex justify-between items-center w-full">
          <p class="text-lg"><?php echo esc_html__( 'Login', 'narasix' ); ?></p>
          <button type="button" class="closemodal" data-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'narasix' ); ?>">
						<span aria-hidden="true"><?php echo narasix_svg_icon( array( 'icon' => 'x-circle', 'class' => '' ) ) ;?></span>
			    </button>
        </div>
        <?php $args = array(
            'echo' => true,
            'form_id' => 'loginform',
            'label_username' => __( 'Username', 'narasix' ),
            'label_password' => __( 'Password', 'narasix' ),
            'label_remember' => __( 'Remember Me', 'narasix' ),
            'label_log_in' => __( 'Log In', 'narasix' ),
            'id_username' => 'user_login',
            'id_password' => 'user_pass',
            'id_remember' => 'rememberme',
            'id_submit' => 'wp-submit',
            'remember' => false,
            'value_username' => NULL,
            'value_remember' => false
        );
        wp_login_form( $args );
        ?>
        <div class="flex items-center justify-between">
          <div class="flex flex-row items-center">
            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
            <label id="login" class="ml-2 text-sm font-normal text-gray-600"><?php echo esc_html__( 'Remember me', 'narasix' ); ?></label>
          </div>
          <div>
            <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php echo esc_attr__( 'Forgot Password', 'narasix' ); ?>" class="text-sm text-blue-600 hover:underline"><?php echo esc_html__( 'Forgot Password ?', 'narasix' ); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>