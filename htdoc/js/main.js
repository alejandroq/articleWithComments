$(document).ready(function() {
	document.title = "Cheap Food - Blog";
});
$("ramen").click(function(event) {
	$("recipe_article").toggle(400);
	$("recipe_comments").toggle(400);
});