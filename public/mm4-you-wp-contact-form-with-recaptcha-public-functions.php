<?php

function mm4_you_contact_form() {
	ob_start();
	$options = get_option( 'mm4-you-wp-contact-form-with-recaptcha-options', array() );

	wp_enqueue_script( 'mm4-recaptcha', '//www.google.com/recaptcha/api.js', NULL, NULL, TRUE );
	wp_enqueue_script('mm4-you-validate', plugin_dir_url( dirname(__FILE__) ) . 'public/js/min/mm4-you-validate-min.js', NULL, NULL, TRUE ); ?>

	<form name="mm4-contact-form" class="contact-form" method="POST" action="<?php echo get_permalink($options['thank_you_page_id']); ?>" novalidate>
		<label for="first-name">Your Name*
			<input type="text" name="first-name" id="first-name" class="required" data-error-label="Name">
		</label>
		<label for="email-address">Your Email Address*
			<input type="email" name="email-address" id="email-address" class="required" data-error-label="Email">
		</label>
		<label for="message">Let Us Know What's Up
			<textarea name="message" id="message" rows="6"></textarea>
		</label>
		<div class="g-recaptcha" data-sitekey="<?php echo $options['recaptcha_public_key']; ?>"></div>
		<div class="msg-box"></div>
		<input type="submit" value="Submit">
	</form>
<?php return ob_get_clean();
}

add_shortcode('mm4-cf', 'mm4_you_contact_form');

// Registration Form

function pbc_registration_form() {
	ob_start();
	$options = get_option( 'mm4-you-wp-contact-form-with-recaptcha-options', array() );

	wp_enqueue_script( 'mm4-recaptcha', '//www.google.com/recaptcha/api.js', NULL, NULL, TRUE );
	wp_enqueue_script('mm4-you-validate', plugin_dir_url( dirname(__FILE__) ) . 'public/js/min/mm4-you-validate-min.js', NULL, NULL, TRUE ); ?>

	<form name="mm4-contact-form" class="contact-form" id="mm4-contact-form" method="POST" action="<?php echo get_permalink($options['registration_thank_you_page_id']); ?>" novalidate>
		<label for="full-name">Your Name*
			<input type="text" name="full-name" id="full-name" class="required" data-error-label="Your Name">
		</label>
		<label for="email-address">Your Email Address*
			<input type="email" name="email-address" id="email-address" class="required" data-error-label="Your Email Address">
		</label>
		<label for="primary-phone">Your Phone Number
			<input type="tel" name="primary-phone" id="primary-phone" data-error-label="Phone">
		</label>
		<label for="message">What Should Go Here?
			<textarea name="message" id="message" rows="6"></textarea>
		</label>
		<label for="not-reseller">
			<input type="checkbox" id="not-reseller" name="not-reseller"
			value="not-reseller" class="required" data-error-label="I agree I am not a reseller" />I agree I am not a reseller</label>

		<div class="g-recaptcha" data-sitekey="<?php echo $options['recaptcha_public_key']; ?>"></div>
		<div class="msg-box"></div>
		<input type="submit" value="Submit">
	</form>
<?php return ob_get_clean();
}

add_shortcode('pbc-registration-form', 'pbc_registration_form');

// Add our server-side mail processing script to the "thank you" page
function mm4_you_contact_form_thank_you_page() {
	global $post;
	$ID = $post->ID;
	$options = get_option( 'mm4-you-wp-contact-form-with-recaptcha-options', array() );
	$ty_page = $options['thank_you_page_id'];
	if( $ty_page && $ID == $ty_page ) {
		require __DIR__ . '/../admin/mm4-you-wp-contact-form-with-recaptcha-contact.php';
	}
}
add_action('wp', 'mm4_you_contact_form_thank_you_page', 1);

// Add our server-side mail processing script to the "thank you" page
function pbc_registration_form_thank_you_page() {
	global $post;
	$ID = $post->ID;
	$options = get_option( 'mm4-you-wp-contact-form-with-recaptcha-options', array() );
	$ty_page = $options['registration_thank_you_page_id'];
	if( $ty_page && $ID == $ty_page ) {
		require __DIR__ . '/../admin/pbc-registration-form-with-recaptcha-contact.php';
	}
}
add_action('wp', 'pbc_registration_form_thank_you_page', 1);
