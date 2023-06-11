CREATE DATABASE userinfo;

USE userinfo;

CREATE TABLE `user` (`email` varchar(30), 'password' varchar(20), 'full_name' varchar(20), 'contact' varchar(11));

CREATE TABLE `book` (`book_name` varchar(20), 'cond' varchar(10), 'dpt' varchar(30), 'owner_name' varchar(20), 'owner_email' varchar(30),'owner_number' varchar(11);
