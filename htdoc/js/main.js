$(document).ready(function() {
	document.title = "Cheap Food - Blog";
});

//AJAX - Subscribe
function submitSubscriberEmail() {

    event.preventDefault(); //Hijack event from PHP to refrain page reload. 
    var email;

    email = $('#subscribe_email').val();

    var data = new Object();
    data.email = email;

    var options = new Object();
    options.data = data;
    options.dataType = 'text';
    options.type = 'post';
    options.success = function(response) {
    //if AJAX Request is a success

    var data = jQuery.parseJSON(response); //parses PHP encoded JSON-result into an object

    var temp = $('footer section > p:not(p+p)');

    if (data.response == "Error") 
    {
    	temp.addClass('error');
    	temp.text('Please Enter a Proper Email');
    } else if (data.response == "ConnectionError")
    {
    	temp.addClass('error');
    	temp.text('Server Error. Try Again Later');
    } else
    {
    	if (temp.hasClass('error'))
    	{
    		temp.removeClass('error');
    	}
    	temp.addClass('success');
    	temp.text('Thank You for Subscribing ' + data.email + '!');
    	$('footer input').remove();
    }

   
  }; // END OF AJAX SUCCESS
  options.url = 'ajax/subscribe.php';

    //PERFORM REQUEST
  $.ajax(options);
} //END OF FORM SUBMISSION

function submitComment() {
event.preventDefault(); //Hijack event from PHP to refrain page reload. 
    var postID, displayName, comment;

    postID=getUrlVars('postID');
    displayName = $('#displayName').val();
    comment = $('#comment').val();

    var data = new Object();
    data.postID = postID.postID;
    data.displayName = displayName;
    data.comment = comment;

    var options = new Object();
    options.data = data;
    options.dataType = 'text';
    options.type = 'post';
    options.success = function(response) {
    //if AJAX Request is a success

    var data = jQuery.parseJSON(response); //parses PHP encoded JSON-result into an object

    var x = $('#comment_msg');

    if (data.response == "Error") 
    {
    	x.addClass('error');
    	x.text('Please Enter a Comment!');
    } else if (data.response == "ConnectionError")
    {
    	x.addClass('error');
    	x.text('Server Error. Try Again Later');
    } else
    {
    	if (x.hasClass('error'))
    	{
    		x.removeClass('error');
    	}
    	x.addClass('success');
    	x.text('Thank You for Commenting ' + data.displayName + '!');
    	$('#comment_input').remove();
    	var y = $('#comment_list');
    	y.after('<aside id="your_comment"><p>' + data.displayName.toUpperCase() + ' - ' + data.date + '</p><p>' + data.comment + '</aside>');
    	incrementComment();
    }

   
  }; // END OF AJAX SUCCESS
  options.url = 'ajax/comment.php';

    //PERFORM REQUEST
  $.ajax(options);
} //END OF FORM SUBMISSION

function incrementComment() {
	var text = document.getElementById("comment_list").innerHTML;
	var beg = text.indexOf(' ');
	var end = text.length;
	var quantity = parseInt(text.substring(beg+1,end));
	quantity += 1;
	document.getElementById("comment_list").innerHTML = "Comments " + quantity.toString();
}
function getUrlVars() { //http://papermashup.com/read-url-get-variables-withjavascript/
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
});
	return vars;
}