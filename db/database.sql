/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet de créer la database ainsi que d'allouer tous les privilèges dessus pour un utilisateur donné
 *
 * À ajouter en premier pour la création de la DB
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
create database if not exists quizz character set utf8 collate utf8_unicode_ci;
use quizz;

grant all privileges on quizz.* to 'quizz_user'@localhost identified by 'admin';
