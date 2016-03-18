<?php 

if (isset($_GET['postID'])) 
{
 	if ($_GET['postID'] <> 0 && is_numeric($_GET['postID']))
 	{
 		//recipe article
 		$sql = "SELECT * FROM post LEFT JOIN user ON post.post_author = user.user_ID WHERE post_ID=" . $_GET['postID'];
 		$result = readPostDB($sql);

 		echo '<section id="recipe_article"><h4>How to make</h4>';

		for ($i = 0; $i < count($result); $i++)
		{
			echo '<h3>' . $result[$i]["postTitle"] . '</h3><h4>' . $result[$i]["postExcerpt"] . ' by ' . $result[$i]["display_name"] . '</h4><aside style="background-image: url(img/' . strtolower($result[$i]["postTitle"]) . '1.jpeg);"></aside><p>' . $result[$i]["postContent"] . '</p>';
		}
		echo '</section><hr><section id="recipe_comments"><h3>Leave a Comment!</h3><p id="comment_msg"></p><form id="comment_input" name="comment_input"><p class="legend">Display Name</p><input type="text" id="displayName" name="displayName" required></input><p class="legend">Comment</p><textarea id="comment" name="comment" required></textarea><input type="submit" value="Submit Comment" method="post" onclick="submitComment()"></input></form>';

		//article comments
		require '../connection.php';
		$sql = "SELECT * FROM comment WHERE comment_post_ID=". $_GET['postID'];
		$result = $mysqli->query($sql);
		if ($result->num_rows>-1)
		{
			echo '<h3 id="comment_list">Comments ' . $result->num_rows . '</h3>';
			while ($row = $result->fetch_assoc())
			{
				$commentAuthor = $row["comment_author"];
				$commentDate = $row["comment_date"];
				$commentContent = $row['comment_content'];

				echo '<aside><p>' . $commentAuthor . ' - ' . $commentDate . '</p><p>' . $commentContent . '</p></aside>';
			}
		}
		echo '</section>';
 	}
} else 
{
	//latest recipes
	$sql = "SELECT * FROM post LIMIT 4";
	$result = readPostDB($sql);

	echo '<section id="latest_recipes"><h3>Latest Recipes</h3>';

	for ($i = 0; $i < count($result); $i++)
	{
		echo '<a href="index.php?postID=' . $result[$i]["postID"] . '"><aside><p>How to make ' . $result[$i]["postTitle"] . '</p><p>' . $result[$i]["postExcerpt"] . ' ' . $result[$i]["postDate"] . '</p></aside></a>';
	}
	echo '</section><hr><section id="recipes_list">';

	//recipes list
	$sql = "SELECT * FROM post LIMIT 8";
	$result = readPostDB($sql);

	for ($i = 0; $i < count($result); $i++)
	{
		echo '<a href="index.php?postID=' . $result[$i]["postID"] . '"><aside style="background-image: url(img/' . strtolower($result[$i]["postTitle"]) . '1.jpeg);"><p>How to make ' . $result[$i]["postTitle"] . '</p><p>' . $result[$i]["postExcerpt"] . ' ' . $result[$i]["postDate"] . '</p></aside></a>';
	}
	echo '</section>';
}


function readPostDB($sql) {
	require '../connection.php';
	$result = $mysqli->query($sql);
	$i = 0; //incrementer
	$y = array(); //intialize array

		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()) 
        	{
				$x = array(	
					"postID" => $row['post_ID'],
					"postAuthor" => $row['post_author'],
					"postDate" => $row['post_date'],
					"postContent" => $row['post_content'],
					"postTitle" => $row['post_title'],
					"postExcerpt" => $row['post_excerpt']
					);
				$y[$i++]=$x;
			}
		}
	return $y;
	}
?>