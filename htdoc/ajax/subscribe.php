<?php 
//This script is the result of an AJAX request. 
//The script returns a string indicating results.

require '../../connection.php';

if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$email = $_POST['email'];
	$return = array( //this JSON will allow a client-side parse
		"email" => $_POST['email'],
		"sql" => "INSERT INTO subscriber (subscriber_email) VALUES ('" . $email ."')",
		"response" => ""
		);

	if ($mysqli->query($return['sql']))
	{
	    $return["response"] = 'Success';
	} else 
	{
		$return["response"] = 'ConnectionError';
	}
} else 
{
	$return["response"] = 'Error';
}

echo json_encode($return);
