/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet de créer la structure de la DB 
 *
 * À ajouter en second dans la création de la DB
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 

--
-- Database: `quizz`
--

-- --------------------------------------------------------

-- Supprime toutes les tables

DROP Table IF EXISTS `selectionner`;
DROP Table IF EXISTS `realiser`;
DROP Table IF EXISTS `reponse`;
DROP Table IF EXISTS `question`;
DROP Table IF EXISTS `typeQuestion`;
DROP Table IF EXISTS `questionnaire`;
DROP Table IF EXISTS `theme`;
DROP Table IF EXISTS `utilisateur`;

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `quest_id` int(5) NOT NULL,
  `quest_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questR_id` int(5) NOT NULL,
  `quest_nomImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quest_URLImg` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `typeQ_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `questR_id` int(5) NOT NULL,
  `questR_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questR_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questR_difficulte` int(1) NOT NULL,
  `questR_tempsMax` time DEFAULT NULL,
  `theme_id` int(5) NOT NULL,
  `util_id` int(5) NOT NULL,
  `questR_dateAjout` date NOT NULL,
  `questR_nomImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questR_URLImg` varchar(20000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

CREATE TABLE `realiser` (
  `real_id` int(5) NOT NULL,
  `util_id` int(5) NOT NULL,
  `questR_id` int(5) NOT NULL,
  `real_score` float NOT NULL,
  `real_tpsTotal` time NOT NULL,
  `real_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `rep_id` int(5) NOT NULL,
  `rep_exacte` tinyint(1) NOT NULL,
  `rep_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quest_id` int(5) NOT NULL,
  `rep_nomImg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rep_URLImg` varchar(20000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `selectionner`
--

CREATE TABLE `selectionner` (
  `util_id` int(5) NOT NULL,
  `rep_id` int(5) NOT NULL,
  `quest_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `theme_id` int(5) NOT NULL,
  `theme_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `util_id` int(5) NOT NULL,
  `util_pseudo` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `util_mdp` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `util_email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `util_estAdmin` tinyint(1) NOT NULL,
  `util_nom` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `util_prenom` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `util_sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `typeQuestion` (
  `typeQ_id` int(5) NOT NULL,
  `typeQ_lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Indexs des tables
--

--
-- Index pour la table `typeQuestion`
--
ALTER TABLE `typeQuestion`
  ADD PRIMARY KEY (`typeQ_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quest_id`);

--
-- Index pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`questR_id`);

--
-- Index pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD PRIMARY KEY (`real_id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`rep_id`);

--
-- Index pour la table `selectionner`
--
ALTER TABLE `selectionner`
  ADD PRIMARY KEY (`util_id`,`rep_id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`util_id`);


--
-- Contraintes pour les tables
--

-- Les AUTO_INCREMENT permettent de ne pas avoir à se soucier de l'id lorsque l'on ajoute des données, et permet de s'assurer qu'on ne viole pas une contrainte de primary key

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `util_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Contraintes pour la table `typeQuestion`
--
ALTER TABLE `typeQuestion`
  MODIFY `typeQ_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Contraintes pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `questR_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

-- Le ON DELETE CASCADE permet de simplifier la suppression de données en DB, en supprimant un élement, tout le reste se supprimera automatiquement si une primary key est une clé étrangère dans une autre table
-- Par exemple en supprimant un questionnaire, cela va entrainer la suppression des questions, des réponses et des réalisations dans les autres tables
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questR_gere_par_util` FOREIGN KEY (`util_id`) REFERENCES `utilisateur` (`util_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questR_a_un_theme` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE CASCADE,
  ADD INDEX `util_realise_un_questR` (`util_id`);
--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  MODIFY `quest_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `question`
  ADD CONSTRAINT `question_a_un_type` FOREIGN KEY (`typeQ_id`) REFERENCES `typeQuestion` (`typeQ_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_contenue_dans_questR` FOREIGN KEY (`questR_id`) REFERENCES `questionnaire` (`questR_id`) ON DELETE CASCADE;


--
-- Contraintes pour la table `realiser`
--
ALTER TABLE `realiser`
  MODIFY `real_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `realiser`
  ADD CONSTRAINT `util_realise_un_questR` FOREIGN KEY (`util_id`) REFERENCES `utilisateur` (`util_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questR_est_realise_par_util` FOREIGN KEY (`questR_id`) REFERENCES `questionnaire` (`questR_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `rep_id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_associe_a_une_quest` FOREIGN KEY (`quest_id`) REFERENCES `question` (`quest_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `selectionner`
--
ALTER TABLE `selectionner`
  ADD CONSTRAINT `util_select_une_rep` FOREIGN KEY (`util_id`) REFERENCES `utilisateur` (`util_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rep_est_select_par_util` FOREIGN KEY (`rep_id`) REFERENCES `reponse` (`rep_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quest_est_select_par_util` FOREIGN KEY (`quest_id`) REFERENCES `question` (`quest_id`) ON DELETE CASCADE;
COMMIT;




