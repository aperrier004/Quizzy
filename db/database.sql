create database if not exists quizz character set utf8 collate utf8_unicode_ci;
use quizz;

grant all privileges on quizz.* to 'quizz_user'@'localhost' identified by 'admin';
