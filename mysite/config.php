<?php

/*

create database php_test;
grant all on php_test.* to dbuser@localhost identified by 'key123';

use php_test;

create table posts(
    postId int not null auto_increment primary key,
    date varchar(10) not null,
    time varchar(8) not null,
    desc varchar(100) not null
);

*/

define('DSN', 'mysql:host=localhost;dbname=php_test');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'key123');
define('SITE_URL', 'http://localhost/mysite'); 

error_reporting(E_ALL & ~E_NOTICE);
