<?php
/* ---------------------------------------------
   EMAIL FORM by Josh Hughes (josh@deaghean.com)
   Free to use and adjust as needed
   --------------------------------------------- */

/* Change these values as needed ($to determines who receives the form data) */

$to = "eric.gianninie@fulbrightmail.org";
$from = "do_not_reply@montreux.io”;
$subject = "Email Form";

/* If you'd like to make sure certain fields have been filled out,
   enter a comma-delimited list of required field names.
   Example: $requiredFields = "field_name1, field_name2"; */

$requiredFields = "";


/* ------- ADVANCED EDITING BELOW THIS LINE ------- */

/* Make sure a form was submitted */

if (!$_POST)
	$missingFields = true;
else
	$missingFields = false;
	
/* Check required fields */

if ((trim($requiredFields) != '') and ($missingFields != true))
{
	$checkFields = explode(',', $requiredFields);
	for ($i = 0; $i < count($checkFields); $i++)
	{
		if (trim($_POST[trim($checkFields[$i])]) == '')
			$missingFields = true;
	}
}

/* If there are missing fields, print an error */

if ($missingFields)
{
	print "<h1>Missing Fields</h1>
	<p>Please go back and fill out all of the required fields.</p>";
}

else
{
	$from = sprintf("From: %s", $from);
	$message = "Submitted Form Values:\n\n";
	
	/* The message is a list in the following format:
	   Field_name: Value of the Field */
	
	foreach($_POST as $key => $value)
		$message .= sprintf("%s: %s\n\n", $key, htmlentities($value));

	/* Send the message */

	$success = mail($to, $subject, $message, $from);
	
	/* Print a success or error message */
	
	if ($success)
		print "<h1>Form Sent!</h1>
		<p>Thank you for your submission!</p>";
	else
		print "<h1>Error!</h1>
		<p>The form was <strong>NOT</strong> sent! There seems to be some sort of malfunction.</p>";
}
?>

