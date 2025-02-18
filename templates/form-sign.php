<?php
global $typeform;
if ( !$typeform || $typeform == 'sign' )
	$f_sign = 'style="display:block;"';
?>

<div class="form-tab-rcl" id="login-form-rcl" <?php echo $f_sign; ?>>
	<div class="form_head">
		<div class="form_auth form_active"><?php _e( 'Authorization', 'wp-recall' ); ?></div>
		<?php if ( rcl_is_register_open() ): ?>
			<div class="form_reg"><?php if ( !$typeform ) { ?><a href="#" class="link-register-rcl link-tab-rcl "><?php _e( 'Registration', 'wp-recall' ); ?></a><?php } ?></div>
		<?php endif; ?>
	</div>

	<div class="form-block-rcl"><?php rcl_notice_form( 'login' ); ?></div>

	<?php $user_login	 = (isset( $_REQUEST['user_login'] )) ? wp_strip_all_tags( $_REQUEST['user_login'], 0 ) : ''; ?>
	<?php $user_pass	 = (isset( $_REQUEST['user_pass'] )) ? wp_strip_all_tags( $_REQUEST['user_pass'], 0 ) : ''; ?>

	<form action="<?php rcl_form_action( 'login' ); ?>" method="post">
		<div class="form-block-rcl default-field">
			<input required type="text" placeholder="<?php _e( 'Login', 'wp-recall' ); ?>" value="<?php echo $user_login; ?>" name="user_login">
			<i class="rcli fa-user"></i>
			<span class="required">*</span>
		</div>
		<div class="form-block-rcl default-field">
			<input required type="password" placeholder="<?php _e( 'Password', 'wp-recall' ); ?>" value="<?php echo $user_pass; ?>" name="user_pass">
			<i class="rcli fa-lock"></i>
			<span class="required">*</span>
		</div>
		<div class="form-block-rcl">
			<?php do_action( 'login_form' ); ?>

			<div class="default-field rcl-field-input type-checkbox-input">
				<div class="rcl-checkbox-box">
					<input type="checkbox" id="chck_remember" class="checkbox-custom" value="1" name="rememberme">
					<label class="block-label" for="chck_remember"><?php _e( 'Remember', 'wp-recall' ); ?></label>
				</div>
			</div>
		</div>
		<div class="form-block-rcl">
			<?php
			echo rcl_get_button( array(
				'label'	 => __( 'Entry', 'wp-recall' ),
				'submit' => true,
				'class'	 => 'link-tab-form'
			) );
			?>
			<a href="#" class="link-remember-rcl link-tab-rcl "><?php _e( 'Lost your Password', 'wp-recall' ); // Забыли пароль	  ?>?</a>
			<?php echo wp_nonce_field( 'login-key-rcl', 'login_wpnonce', true, false ); ?>
			<input type="hidden" name="redirect_to" value="<?php rcl_referer_url( 'login' ); ?>">
			<input type="hidden" name="submit-login" value="1">
		</div>
	</form>
</div>
