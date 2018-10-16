<?php
$options = get_option( 'mm4-you-wp-contact-form-with-recaptcha-options', array() );

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$recipients = $options["registration_to_address"];
	//$recipients = 'cstielper@mm4solutions.com';
	$email_from = $options["registration_from_address"];
	$name_from = $options["registration_from_name"];
	$subject = $options["registration_subject_line"];
	$secret_key = $options['recaptcha_private_key'];
	$captcha = $_POST['g-recaptcha-response'];

	$company = stripslashes_deep(sanitize_text_field($_POST["company"]));
	$first_name = stripslashes_deep(sanitize_text_field($_POST["first-name"]));
	$last_name = stripslashes_deep(sanitize_text_field($_POST["last-name"]));
	$title = stripslashes_deep(sanitize_text_field($_POST["title"]));
	$address = stripslashes_deep(sanitize_text_field($_POST["address"]));
	$city = stripslashes_deep(sanitize_text_field($_POST["city"]));
	$state = stripslashes_deep(sanitize_text_field($_POST["state"]));
	$zip = stripslashes_deep(sanitize_text_field($_POST["zip"]));
	$email= stripslashes_deep(sanitize_email($_POST["email-address"]));
	$phone = stripslashes_deep(sanitize_text_field($_POST["phone"]));
	$plan = stripslashes_deep(($_POST["plan-select"]));
	$checkboxs = esc_html(trim(implode(', ', $_POST['check_list']))) ;


	if(!$captcha){
		output_error( 'Please go back and check the spam protection checkbox.' );
		exit();
	}

	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

	$message = "
		<!DOCTYPE html>
		<html>
			<head>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<meta http-equiv='X-UA-Compatible' content='ie=edge'>
			</head>
			<body>
				<div style='background-color: #f7f7f7; font-family: sans-serif; padding: 20px;'>
					<h3>Join PromoBox Form Submission:</h3>
					<em>Company Name:</em> $company<br>
					<em>First Name:</em> $first_name<br>
					<em>Last Name:</em> $last_name<br>
					<em>Title:</em> $title<br>
					<em>Company Address:</em> $address<br>
					<em>City:</em> $city<br>
					<em>State:</em> $state<br>
					<em>Zip Code:</em> $zip<br>
					<em>Your Email:</em> $email<br>
					<em>Company Phone Number:</em> $phone<br>
					<em>Subscription Plan:</em> $plan Months<br>
					<em>I am a:</em> $checkboxs<br>
				</div>
			</body>
		</html>
	";

	$headers[] = 'From: ' . $name_from . ' <' . $email_from . '>' . "\r\n";
	$headers[] = 'MIME-Version: 1.0' . "\r\n";
  $headers[] = 'Content-type: text/html; charset="UTF-8' . "\r\n";

	if($response.success == false) {
		output_error( 'We\'re sorry, but you appear to be a spambot.' );
		exit();
	} else {
		wp_mail( $recipients, $subject, $message, $headers );
	}
} else {
	output_error( 'We\'re sorry, but this page cannot be accessed directly.' );
	exit();
}

function output_error( $error ) { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<meta http-equiv='X-UA-Compatible' content='ie=edge'>
			<title>Error</title>
		</head>
		<body style='background-color: #ececec; font-family: sans-serif; padding: 20px;'>
			<div>
				<h3><?php echo $error; ?></h3>
			</div>
		</body>
	</html>
<?php }