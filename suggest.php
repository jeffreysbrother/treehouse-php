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
	$category = trim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING));
	$title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
	$format = trim(filter_input(INPUT_POST, "format", FILTER_SANITIZE_STRING));
	$genre = trim(filter_input(INPUT_POST, "genre", FILTER_SANITIZE_STRING));
	$year = trim(filter_input(INPUT_POST, "year", FILTER_SANITIZE_STRING));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" || $email == "" || $category == "" || $title == "") {
		echo "please specify a value for all required input fields";
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
	$email_body .= "Suggested Item\n";
	$email_body .= "Category: " . $category . "\n";
	$email_body .= "Title: " . $title . "\n";
	$email_body .= "Format: " . $format . "\n";
	$email_body .= "Genre: " . $genre . "\n";
	$email_body .= "Year: " . $year . "\n";
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
					<th><label for="name">Name (required)</label></th>
					<td><input type="text" name="name" id="name"/></td>
				</tr>
				<tr>
					<th><label for="email">Email (required)</label></th>
					<td><input type="text" name="email" id="email"/></td>
				</tr>
				<tr>
					<th><label for="category">Category (required)</label></th>
					<td><select name="category" id="category"/>
						<option value="">Select One</option>
						<option value="Books">Book</option>
						<option value="Movies">Movie</option>
						<option value="Muisc">Music</option>
					</select></td>
				</tr>
				<tr>
					<th><label for="title">Title (required)</label></th>
					<td><input type="text" name="title" id="title"/></td>
				</tr>
				<tr>
					<th><label for="format">Format</label></th>
					<td><select name="format" id="format"/>
						<option value="">Select One</option>
						<optgroup label="Books">
							<option value="Audio">Audio</option>
							<option value="Ebook">Ebook</option>
							<option value="Hardback">Hardback</option>
							<option value="Paperback">Paperback</option>
						</optgroup>

						<optgroup label="Movies">
							<option value="Blu-ray">Blu-ray</option>
							<option value="DVD">DVD</option>
							<option value="Streaming">Streaming</option>
							<option value="VHS">VHS</option>
						</optgroup>

						<optgroup label="Music">
							<option value="Cassette">Cassette</option>
							<option value="CD">CD</option>
							<option value="MP3">MP3</option>
							<option value="VInyl">Vinyl</option>
						</optgroup>
					</select></td>
				</tr>

        <tr>
            <th>
                <label for="genre">Genre</label>
            </th>
            <td>
                <select name="genre" id="genre">
                    <option value="">Select One</option>
                    <optgroup label="Books">
                        <option value="Action">Action</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Historical">Historical</option>
                        <option value="Historical Fiction">Historical Fiction</option>
                        <option value="Horror">Horror</option>
                        <option value="Magical Realism">Magical Realism</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Paranoid">Paranoid</option>
                        <option value="Philosophical">Philosophical</option>
                        <option value="Political">Political</option>
                        <option value="Romance">Romance</option>
                        <option value="Saga">Saga</option>
                        <option value="Satire">Satire</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Tech">Tech</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Urban">Urban</option>
                    </optgroup>
                    <optgroup label="Movies">
                        <option value="Action">Action</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Animation">Animation</option>
                        <option value="Biography">Biography</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Crime">Crime</option>
                        <option value="Documentary">Documentary</option>
                        <option value="Drama">Drama</option>
                        <option value="Family">Family</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Film-Noir">Film-Noir</option>
                        <option value="History">History</option>
                        <option value="Horror">Horror</option>
                        <option value="Musical">Musical</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Sport">Sport</option>
                        <option value="Thriller">Thriller</option>
                        <option value="War">War</option>
                        <option value="Western">Western</option>
                    </optgroup>
                    <optgroup label="Music">
                        <option value="Alternative">Alternative</option>
                        <option value="Blues">Blues</option>
                        <option value="Classical">Classical</option>
                        <option value="Country">Country</option>
                        <option value="Dance">Dance</option>
                        <option value="Easy Listening">Easy Listening</option>
                        <option value="Electronic">Electronic</option>
                        <option value="Folk">Folk</option>
                        <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                        <option value="Inspirational/Gospel">Insirational/Gospel</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Latin">Latin</option>
                        <option value="New Age">New Age</option>
                        <option value="Opera">Opera</option>
                        <option value="Pop">Pop</option>
                        <option value="R&amp;B/Soul">R&amp;B/Soul</option>
                        <option value="Reggae">Reggae</option>
                        <option value="Rock">Rock</option>
                    </optgroup>
                </select>
            </td>
        </tr>

				<tr>
					<th><label for="year">Year</label></th>
					<td><input type="text" name="year" id="year"/></td>
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
