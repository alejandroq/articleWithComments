<?php 
//This script is the result of an AJAX request. 
//The script returns a string indicating results.

require '../../connection.php';

if (!empty($_POST['displayName']) && !empty($_POST['comment'])) {
	$postID = intval($_POST['postID']);
	$displayName = filter_var($_POST['displayName'], FILTER_SANITIZE_SPECIAL_CHARS);
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS	);

	date_default_timezone_set("America/New_York");
	$timestamp = time(); //unix timestamp

	$return = array( //this JSON will allow a client-side parse
		"displayName" => $displayName,
		"comment" => $comment,
		"date" => date('Y-d-m h:m:s'),
		"sql" => "INSERT INTO comment (comment_post_ID, comment_author, comment_content) VALUES (" 
			. $postID .", '"
			. $displayName . "', '" 
			. $comment . "')",
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
