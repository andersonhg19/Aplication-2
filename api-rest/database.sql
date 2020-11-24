CREATE DATABASE IF NOT EXISTS db_aplication_two;
USE db_aplication_two;



CREATE TABLE type_documents(
id_type_document         int(10) auto_increment not null,
type_document            varchar(50) NOT NULL,

CONSTRAINT pk_type_documents PRIMARY KEY(id_type_document)
)ENGINE=InnoDb;

CREATE TABLE state_users(
id_state_user      int(10) auto_increment not null,
state_user         varchar(50) NOT NULL,

CONSTRAINT pk_state_users PRIMARY KEY(id_state_user)
)ENGINE=InnoDb;

CREATE TABLE type_communications (
id_type_comunication        int(10) auto_increment not null,
type_communication           varchar(50) NOT NULL,

CONSTRAINT pk_type_communications PRIMARY KEY(id_type_comunication)
)ENGINE=InnoDb;

CREATE TABLE type_users(
id_type_user       int(10) auto_increment not null,
type_user          varchar(50) NOT NULL,

CONSTRAINT pk_type_users PRIMARY KEY(id_type_user)
)ENGINE=InnoDb;



CREATE TABLE users (
id_user					int(10) auto_increment not null,   
id_type_document		int(10) not null,	
num_document			varchar(50) NOT NULL,
name					varchar(50) NOT NULL,
lastname				varchar(50) NOT NULL,
address					varchar(50) NOT NULL,
id_type_comunication	int(10) not null,		 
id_type_user			int(10) not null,
id_state_user			int(10) not null,
created_at     			datetime DEFAULT NULL,
updated_at     			datetime DEFAULT NULL,
remember_token 			varchar(255),
password				varchar(50) NOT NULL,

CONSTRAINT pk_users PRIMARY KEY(id_user)
)ENGINE=InnoDb;


CREATE TABLE phones_user(
id_phone         int(10) auto_increment not null,
id_user		 	 int(10) not null,	
phone            varchar(50) NOT NULL,

CONSTRAINT pk_phones PRIMARY KEY(id_phone)
)ENGINE=InnoDb;


CREATE TABLE mails_user (
id_mail         int(10) auto_increment not null,
id_user			int(10) not null,
mail            varchar(50) NOT NULL,

CONSTRAINT pk_mails PRIMARY KEY(id_mail)
)ENGINE=InnoDb;


CREATE TABLE plane (
id_plane         		int(10) auto_increment not null,
plane					varchar(250) not null,
num_passengers            varchar(50) NOT NULL,

CONSTRAINT pk_mails PRIMARY KEY(id_plane)
)ENGINE=InnoDb;


CREATE TABLE flights (
id_flights    		      int(10) auto_increment not null,
price					  int(10) not null,
time					  int(10) not null,
name            		  varchar(50) NOT NULL,
id_plane            	  int(10) NOT NULL,
image       		      varchar(50) NOT NULL,
code 		          	  varchar(50) NOT NULL,


CONSTRAINT pk_mails PRIMARY KEY(id_flights)
)ENGINE=InnoDb;
