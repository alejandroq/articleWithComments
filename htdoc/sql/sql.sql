-- Execute lines 4-XXX
-- Alejandro Quesada

CREATE TABLE user(
	user_ID BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	display_name VARCHAR(250) NOT NULL
);

CREATE TABLE post(
	post_ID BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	post_author BIGINT(20) NOT NULL,
	post_date TIMESTAMP NOT NULL,
	post_content LONGTEXT NOT NULL,
	post_title TEXT NOT NULL,
	post_excerpt TEXT NOT NULL
);

CREATE TABLE comment(
	comment_ID BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	comment_post_ID BIGINT(20) NOT NULL,
	comment_author TINYTEXT NOT NULL,
	comment_date TIMESTAMP NOT NULL,
	comment_content TEXT NOT NULL
);

CREATE TABLE subscriber(
	subscriber_email VARCHAR(250)
);

INSERT INTO user (display_name) VALUES("Alejandro Quesada");
INSERT INTO post (post_author, post_content, post_title, post_excerpt) VALUES
(1,	"lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
	"Ramen", "@ $2.99"),
(1,	'To make a PBnJ (Peanut Butter and Jelly) in the classical method you need <a href="http://www.amazon.com/Jif-Creamy-Peanut-Butter-40/dp/B00I8G7268/ref=sr_1_2_s_it?ie=UTF8&qid=1458227192&sr=1-2&keywords=peanut+butter"> PEANUT BUTTER</a>, <a href="http://www.amazon.com/Smuckers-Squeeze-Grape-Jelly-20/dp/B00I8G6D6I/ref=sr_1_1?srs=7301146011&ie=UTF8&qid=1458227265&sr=8-1&keywords=jelly">JELLY</a> and a BREAD of your choice (sliced with no crust preferred). The secret to spreading the peanut butter well is using a spoon as opposed to a knife. Afterwards shoot the jelly on the bread and place one bread on top of the other. To have the $1.99 price, your supplies go far and in an economy of scales kind of way makes it $1.99 (details need not apply). Another great dish for the broke college student is Ramen!',
	"PBnJ", "@ $1.99");
INSERT INTO comment (comment_post_ID, comment_author, comment_content) VALUES
(3, "First Name, Last Name", "Nice article!");

DELETE FROM post;