/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'ajouter de remplir de données la BD
 *
 * À ajouter après la création de la database et de sa structure
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 

--
-- Data pour la table `theme`
--

INSERT INTO `theme` (`theme_id`, `theme_lib`) VALUES
(1, 'Harry Potter'),
(2, 'Jeux Videos');


--
-- Data pour la table `typeQuestion`
--

INSERT INTO `typeQuestion` (`typeQ_id`, `typeQ_lib`) VALUES
(1, 'QCM'),
(2, 'QCU'),
(3, 'VF');

--
-- Data pour la table `utilisateur`
--

INSERT INTO `utilisateur` (`util_id`, `util_pseudo`, `util_mdp`, `util_email`, `util_estAdmin`, `util_nom`, `util_prenom`, `util_sexe`) VALUES
(1, 'admin', 'mdpAdmin', 'admin@gmail.com', 1, 'admin', 'admin', 'M'),
(2, 'jdupond001', 'monMDPS3cur3', 'jdupond@gmail.com', 0, 'Dupond', 'Jean', 'M');

--
-- Data pour la table `questionnaire`
--

INSERT INTO `questionnaire` (`questR_id`, `questR_lib`, `questR_desc`, `questR_difficulte`, `questR_tempsMax`, `theme_id`, `util_id`, `questR_dateAjout`, `questR_nomImg`, `questR_URLImg`) VALUES
(1, 'Harry Potter : une image, un objet', 'À l\'aide de l\'image, trouvez le mot ad hoc, un objet d\'Harry Potter... Comprenne qui pourra.', 2, '00:00:00', 1, 1, '2020-04-16', 'Harry Potter : une image, un objet', 'https://www.quizz.biz/uploads/quizz/900816/orig/1.jpg?1479721104'),
(2, 'Harry Potter : tomberez-vous dans les pièges ?', 'Un quiz sur les livres de la saga Harry Potter. Les réponses ne sont pas toujours celles que l\'on croit.', 1, '00:00:00', 1, 1, '2020-04-16', 'Harry Potter : tomberez-vous dans les pièges ?', 'https://www.20ansharrypotter.fr/wp-content/uploads/2019/10/cropped-harry-potter.jpg'),
(3, 'De quel jeu provient cette image ?', 'Je vous donne l\'image, retrouvez le jeu !', 3, '00:02:00', 2, 1, '2020-04-16', 'De quel jeu provient cette image ?', 'https://www.quizz.biz/uploads/quizz/23422/1_OmjIN.jpg');

--
-- Data pour la table `question`
--

INSERT INTO `question` (`quest_id`, `quest_lib`, `questR_id`, `quest_nomImg`, `quest_URLImg`, `typeQ_id`) VALUES
-- - Questionnaire 1
(219, 'Cape', 1, 'Cape', 'https://www.quizz.biz/uploads/quizz/900816/1_5sp9s.jpg', 2),
(220, 'Poudre', 1, 'Poudre', 'https://www.quizz.biz/uploads/quizz/900816/2_Q7USE.jpg', 2),
(221, 'Coupe', 1, 'Coupe', 'https://www.quizz.biz/uploads/quizz/900816/3_WfEJx.jpg', 2),
(222, 'Poudlard', 1, 'Poudlard', 'https://www.quizz.biz/uploads/quizz/900816/4_727S7.jpg', 2),
(223, 'Sonde', 1, 'Sonde', 'https://www.quizz.biz/uploads/quizz/900816/5_bCr75.jpg', 2),
(224, 'Armoire', 1, 'Armoire', 'https://www.quizz.biz/uploads/quizz/900816/6_9pZPS.jpg', 2),
(225, 'Oreille', 1, 'Oreille', 'https://www.quizz.biz/uploads/quizz/900816/7_98c44.jpg', 2),
(226, 'Pierre', 1, 'Pierre', 'https://www.quizz.biz/uploads/quizz/900816/8_yV3V3.jpg', 2),
(227, 'Collier', 1, 'Collier', 'https://www.quizz.biz/uploads/quizz/900816/9_5374z.jpg', 2),
(228, 'Miroir', 1, 'Miroir', 'https://www.quizz.biz/uploads/quizz/900816/10_Phtpb.jpg', 2),
(229, 'Plume', 1, 'Plume', 'https://www.quizz.biz/uploads/quizz/900816/11_j6PtJ.jpg', 2),
(230, 'Temps', 1, 'Temps', 'https://www.quizz.biz/uploads/quizz/900816/12_H8748.jpg', 2),
-- - Questionnaire 2
(247, 'Quel est le sortilège du Patronus ?', 2, 'Quel est le sortilège du Patronus ?', '', 2),
(248, 'Comment s&#039;appelle le premier centaure que rencontre Harry ?', 2, 'Comment s&#039;appelle le premier centaure que rencontre Harry ?', '', 2),
(249, 'Qu&#039;est-ce que Rogue utilise contre Harry lors de ses cours particuliers dans le tome 5 ?', 2, 'Qu&#039;est-ce que Rogue utilise contre Harry lors de ses cours particuliers dans le tome 5 ?', '', 2),
(250, 'Qui ramène Harry jusqu&#039;au château après qu&#039;il a été agressé par Malefoy dans le tome 6 ?', 2, 'Qui ramène Harry jusqu&#039;au château après qu&#039;il a été agressé par Malefoy dans le tome 6 ?', '', 2),
(251, 'Caractérisez Norbert, le dragon de Hagrid.', 2, 'Caractérisez Norbert, le dragon de Hagrid.', '', 2),
(252, 'Dans quelle circonstance Harry a-t-il entendu parler pour la première fois de Gregorovitch ?', 2, 'Dans quelle circonstance Harry a-t-il entendu parler pour la première fois de Gregorovitch ?', '', 2),
(253, 'Lequel de ces prénoms d&#039;enfants Weasley n&#039;est pas un diminutif connu ?', 2, 'Lequel de ces prénoms d&#039;enfants Weasley n&#039;est pas un diminutif connu ?', '', 2),
(254, 'De qui les Dursley ont-ils particulièrement peur dans le monde des sorciers ?', 2, 'De qui les Dursley ont-ils particulièrement peur dans le monde des sorciers ?', '', 2),
(255, 'Peu avant la deuxième tâche du Tournoi des Trois Sorciers, Dobby a annoncé à Harry Potter qu&#039;il devait aller chercher [...] au fond du lac.', 2, 'Peu avant la deuxième tâche du Tournoi des Trois Sorciers, Dobby a annoncé à Harry Potter qu&#039;il devait aller chercher [...] au fond du lac.', '', 2),
(256, 'Combien de membres compte l&#039;Armée de Dumbledore lors de leur dernière réunion ?', 2, 'Combien de membres compte l&#039;Armée de Dumbledore lors de leur dernière réunion ?', '', 2),
-- - Questionnaire 3
-- - QCU
(257, 'De quel jeu est issue cette scène ?', 3, 'De quel jeu est issue cette scène ?', 'https://www.quizz.biz/uploads/quizz/23422/1_OmjIN.jpg', 2),
(258, 'De quelle série de jeu vient ce screen ?', 3, 'De quelle série de jeu vient ce screen ?', 'https://www.quizz.biz/uploads/quizz/23422/2_ay0rD.jpg', 2),
-- - VF
(259, 'Ce personnage est est-il un personnage de Street Fighters?', 3, 'Ce personnage est est-il un personnage de Street Fighters?', 'https://www.quizz.biz/uploads/quizz/23422/3_6I68u.jpg', 3),
(260, 'Ce celèbre personnage est le héros du jeu Zelda', 3, 'Ce celèbre personnage est le héros du jeu Zelda', 'https://www.quizz.biz/uploads/quizz/23422/4_8iN0A.jpg', 3),
-- - QCM
(261, 'Sur cette image, quels sont les héros qui apparaissent ?', 3, 'Sur cette image, quels sont les héros qui apparaissent ?', 'https://www.quizz.biz/uploads/quizz/23422/5_c1cxP.jpg', 1),
-- - QCU
(262, 'Altaïr est au centre de quel magnifique jeu récent ?', 3, 'Altaïr est au centre de quel magnifique jeu récent ?', 'https://www.quizz.biz/uploads/quizz/23422/6_bF1Ls.jpg', 2),
(263, 'Et ce petit jeu de PSP, quel est il ?', 3, 'Et ce petit jeu de PSP, quel est il ?', 'https://www.quizz.biz/uploads/quizz/23422/7_Wxl9f.jpg', 2),
(264, 'Quel est ce jeu ?', 3, 'Quel est ce jeu ?', 'https://www.quizz.biz/uploads/quizz/23422/11_mBSd9.jpg', 2),
(265, 'De quel jeu vient cet scène ?', 3, 'De quel jeu vient cet scène ?', 'https://www.quizz.biz/uploads/quizz/23422/9_SvUmU.jpg', 2),
(266, 'De quel magnifique jeu PS2 provient ce screen ?', 3, 'De quel magnifique jeu PS2 provient ce screen ?', 'https://www.quizz.biz/uploads/quizz/23422/10_bUPJ7.jpg', 2),
(267, 'Quel est ce jeu sous forme d\'estampe japonaise ?', 3, 'Quel est ce jeu sous forme d estampe japonaise ?', 'https://www.quizz.biz/uploads/quizz/23422/12_3zl4k.jpg', 2),
(268, 'Cet homme (plutot sexy ^^) provient de quel jeu ', 3, 'Cet homme (plutot sexy ^^) provient de quel jeu ', 'https://www.quizz.biz/uploads/quizz/23422/13_Oq3T8.jpg', 2),
(269, 'Quel est ce jeu qui a bien failli ne pas sortir en France ?', 3, 'Quel est ce jeu qui a bien failli ne pas sortir en France ?', 'https://www.quizz.biz/uploads/quizz/23422/14_Rx8fe.jpg', 2),
(270, 'Et enfin, facile... ^^ Qui est Lara Croft ?', 3, 'Et enfin, facile... ^^ Qui est Lara Croft ?', '', 2);
--
-- Data pour la table `reponse`
--

INSERT INTO `reponse` (`rep_id`, `rep_exacte`, `rep_lib`, `quest_id`, `rep_nomImg`, `rep_URLImg`) VALUES
-- ----- Questionnaire 1
-- Question 1
(568, 0, 'Étanchéité', 219, 'Étanchéité', ''),
(569, 1, 'Invisibilité', 219, 'Invisibilité', ''),
(570, 0, 'Clandestinité', 219, 'Clandestinité', ''),
(571, 0, 'Solvabilité', 219, 'Solvabilité', ''),
-- Question 2
(572, 0, 'Obscurité du Venezuela', 220, 'Obscurité du Venezuela', ''),
(573, 0, 'Guérande', 220, 'Guérande', ''),
(574, 1, 'Cheminette', 220, 'Cheminette', ''),
(575, 0, 'Poudrette', 220, 'Poudrette', ''),
-- Question 3
(576, 0, 'Eau', 221, 'Eau', ''),
(577, 1, 'Feu', 221, 'Feu', ''),
(578, 0, 'Air', 221, 'Air', ''),
(579, 0, 'Terre', 221, 'Terre', ''),
-- Question 4
(580, 1, 'Express', 222, 'Express', ''),
(581, 0, 'Château', 222, 'Château', ''),
(582, 0, 'Cachots', 222, 'Cachots', ''),
(583, 0, 'Douves', 222, 'Douves', ''),
-- Question 5
(584, 1, 'Sincérité', 223, 'Sincérité', ''),
(585, 0, 'Franchise', 223, 'Franchise', ''),
(586, 0, 'Loyauté', 223, 'Loyauté', ''),
(587, 0, 'Fidelité', 223, 'Fidelité', ''),
-- Question 6
(588, 0, 'Expirer', 224, 'Expirer', ''),
(589, 0, 'Revenir', 224, 'Revenir', ''),
(590, 1, 'Disparaître', 224, 'Disparaître', ''),
(591, 0, 'Vaporiser', 224, 'Vaporiser', ''),
-- Question 7
(592, 0, 'Adjonction', 225, 'Adjonction', ''),
(593, 1, 'Rallonge', 225, 'Rallonge', ''),
(594, 0, 'Cérumen', 225, 'Cérumen', ''),
(595, 0, 'Coquelet', 225, 'Coquelet', ''),
-- Question 8
(596, 0, 'Rédemption', 226, 'Rédemption', ''),
(597, 0, 'Philosophie', 226, 'Philosophie', ''),
(598, 1, 'Résurrection', 226, 'Résurrection', ''),
(599, 0, 'Minéral', 226, 'Minéral', ''),
-- Question 9
(600, 1, 'Opale', 227, 'Opale', ''),
(601, 0, 'Topaze', 227, 'Topaze', ''),
(602, 0, 'Alabandine', 227, 'Alabandine', ''),
(603, 0, 'Saphir', 227, 'Saphir', ''),
-- Question 10
(604, 0, 'Sens Unique', 228, 'Sens Unique', ''),
(605, 1, 'Double Sens', 228, 'Double Sens', ''),
(606, 0, 'Contre-Sens', 228, 'Contre-Sens', ''),
(607, 0, 'Sens Inverse', 228, 'Sens Inverse', ''),
-- Question 11
(608, 0, 'Volubile', 229, 'Volubile', ''),
(609, 0, 'Jacasseur', 229, 'Jacasseur', ''),
(610, 1, 'Papote', 229, 'Papote', ''),
(611, 0, 'Discussion', 229, 'Discussion', ''),
-- Question 12
(612, 0, 'Aiguille', 230, 'Aiguille', ''),
(613, 1, 'Retourneur', 230, 'Retourneur', ''),
(614, 0, 'Action', 230, 'Action', ''),
(615, 0, 'Chronomètre', 230, 'Chronomètre', ''),
-- ---- Questionnaire 2
-- Question 1
(710, 0, 'Discendo Patronum', 247, 'Discendo Patronum', ''),
(711, 0, 'Expecto Patronus', 247, 'Expecto Patronus', ''),
(712, 1, 'Spero Patronum', 247, 'Spero Patronum', ''),
(713, 0, 'Accio Patronum', 247, 'Accio Patronum', ''),
-- Question 2
(714, 0, 'Ronan', 248, 'Ronan', ''),
(715, 1, 'Bane', 248, 'Bane', ''),
(716, 0, 'Firenze', 248, 'Firenze', ''),
(717, 0, 'Magorian', 248, 'Magorian', ''),
-- Question 3
(718, 0, 'L&#039;Expectomancie', 249, 'L&#039;Expectomancie', ''),
(719, 0, 'L&#039;Occlumancie', 249, 'L&#039;Occlumancie', ''),
(720, 0, 'L&#039;Arithmancie', 249, 'L&#039;Arithmancie', ''),
(721, 1, 'La Légilimancie', 249, 'La Légilimancie', ''),
-- Question 4
(722, 0, 'Luna Lovegood', 250, 'Luna Lovegood', ''),
(723, 1, 'Severus Rogue', 250, 'Severus Rogue', ''),
(724, 0, 'Nymphadora Tonks', 250, 'Nymphadora Tonks', ''),
(725, 0, 'Rubeus Hagrid', 250, 'Rubeus Hagrid', ''),
-- Question 5
(726, 0, 'Magyar à Pointes mâle', 251, 'Magyar à Pointes mâle', ''),
(727, 0, 'Magyar à Pointes femelle', 251, 'Magyar à Pointes femelle', ''),
(728, 0, 'Norvégien à Crête mâle', 251, 'Norvégien à Crête mâle', ''),
(729, 1, 'Norvégien à Crête femelle', 251, 'Norvégien à Crête femelle', ''),
-- Question 6
(730, 0, 'Dans une revue de fans de Quidditch', 252, 'Dans une revue de fans de Quidditch', ''),
(731, 1, 'Pendant le Tournoi des Trois Sorciers', 252, 'Pendant le Tournoi des Trois Sorciers', ''),
(732, 0, 'Lors d&#039;une vision de Voldemort en train de le torturer', 252, 'Lors d&#039;une vision de Voldemort en train de le torturer', ''),
(733, 0, 'Par Viktor Krum, lors du mariage de Bill et Fleur', 252, 'Par Viktor Krum, lors du mariage de Bill et Fleur', ''),
-- Question 7
(734, 0, 'Ginny', 253, 'Ginny', ''),
(735, 0, 'Ron', 253, 'Ron', ''),
(736, 0, 'Bill', 253, 'Bill', ''),
(737, 1, 'Percy', 253, 'Percy', ''),
-- Question 8
(738, 0, 'Les Détraqueurs', 254, 'Les Détraqueurs', ''),
(739, 1, 'Sirius Black', 254, 'Sirius Black', ''),
(740, 0, 'Lord Voldemort', 254, 'Lord Voldemort', ''),
(741, 0, 'Albus Dumbledore', 254, 'Albus Dumbledore', ''),
-- Question 9
(742, 0, 'Son Éclair de Feu', 255, 'Son Éclair de Feu', ''),
(743, 0, 'Un Strangulot', 255, 'Un Strangulot', ''),
(744, 1, 'Son whisky', 255, 'Son whisky', ''),
(745, 0, 'Son ami Ron Weasley', 255, 'Son ami Ron Weasley', ''),
-- Question 10
(746, 0, '15', 256, '15', ''),
(747, 0, '25', 256, '25', ''),
(748, 0, '28', 256, '28', ''),
(749, 1, '29', 256, '29', ''),
-- ---- Questionnaire 3
-- Question 1
(750, 1, 'Final', 257, 'Final', ''),
(751, 0, 'Kingdom', 257, 'Kingdom', ''),
(752, 0, 'Dragon', 257, 'Dragon', ''),
(753, 0, 'Project', 257, 'Project', ''),
(754, 0, 'Resident', 257, 'Resident', ''),
(755, 0, 'Silent', 257, 'Silent', ''),
-- Question 2
(756, 0, 'Project', 258, 'Project', ''),
(757, 0, 'Resident', 258, 'Resident', ''),
(758, 1, 'Silent', 258, 'Silent', ''),
(759, 0, 'Devil', 258, 'Devil', ''),
(760, 0, 'Heavenly', 258, 'Heavenly', ''),
(761, 0, 'Onimusha', 258, 'Onimusha', ''),
-- Question 3 VF
(762, 0, 'Faux', 259, '', ''),
(763, 1, 'Vrai', 259, '', ''),
-- Question 4 VF
(764, 1, 'Vrai', 260, '', ''),
(765, 0, 'Faux', 260, '', ''),
-- Question 5 QCM
(766, 1, 'Dingo', 261, 'Dingo', ''),
(767, 0, 'Riku', 261, 'Riku', ''),
(768, 1, 'Donald', 261, 'Donald', ''),
(769, 0, 'Mickey', 261, 'Mickey', ''),
(770, 1, 'Sora', 261, 'Sora', ''),
(771, 0, 'Kairi', 261, 'Kairi', ''),
(772, 0, 'Devil', 262, 'Devil', ''),
-- Question 6
(773, 0, 'Heavenly', 262, 'Heavenly', ''),
(774, 1, 'Assassin&#039;s', 262, 'Assassin&#039;s', ''),
(775, 0, 'Project', 262, 'Project', ''),
(776, 0, 'Assassin&#039;s', 262, 'Assassin&#039;s', ''),
(777, 0, 'Silent', 262, 'Silent', ''),
-- Question 7
(778, 1, 'Loco', 263, 'Loco', ''),
(779, 0, 'Bust', 263, 'Bust', ''),
(780, 0, 'Booly', 263, 'Booly', ''),
(781, 0, 'Barbapapa', 263, 'Barbapapa', ''),
(782, 0, 'Hoshimudes', 263, 'Hoshimudes', ''),
(783, 0, 'Shenmue', 263, 'Shenmue', ''),
-- Question 8
(784, 1, 'Trauma', 264, 'Trauma', ''),
(785, 0, 'Urgences', 264, 'Urgences', ''),
(786, 0, 'Docteur', 264, 'Docteur', ''),
(787, 0, 'A', 264, 'A', ''),
(788, 0, 'Je', 264, 'Je', ''),
(789, 0, 'Shinshin', 264, 'Shinshin', ''),
-- Question 9
(790, 1, 'Project', 265, 'Project', ''),
(791, 0, 'Fear', 265, 'Fear', ''),
(792, 0, 'Silent', 265, 'Silent', ''),
(793, 0, 'Shenmue', 265, 'Shenmue', ''),
(794, 0, 'Onimusha', 265, 'Onimusha', ''),
(795, 0, 'Resident', 265, 'Resident', ''),
-- Question 10
(796, 0, 'Final', 266, 'Final', ''),
(797, 0, 'God', 266, 'God', ''),
(798, 1, 'Shadow', 266, 'Shadow', ''),
(799, 0, 'Zelda', 266, 'Zelda', ''),
(800, 0, 'Ori', 266, 'Ori', ''),
(801, 0, 'Spyro', 266, 'Spyro', ''),
-- Question 11
(802, 0, 'Lobo', 267, 'Lobo', ''),
(803, 0, 'Shadow', 267, 'Shadow', ''),
(804, 1, 'Okami', 267, 'Okami', ''),
(805, 0, 'Flower', 267, 'Flower', ''),
(806, 0, 'Naruto', 267, 'Naruto', ''),
(807, 0, 'Shenmue', 267, 'Shenmue', ''),
-- Question 12
(808, 0, 'Assassin&#039;s', 268, 'Assassin&#039;s', ''),
(809, 0, 'God', 268, 'God', ''),
(810, 0, 'Final', 268, 'Final', ''),
(811, 1, 'Devil', 268, 'Devil', ''),
(812, 0, 'Mario', 268, 'Mario', ''),
(813, 0, 'Silent', 268, 'Silent', ''),
-- Question 13
(814, 0, 'Silent', 269, 'Silent', ''),
(815, 1, 'Rule', 269, 'Rule', ''),
(816, 0, 'Fear', 269, 'Fear', ''),
(817, 0, 'Amnesia', 269, 'Amnesia', ''),
(818, 0, 'Doom', 269, 'Doom', ''),
(819, 0, 'Chinatown', 269, 'Chinatown', ''),
-- Question 14
(820, 0, '1', 270, '1', 'https://vignette.wikia.nocookie.net/mario/images/b/b5/Peach_-_Mario_Party_10.png/revision/latest?cb=20150216203348&path-prefix=de'),
(821, 1, '2', 270, '2', 'https://www.quizz.biz/uploads/quizz/23422/15_L70cd.jpg'),
(822, 0, '3', 270, '3', 'https://www.quizz.biz/uploads/quizz/23422/8_KN9Lx.jpg'),
(823, 0, '4', 270, '4', 'https://static.cnews.fr/sites/default/files/styles/image_640_360/public/lara_fabian_genevieve_charbonneau_5e8ef53d3b009_0.jpg?itok=JY7X0oQQ'),
(824, 0, '5', 270, '5', 'https://vignette.wikia.nocookie.net/leagueoflegends/images/1/1e/Katarina_Render.png/revision/latest?cb=20181117220952'),
(825, 0, '6', 270, '6', 'https://www.smashlabs.de/wcf/attachment/6759-bayo-png/');

--
-- Data pour la table `realiser`
--

INSERT INTO `realiser` (`real_id`, `util_id`, `questR_id`, `real_score`, `real_tpsTotal`, `real_date`) VALUES
(1, 2, 1, 0, '00:00:04', '2020-04-16'),
(2, 2, 1, 70, '00:00:51', '2020-04-16'),
(3, 2, 2, 80, '00:00:04', '2020-04-16'),    
(4, 2, 3, 100, '00:00:04', '2020-04-16')
;