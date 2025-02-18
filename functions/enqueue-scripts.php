<?php

function rcl_iconpicker() {
	wp_enqueue_style( 'rcl-iconpicker', RCL_URL . 'assets/rcl-awesome/iconpicker/iconpicker.css' );
	wp_enqueue_script( 'rcl-iconpicker', RCL_URL . 'assets/rcl-awesome/iconpicker/iconpicker.js', array( 'jquery' ), VER_RCL );
}

function rcl_sortable_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-sortable' );
}

function rcl_resizable_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-resizable' );
}

function rcl_multiselect_scripts() {
	wp_enqueue_script( 'jquery' );
	rcl_enqueue_style( 'f-select', RCL_URL . 'assets/js/fselect/fSelect.css' );
	wp_enqueue_script( 'f-select', RCL_URL . 'assets/js/fselect/fSelect.js' );
}

function rcl_uploader_scripts() {
	wp_enqueue_style( 'rcl-uploader-style', plugins_url( 'assets/css/uploader.css', dirname( __FILE__ ) ) );
	wp_enqueue_script( 'rcl-uploader-scripts', plugins_url( 'assets/js/uploader.js', dirname( __FILE__ ) ), array( 'jquery' ) );
}

function rcl_slider_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'jquery-touch-punch' );
}

function rcl_datepicker_scripts() {
	wp_enqueue_style( 'jquery-ui-datepicker', RCL_URL . 'assets/js/datepicker/style.css' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
}

function rcl_image_slider_scripts() {
	rcl_enqueue_style( 'jssor-slider', RCL_URL . 'assets/css/slider.css' );
	wp_enqueue_script( 'jquery' );
	rcl_enqueue_script( 'jssor-slider', RCL_URL . 'assets/js/jssor.slider/js/jssor.slider.min.js' );
}

function rcl_dialog_scripts() {
	rcl_enqueue_style( 'ssi-modal', RCL_URL . 'assets/js/ssi-modal/ssi-modal.min.css' );
	rcl_enqueue_script( 'ssi-modal', RCL_URL . 'assets/js/ssi-modal/ssi-modal.min.js' );
}

function rcl_webcam_scripts() {
	rcl_enqueue_script( 'say-cheese', RCL_URL . 'assets/js/say-cheese/say-cheese.js', array(), VER_RCL, true );
}

function rcl_fileupload_scripts() {
	rcl_enqueue_script( 'jquery-ui-widget', RCL_URL . 'assets/js/fileupload/js/vendor/jquery.ui.widget.js', array(), true );

	rcl_enqueue_script( 'load-image', RCL_URL . 'assets/js/fileupload/js/load-image.all.min.js', array(), true );
	rcl_enqueue_script( 'canvas-to-blob', RCL_URL . 'assets/js/fileupload/js/canvas-to-blob.min.js', array(), true );

	rcl_enqueue_script( 'jquery-iframe-transport', RCL_URL . 'assets/js/fileupload/js/jquery.iframe-transport.js', array(), true );
	rcl_enqueue_script( 'jquery-fileupload', RCL_URL . 'assets/js/fileupload/js/jquery.fileupload.js', array(), true );
	rcl_enqueue_script( 'jquery-fileupload-process', RCL_URL . 'assets/js/fileupload/js/jquery.fileupload-process.js', array(), true );
	rcl_enqueue_script( 'jquery-fileupload-image', RCL_URL . 'assets/js/fileupload/js/jquery.fileupload-image.js', array(), true );
}

function rcl_crop_scripts() {
	wp_enqueue_style( 'jcrop' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jcrop' );
}

function rcl_rangyinputs_scripts() {
	rcl_enqueue_script( 'rangyinputs', RCL_URL . 'assets/js/rangyinputs.js' );
}

function rcl_font_awesome_style( $fontAwesome = true ) {

	//if( wp_style_is( 'font-awesome' ) )
	//wp_deregister_style('font-awesome');
	//load fonawesome 4 cdn
	//if($fontAwesome && rcl_get_option('font-awesome',1))
	//wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/5ca1160808.css' );
	//wp_enqueue_style( 'rcl-awesome', RCL_URL . 'assets/rcl-awesome/rcl-awesome.min.css' );
	wp_enqueue_style( 'rcl-awesome', RCL_URL . 'assets/rcl-awesome/rcl-awesome.css' );
	//wp_enqueue_style( 'rcl-icons', RCL_URL.'assets/icons/style.css' );
	//wp_enqueue_script( 'rcl-icons', RCL_URL.'assets/icons/icons-load.js', array(), VER_RCL, true );
}

function rcl_animate_css() {
	rcl_enqueue_style( 'animate-css', RCL_URL . 'assets/css/animate-css/animate.min.css' );
}

add_action( 'login_enqueue_scripts', 'rcl_enqueue_wp_form_scripts', 1 );
function rcl_enqueue_wp_form_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'rcl-core-scripts', RCL_URL . 'assets/js/core.js', array( 'jquery' ) );
	wp_enqueue_script( 'rcl-primary-scripts', RCL_URL . 'assets/js/scripts.js', array( 'jquery' ) );

	if ( !is_user_logged_in() ) {
		wp_enqueue_style( 'rcl-regform-style', RCL_URL . 'assets/css/regform.css' );
	}
	wp_localize_script( 'jquery', 'Rcl', rcl_get_localize_data() );
}

function rcl_frontend_scripts() {
	global $user_ID, $user_LK, $post;

	rcl_font_awesome_style();
	rcl_animate_css();

	rcl_enqueue_style( 'rcl-core', RCL_URL . 'assets/css/core.css' );
	rcl_enqueue_style( 'rcl-users-list', RCL_URL . 'assets/css/users.css' );

	if ( !is_user_logged_in() ) {
		rcl_enqueue_style( 'rcl-register-form', RCL_URL . 'assets/css/regform.css' );
	}

	wp_enqueue_style( 'rcl-buttons', RCL_URL . 'assets/css/buttons.css', VER_RCL );

	//если используем recallbar, то подключаем его стили
	if ( rcl_get_option( 'view_recallbar' ) ) {
		rcl_enqueue_style( 'rcl-bar', RCL_URL . 'assets/css/recallbar.css' );
	}

	wp_enqueue_script( 'jquery' );

	rcl_uploader_scripts();

	if ( rcl_is_office() ) {
		rcl_dialog_scripts();
		if ( rcl_is_office( $user_ID ) ) {
			rcl_fileupload_scripts();
		}
	}

	rcl_enqueue_script( 'rcl-core-scripts', RCL_URL . 'assets/js/core.js' );
	rcl_enqueue_script( 'rcl-primary-scripts', RCL_URL . 'assets/js/scripts.js' );

	$locData = rcl_get_localize_data();

	if ( rcl_get_option( 'difficulty_parole' ) ) {
		if ( !$user_ID || rcl_is_office( $user_ID ) ) {
			$locData['local']['pass0']	 = __( 'Very weak', 'wp-recall' );
			$locData['local']['pass1']	 = __( 'Weak', 'wp-recall' );
			$locData['local']['pass2']	 = __( 'Worse than average', 'wp-recall' );
			$locData['local']['pass3']	 = __( 'Average', 'wp-recall' );
			$locData['local']['pass4']	 = __( 'Reliable', 'wp-recall' );
			$locData['local']['pass5']	 = __( 'Strong', 'wp-recall' );
		}
	}

	$locData['post_ID']		 = (isset( $post->ID ) && $post->ID) ? ( int ) $post->ID : ( int ) 0;
	$locData['office_ID']	 = ($user_LK) ? ( int ) $user_LK : ( int ) 0;

	wp_localize_script( 'jquery', 'Rcl', $locData );
}

function rcl_get_localize_data() {
	global $user_ID;

	if ( !doing_action( 'wp_head' ) && !doing_action( 'admin_init' ) )
		return false;

	$local = array(
		'save'		 => __( 'Save', 'wp-recall' ),
		'close'		 => __( 'Close', 'wp-recall' ),
		'wait'		 => __( 'Please wait', 'wp-recall' ),
		'preview'	 => __( 'Preview', 'wp-recall' ),
		'error'		 => __( 'Error', 'wp-recall' ),
		'loading'	 => __( 'Loading', 'wp-recall' ),
		'upload'	 => __( 'Upload', 'wp-recall' )
	);

	$data = array(
		'ajax_url'	 => admin_url( 'admin-ajax.php' ),
		'wpurl'		 => get_bloginfo( 'wpurl' ),
		'rcl_url'	 => RCL_URL,
		'user_ID'	 => ( int ) $user_ID,
		'nonce'		 => wp_create_nonce( 'rcl-post-nonce' ),
		'local'		 => apply_filters( 'rcl_js_localize', $local )
	);

	$data['mobile']	 = (wp_is_mobile()) ? ( int ) 1 : ( int ) 0;
	$data['https']	 = @(!isset( $_SERVER["HTTPS"] ) || $_SERVER["HTTPS"] != 'on' ) ? ( int ) 0 : ( int ) 1;
	$data['slider']	 = rcl_get_option( 'slide-pause' ) ? "{auto:true,pause:" . (rcl_get_option( 'slide-pause' ) * 1000) . "}" : "''";

	$data['errors']['required']			 = __( 'Fill in all required fields', 'wp-recall' );
	$data['errors']['pattern']			 = __( 'Specify the data in the required format', 'wp-recall' );
	$data['errors']['number_range']		 = __( 'Specify a number within the allowed range', 'wp-recall' );
	$data['errors']['file_max_size']	 = __( 'File size is exceeded', 'wp-recall' );
	$data['errors']['file_accept']		 = __( 'Invalid file type', 'wp-recall' );
	$data['errors']['required_uploads']	 = __( 'Загрузите файлы', 'wp-recall' );

	return apply_filters( 'rcl_init_js_variables', $data );
}

function rcl_admin_scrips() {

	wp_localize_script( 'jquery', 'Rcl', rcl_get_localize_data() );

	rcl_enqueue_style( 'rcl-core', RCL_URL . 'assets/css/core.css' );
	wp_enqueue_style( 'rcl-admin-style', RCL_URL . 'admin/assets/style.css' );
	wp_enqueue_style( 'rcl-buttons', RCL_URL . 'assets/css/buttons.css', VER_RCL );
	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'jquery' );

	rcl_uploader_scripts();

	wp_enqueue_script( 'rcl-core-scripts', RCL_URL . 'assets/js/core.js', array( 'jquery' ) );
	wp_enqueue_script( 'rcl-admin-scripts', RCL_URL . 'admin/assets/scripts.js', array( 'wp-color-picker' ), VER_RCL );
}
