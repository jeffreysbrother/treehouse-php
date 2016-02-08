<?php

/*
	this page handles:
		1) display of the form
		2) handling the submission
		3) displaying the thank you message
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" || $email == "" || $details == "") {
		echo "please specify a value for all input fields";
		exit;
	}
	if ($_POST["address"] != "") {
		echo "Bad form input";
		exit;
	}

	require("inc/phpmailer/class.phpmailer.php");

	$mail = new PHPMailer;

	if (!$mail->ValidateAddress($email)) {
		echo "Invalid Email!";
		exit;
	}

	$email_body = "";
	$email_body .= "Name: " . $name . "\n";
	$email_body .= "Email: " . $email . "\n";
	$email_body .= "Details: " . $details . "\n";

	$mail->setFrom($email, $name);
	$mail->addAddress('jeffreysbrother@gmail.com', 'J Cool');     // Add a recipient

	$mail->isHTML(false);                                  // Set email format to plain text (true is HTML)

	$mail->Subject = 'Personal Media Library Suggestion from ' . $name;
	$mail->Body    = $email_body;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
			exit;
	}

	header("location:suggest.php?status=thanks");
}

$pageTitle = "Suggest a Media Item";
$section = "suggest";

include("inc/header.php"); ?>

<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>
		<?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
			echo "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est deserunt molestiae, hic animi inventore sequi quo ex, delectus suscipit, dolor nulla repellendus officiis.</p>";
		} else { ?>
		<form action="suggest.php" method="post">
			<table>
				<tr>
					<th><label for="name">Name</label></th>
					<td><input type="text" name="name" id="name"/></td>
				</tr>
				<tr>
					<th><label for="email">Email</label></th>
					<td><input type="text" name="email" id="email"/></td>
				</tr>
				<tr>
					<th><label for="details">Suggest Item Details</label></th>
					<td><textarea name="details" id="details" rows="5"></textarea></td>
				</tr>

				<!-- spam honeypot below-->
				<tr style="display:none">
					<th><label for="address">Address</label></th>
					<td><input type="text" name="address" id="address"/>
						<p>please leave this field blank</p>
					</td>
				</tr>

			</table>
			<input type="submit" value="Send" />
		</form>
		<?php } ?>
	</div>
</div>

<?php include("inc/footer.php"); ?>
