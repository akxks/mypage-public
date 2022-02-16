CREATE DATABASE IF NOT EXISTS mypage; 
USE mypage;

CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(20) NOT NULL,
 `firstname` varchar(20),
 `lastname` varchar(20),
 `email` varchar(50) NOT NULL,
 `bio` varchar(100) NOT NULL,
 `password` varchar(255) NOT NULL, 
 `score` int(11) NOT NULL,  
 `verified` boolean NOT NULL,  
 `admin` boolean NOT NULL,  
 `private` boolean NOT NULL,  
 `registration` boolean NOT NULL, 
 `create_date` datetime NOT NULL,
 `birthday` datetime,
 `relationshipId` int(11),
 `song` varchar(45),
 `location` varchar(85),
 `language` varchar(5),
 `pfpurl` varchar(333),
 `emojistyle` varchar(20),
 `coverurl` varchar(220),
 `feedtype` boolean,
 `profileViews` int(11),
 `accountToken` varchar(360) NOT NULL,
 `hideAccount` boolean, 
 UNIQUE(`accountToken`),
 PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `type` boolean NOT NULL, 
 `imgurl` varchar(333), 
 `userid` int(11) NOT NULL, 
 `likes` int(11) NOT NULL,
 `comments` int(11), 
 `shares` int(11), 
 `dislikes` int(11), 
 `post` varchar(500) NOT NULL, 
 `state` varchar(20) NOT NULL, 
 `create_date` datetime NOT NULL,
 `location` varchar(35),
 `isShare` boolean,
 `sharePostId` int(11) 
); 

CREATE TABLE IF NOT EXISTS `blogPosts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
 `likes` int(11),
 `dislikes` int(11), 
 `post` varchar(2000) NOT NULL,  
 `title` varchar(100) NOT NULL,  
 `create_date` datetime NOT NULL 
); 

CREATE TABLE IF NOT EXISTS `messages` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `from` int(11) NOT NULL,
 `to` int(11) NOT NULL,
 `message` varchar(4000) NOT NULL, 
 `create_date` datetime NOT NULL
); 

CREATE TABLE IF NOT EXISTS `feedback` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `name` varchar(200) NOT NULL,
 `email` varchar(200) NOT NULL,
 `message` varchar(2000) NOT NULL, 
 `type` varchar(50) NOT NULL, 
 `create_date` datetime NOT NULL
); 

CREATE TABLE IF NOT EXISTS `hidePosts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `userid` int(11) NOT NULL,
 `postid` int(11) NOT NULL
); 

CREATE TABLE IF NOT EXISTS `pinPosts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `userid` int(11) NOT NULL,
 `postid` int(11) NOT NULL
); 

CREATE TABLE IF NOT EXISTS `resetPassword` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `email` int(11) NOT NULL, 
 `success` boolean NOT NULL,
 `create_date` datetime NOT NULL,
 `token` varchar(360) NOT NULL,
 UNIQUE(`token`)
); 

CREATE TABLE IF NOT EXISTS `verifyAcc` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `email` int(11) NOT NULL, 
 `success` boolean NOT NULL,
 `create_date` datetime NOT NULL,
 `token` varchar(360) NOT NULL,
 UNIQUE(`token`)
); 

CREATE TABLE IF NOT EXISTS `reports` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `reportType` boolean NOT NULL,
 `reporter` int(11) NOT NULL,
 `reported` int(11) NOT NULL,
 `reason` varchar(200) NOT NULL, 
 `create_date` datetime NOT NULL
); 

CREATE TABLE IF NOT EXISTS `interactions` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `postid` int(11), 
 `userid` int(11) NOT NULL, 
 `type` varchar(15) NOT NULL, 
 `comment` varchar(500), 
 `create_date` datetime NOT NULL
);  

CREATE TABLE IF NOT EXISTS `shared` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `postid` int(11), 
 `userid` int(11) NOT NULL,  
 `likes` int(11) NOT NULL,
 `comments` int(11), 
 `dislikes` int(11), 
 `sharedcomment` varchar(500), 
 `create_date` datetime NOT NULL
); 

CREATE TABLE IF NOT EXISTS `notifications` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `userid` int(11) NOT NULL, 
 `type` varchar(24) NOT NULL, 
 `post` varchar(2000) NOT NULL, 
 `read` boolean NOT NULL, 
 `create_date` datetime NOT NULL
); 

CREATE TABLE `friends` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` int(11) NOT NULL,
 `useridFriend` int(11) NOT NULL,
 `score` int(11) NOT NULL,
 `friendstate` varchar(22),
 `since_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
);  

CREATE TABLE `blocked` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `useridBlocker` int(11) NOT NULL,
 `useridblocked` int(11) NOT NULL, 
 `since_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
); 

CREATE TABLE `blockedWords` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` int(11) NOT NULL,
 `word` varchar(50) ,
 PRIMARY KEY (`id`)
); 

CREATE TABLE `requests` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `useridRequester` int(11) NOT NULL,
 `useridRequested` int(11) NOT NULL,
 `request_state` varchar(22), 
 `request_date` datetime NOT NULL,
 `type` boolean,
 PRIMARY KEY (`id`)
);  

CREATE TABLE IF NOT EXISTS `comments` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `userid` int(11) NOT NULL, 
 `likes` int(11) NOT NULL,  
 `dislikes` int(11) NOT NULL,  
 `post` varchar(2000) NOT NULL,  
 `postId` int(11) NOT NULL, 
 `commentId` int(11) NOT NULL, 
 `create_date` datetime NOT NULL
); 

CREATE TABLE `bans` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `userid` int(11) NOT NULL, 
 `by` int(11) NOT NULL, 
 `reason` varchar(222) NOT NULL,
 `unban_date` int(11), 
 `create_date` datetime NOT NULL
); 

CREATE TABLE `invites` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
 `codemaker` int(11) NOT NULL, 
 `codeuser` int(11) NOT NULL, 
 `code` varchar(11) NOT NULL,
 `used` boolean,
 `use_date` datetime,
 `create_date` datetime
); 

CREATE TABLE `settings` ( 
 `userid` int(11) NOT NULL,  
 `safetynsfw` boolean NOT NULL default 0, 
 `privacy` boolean NOT NULL default 0, 
 `disablerelationships` boolean NOT NULL default 0, 
 `likedposts`  boolean NOT NULL default 0, 
 `featurestime` boolean NOT NULL default 0
); 