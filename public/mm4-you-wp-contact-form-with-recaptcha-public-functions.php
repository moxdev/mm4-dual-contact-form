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
		<label for="company">Company Name*
			<input type="text" name="company" id="company" class="required" data-error-label="Company Name">
		</label>
		<label for="first-name">First Name*
			<input type="text" name="first-name" id="first-name" class="required" data-error-label="First Name">
		</label>
		<label for="last-name">Last Name*
			<input type="text" name="last-name" id="last-name" class="required" data-error-label="Last Name">
		</label>
		<label for="title">Your Title*
			<input type="text" name="title" id="title" class="required" data-error-label="Your Title">
		</label>
		<label for="address">Company Address*
			<input type="text" name="address" id="address" class="required" data-error-label="Company Address">
		</label>
		<label for="city">City*
			<input type="text" name="city" id="city" class="required" data-error-label="City">
		</label>
		<label for="state">State*
			<input type="text" name="state" id="state" class="required" data-error-label="State">
		</label>
		<label for="zip">Zip Code*
			<input type="text" name="zip" id="zip" class="required" data-error-label="Zip Code">
		</label>
		<label for="email-address">Your Email Address*
			<input type="email" name="email-address" id="email-address" class="required" data-error-label="Your Email Address">
		</label>
		<label for="phone">Company Phone Number
			<input type="tel" name="phone" id="phone" data-error-label="Company Phone Number">
		</label>
		<label for="plan-label">Which Plan Would You Like?*
			<select name="plan-select" id="plan-select" class="required" data-error-label="Which Plan Would You Like?">
				<option value=''></option>
				<option value='6'>6 Months &dash; $129</option>
				<option value='12'>12 Months &dash; $159</option>
			</select>
		</label>
		<label for="end-user">
			<input type="checkbox" id="end-user" name="end-user"
			value="end-user" class="required" data-error-label="I am an end user of promotional products and use them to brand and market my company" /> I am an end user of promotional products and use them to brand and market my company*
		</label>
		<label for="promo-distributor">
			<input type="checkbox" id="promo-distributor" name="promo-distributor"
			value="promo-distributor" class="required" data-error-label="I am a promotional product distributor" /> I am a promotional product distributor*
		</label>

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
