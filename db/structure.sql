drop index if exists UTILISATEUR.UTILISATEUR_PK;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table: UTILISATEUR                                           */
/*==============================================================*/
create table UTILISATEUR 
(
   UTIL_ID              integer                        not null,
   UTIL_LOGIN           varchar(32)                    null,
   UTIL_MDP             varchar(32)                    null,
   constraint PK_UTILISATEUR primary key (UTIL_ID)
);

/*==============================================================*/
/* Index: UTILISATEUR_PK                                        */
/*==============================================================*/
create unique index UTILISATEUR_PK on UTILISATEUR (
UTIL_ID ASC
);

if exists(select 1 from sys.sysforeignkey where role='FK_JOUEUR_FAIRE_UNE_SAUVEGAR') then
    alter table JOUEUR
       delete foreign key FK_JOUEUR_FAIRE_UNE_SAUVEGAR
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_JOUEUR_HERITAGE_UTILISAT') then
    alter table JOUEUR
       delete foreign key FK_JOUEUR_HERITAGE_UTILISAT
end if;

drop index if exists JOUEUR.HERITAGE_FK;

drop index if exists JOUEUR.FAIRE_UNE2_FK;

drop index if exists JOUEUR.JOUEUR_PK;

drop table if exists JOUEUR;

/*==============================================================*/
/* Table: JOUEUR                                                */
/*==============================================================*/
create table JOUEUR 
(
   UTIL_ID              integer                        not null,
   JOUEUR_ID            integer                        not null,
   SAUV_ID              integer                        null,
   UTIL_LOGIN           varchar(32)                    null,
   UTIL_MDP             varchar(32)                    null,
   JOUEUR_NOM           varchar(32)                    not null,
   JOUEUR_PRENOM        varchar(32)                    not null,
   JOUEUR_SEXE          char(1)                        null,
   constraint PK_JOUEUR primary key (UTIL_ID, JOUEUR_ID)
);

/*==============================================================*/
/* Index: JOUEUR_PK                                             */
/*==============================================================*/
create unique index JOUEUR_PK on JOUEUR (
UTIL_ID ASC,
JOUEUR_ID ASC
);

/*==============================================================*/
/* Index: FAIRE_UNE2_FK                                         */
/*==============================================================*/
create index FAIRE_UNE2_FK on JOUEUR (
SAUV_ID ASC
);

/*==============================================================*/
/* Index: HERITAGE_FK                                           */
/*==============================================================*/
create index HERITAGE_FK on JOUEUR (
UTIL_ID ASC
);

alter table JOUEUR
   add constraint FK_JOUEUR_FAIRE_UNE_SAUVEGAR foreign key (SAUV_ID)
      references SAUVEGARDE (SAUV_ID)
      on update restrict
      on delete restrict;

alter table JOUEUR
   add constraint FK_JOUEUR_HERITAGE_UTILISAT foreign key (UTIL_ID)
      references UTILISATEUR (UTIL_ID)
      on update restrict
      on delete restrict;

if exists(select 1 from sys.sysforeignkey where role='FK_ADMINIST_HERITAGE2_UTILISAT') then
    alter table ADMINISTRATEUR
       delete foreign key FK_ADMINIST_HERITAGE2_UTILISAT
end if;

drop index if exists ADMINISTRATEUR.HERITAGE2_FK;

drop index if exists ADMINISTRATEUR.ADMINISTRATEUR_PK;

drop table if exists ADMINISTRATEUR;

/*==============================================================*/
/* Table: ADMINISTRATEUR                                        */
/*==============================================================*/
create table ADMINISTRATEUR 
(
   UTIL_ID              integer                        not null,
   ADMIN_ID             integer                        not null,
   UTIL_LOGIN           varchar(32)                    null,
   UTIL_MDP             varchar(32)                    null,
   constraint PK_ADMINISTRATEUR primary key (UTIL_ID, ADMIN_ID)
);

/*==============================================================*/
/* Index: ADMINISTRATEUR_PK                                     */
/*==============================================================*/
create unique index ADMINISTRATEUR_PK on ADMINISTRATEUR (
UTIL_ID ASC,
ADMIN_ID ASC
);

/*==============================================================*/
/* Index: HERITAGE2_FK                                          */
/*==============================================================*/
create index HERITAGE2_FK on ADMINISTRATEUR (
UTIL_ID ASC
);

alter table ADMINISTRATEUR
   add constraint FK_ADMINIST_HERITAGE2_UTILISAT foreign key (UTIL_ID)
      references UTILISATEUR (UTIL_ID)
      on update restrict
      on delete restrict;

if exists(select 1 from sys.sysforeignkey where role='FK_SAUVEGAR_FAIRE_UNE_JOUEUR') then
    alter table SAUVEGARDE
       delete foreign key FK_SAUVEGAR_FAIRE_UNE_JOUEUR
end if;

drop index if exists SAUVEGARDE.FAIRE_UNE_FK;

drop index if exists SAUVEGARDE.SAUVEGARDE_PK;

drop table if exists SAUVEGARDE;

/*==============================================================*/
/* Table: SAUVEGARDE                                            */
/*==============================================================*/
create table SAUVEGARDE 
(
   SAUV_ID              integer                        not null,
   UTIL_ID              integer                        null,
   JOUEUR_ID            integer                        null,
   constraint PK_SAUVEGARDE primary key (SAUV_ID)
);

/*==============================================================*/
/* Index: SAUVEGARDE_PK                                         */
/*==============================================================*/
create unique index SAUVEGARDE_PK on SAUVEGARDE (
SAUV_ID ASC
);

/*==============================================================*/
/* Index: FAIRE_UNE_FK                                          */
/*==============================================================*/
create index FAIRE_UNE_FK on SAUVEGARDE (
UTIL_ID ASC,
JOUEUR_ID ASC
);

alter table SAUVEGARDE
   add constraint FK_SAUVEGAR_FAIRE_UNE_JOUEUR foreign key (UTIL_ID, JOUEUR_ID)
      references JOUEUR (UTIL_ID, JOUEUR_ID)
      on update restrict
      on delete restrict;


if exists(select 1 from sys.sysforeignkey where role='FK_QUESTION_ETRE_CREE_ADMINIST') then
    alter table QUESTIONNAIRE
       delete foreign key FK_QUESTION_ETRE_CREE_ADMINIST
end if;

drop index if exists QUESTIONNAIRE.ETRE_CREER_PAR_FK;

drop index if exists QUESTIONNAIRE.QUESTIONNAIRE_PK;

drop table if exists QUESTIONNAIRE;

/*==============================================================*/
/* Table: QUESTIONNAIRE                                         */
/*==============================================================*/
create table QUESTIONNAIRE 
(
   QUESTR_ID            integer                        not null,
   UTIL_ID              integer                        not null,
   ADMIN_ID             integer                        not null,
   QUESTR_LIB           char(255)                      not null,
   QUESTR_DIFFICULTE    integer                        null,
   QUESTR_TEMPS         time                           null,
   constraint PK_QUESTIONNAIRE primary key (QUESTR_ID)
);

/*==============================================================*/
/* Index: QUESTIONNAIRE_PK                                      */
/*==============================================================*/
create unique index QUESTIONNAIRE_PK on QUESTIONNAIRE (
QUESTR_ID ASC
);

/*==============================================================*/
/* Index: ETRE_CREER_PAR_FK                                     */
/*==============================================================*/
create index ETRE_CREER_PAR_FK on QUESTIONNAIRE (
UTIL_ID ASC,
ADMIN_ID ASC
);

alter table QUESTIONNAIRE
   add constraint FK_QUESTION_ETRE_CREE_ADMINIST foreign key (UTIL_ID, ADMIN_ID)
      references ADMINISTRATEUR (UTIL_ID, ADMIN_ID)
      on update restrict
      on delete restrict;

drop index if exists QUESTION.QUESTION_PK;

drop table if exists QUESTION;

/*==============================================================*/
/* Table: QUESTION                                              */
/*==============================================================*/
create table QUESTION 
(
   QUEST_ID             integer                        not null,
   QUEST_LIB            varchar(32)                    null,
   constraint PK_QUESTION primary key (QUEST_ID)
);

/*==============================================================*/
/* Index: QUESTION_PK                                           */
/*==============================================================*/
create unique index QUESTION_PK on QUESTION (
QUEST_ID ASC
);

drop index if exists THEME.THEME_PK;

drop table if exists THEME;

/*==============================================================*/
/* Table: THEME                                                 */
/*==============================================================*/
create table THEME 
(
   THEME_ID             integer                        not null,
   THEME_LIB            char(255)                      null,
   constraint PK_THEME primary key (THEME_ID)
);

/*==============================================================*/
/* Index: THEME_PK                                              */
/*==============================================================*/
create unique index THEME_PK on THEME (
THEME_ID ASC
);

if exists(select 1 from sys.sysforeignkey where role='FK_REPONSE_ASSOCIER_QUESTION') then
    alter table REPONSE
       delete foreign key FK_REPONSE_ASSOCIER_QUESTION
end if;

drop index if exists REPONSE.ASSOCIER_FK;

drop index if exists REPONSE.REPONSE_PK;

drop table if exists REPONSE;

/*==============================================================*/
/* Table: REPONSE                                               */
/*==============================================================*/
create table REPONSE 
(
   REP_ID               integer                        not null,
   QUEST_ID             integer                        not null,
   REP_LIB              varchar                        not null,
   REP_BONNE            smallint                       not null,
   constraint PK_REPONSE primary key (REP_ID)
);

/*==============================================================*/
/* Index: REPONSE_PK                                            */
/*==============================================================*/
create unique index REPONSE_PK on REPONSE (
REP_ID ASC
);

/*==============================================================*/
/* Index: ASSOCIER_FK                                           */
/*==============================================================*/
create index ASSOCIER_FK on REPONSE (
QUEST_ID ASC
);

alter table REPONSE
   add constraint FK_REPONSE_ASSOCIER_QUESTION foreign key (QUEST_ID)
      references QUESTION (QUEST_ID)
      on update restrict
      on delete restrict;

      if exists(select 1 from sys.sysforeignkey where role='FK_REALISER_REALISER_JOUEUR') then
    alter table REALISER
       delete foreign key FK_REALISER_REALISER_JOUEUR
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_REALISER_REALISER2_QUESTION') then
    alter table REALISER
       delete foreign key FK_REALISER_REALISER2_QUESTION
end if;

drop index if exists REALISER.REALISER2_FK;

drop index if exists REALISER.REALISER_FK;

drop index if exists REALISER.REALISER_PK;

drop table if exists REALISER;

/*==============================================================*/
/* Table: REALISER                                              */
/*==============================================================*/
create table REALISER 
(
   UTIL_ID              integer                        not null,
   JOUEUR_ID            integer                        not null,
   QUESTR_ID            integer                        not null,
   SCORE                integer                        null,
   constraint PK_REALISER primary key clustered (UTIL_ID, JOUEUR_ID, QUESTR_ID)
);

/*==============================================================*/
/* Index: REALISER_PK                                           */
/*==============================================================*/
create unique clustered index REALISER_PK on REALISER (
UTIL_ID ASC,
JOUEUR_ID ASC,
QUESTR_ID ASC
);

/*==============================================================*/
/* Index: REALISER_FK                                           */
/*==============================================================*/
create index REALISER_FK on REALISER (
UTIL_ID ASC,
JOUEUR_ID ASC
);

/*==============================================================*/
/* Index: REALISER2_FK                                          */
/*==============================================================*/
create index REALISER2_FK on REALISER (
QUESTR_ID ASC
);

alter table REALISER
   add constraint FK_REALISER_REALISER_JOUEUR foreign key (UTIL_ID, JOUEUR_ID)
      references JOUEUR (UTIL_ID, JOUEUR_ID)
      on update restrict
      on delete restrict;

alter table REALISER
   add constraint FK_REALISER_REALISER2_QUESTION foreign key (QUESTR_ID)
      references QUESTIONNAIRE (QUESTR_ID)
      on update restrict
      on delete restrict;

if exists(select 1 from sys.sysforeignkey where role='FK_ETRE_POS_ETRE_POSE_QUESTION') then
    alter table ETRE_POSE_PAR
       delete foreign key FK_ETRE_POS_ETRE_POSE_QUESTION
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_ETRE_POS_ETRE_POSE_QUESTION') then
    alter table ETRE_POSE_PAR
       delete foreign key FK_ETRE_POS_ETRE_POSE_QUESTION
end if;

drop index if exists ETRE_POSE_PAR.ETRE_POSE_PAR2_FK;

drop index if exists ETRE_POSE_PAR.ETRE_POSE_PAR_FK;

drop index if exists ETRE_POSE_PAR.ETRE_POSE_PAR_PK;

drop table if exists ETRE_POSE_PAR;

/*==============================================================*/
/* Table: ETRE_POSE_PAR                                         */
/*==============================================================*/
create table ETRE_POSE_PAR 
(
   QUESTR_ID            integer                        not null,
   QUEST_ID             integer                        not null,
   constraint PK_ETRE_POSE_PAR primary key clustered (QUESTR_ID, QUEST_ID)
);

/*==============================================================*/
/* Index: ETRE_POSE_PAR_PK                                      */
/*==============================================================*/
create unique clustered index ETRE_POSE_PAR_PK on ETRE_POSE_PAR (
QUESTR_ID ASC,
QUEST_ID ASC
);

/*==============================================================*/
/* Index: ETRE_POSE_PAR_FK                                      */
/*==============================================================*/
create index ETRE_POSE_PAR_FK on ETRE_POSE_PAR (
QUESTR_ID ASC
);

/*==============================================================*/
/* Index: ETRE_POSE_PAR2_FK                                     */
/*==============================================================*/
create index ETRE_POSE_PAR2_FK on ETRE_POSE_PAR (
QUEST_ID ASC
);

alter table ETRE_POSE_PAR
   add constraint FK_ETRE_POS_ETRE_POSE_QUESTION foreign key (QUESTR_ID)
      references QUESTIONNAIRE (QUESTR_ID)
      on update restrict
      on delete restrict;

alter table ETRE_POSE_PAR
   add constraint FK_ETRE_POS_ETRE_POSE_QUESTION foreign key (QUEST_ID)
      references QUESTION (QUEST_ID)
      on update restrict
      on delete restrict;

if exists(select 1 from sys.sysforeignkey where role='FK_AVOIR_AVOIR_QUESTION') then
    alter table AVOIR
       delete foreign key FK_AVOIR_AVOIR_QUESTION
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_AVOIR_AVOIR2_THEME') then
    alter table AVOIR
       delete foreign key FK_AVOIR_AVOIR2_THEME
end if;

drop index if exists AVOIR.AVOIR2_FK;

drop index if exists AVOIR.AVOIR_FK;

drop index if exists AVOIR.AVOIR_PK;

drop table if exists AVOIR;

/*==============================================================*/
/* Table: AVOIR                                                 */
/*==============================================================*/
create table AVOIR 
(
   QUESTR_ID            integer                        not null,
   THEME_ID             integer                        not null,
   constraint PK_AVOIR primary key clustered (QUESTR_ID, THEME_ID)
);

/*==============================================================*/
/* Index: AVOIR_PK                                              */
/*==============================================================*/
create unique clustered index AVOIR_PK on AVOIR (
QUESTR_ID ASC,
THEME_ID ASC
);

/*==============================================================*/
/* Index: AVOIR_FK                                              */
/*==============================================================*/
create index AVOIR_FK on AVOIR (
QUESTR_ID ASC
);

/*==============================================================*/
/* Index: AVOIR2_FK                                             */
/*==============================================================*/
create index AVOIR2_FK on AVOIR (
THEME_ID ASC
);

alter table AVOIR
   add constraint FK_AVOIR_AVOIR_QUESTION foreign key (QUESTR_ID)
      references QUESTIONNAIRE (QUESTR_ID)
      on update restrict
      on delete restrict;

alter table AVOIR
   add constraint FK_AVOIR_AVOIR2_THEME foreign key (THEME_ID)
      references THEME (THEME_ID)
      on update restrict
      on delete restrict;
