-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler  version: 0.9.0-alpha1
-- PostgreSQL version: 9.6
-- Project Site: pgmodeler.com.br
-- Model Author: ---


-- Database creation must be done outside an multicommand file.
-- These commands were put in this file only for convenience.
-- -- object: new_database | type: DATABASE --
-- -- DROP DATABASE IF EXISTS new_database;
-- CREATE DATABASE new_database
-- ;
-- -- ddl-end --
-- 

-- object: rest | type: SCHEMA --
 DROP SCHEMA IF EXISTS rest CASCADE;
CREATE SCHEMA rest;
-- ddl-end --

-- object: access | type: SCHEMA --
 DROP SCHEMA IF EXISTS access CASCADE;
CREATE SCHEMA access;
-- ddl-end --
ALTER SCHEMA access OWNER TO postgres;
-- ddl-end --

-- object: users | type: SCHEMA --
 DROP SCHEMA IF EXISTS users CASCADE;
CREATE SCHEMA users;
-- ddl-end --
ALTER SCHEMA users OWNER TO postgres;
-- ddl-end --

-- object: dictionary | type: SCHEMA --
 DROP SCHEMA IF EXISTS dictionary CASCADE;
CREATE SCHEMA dictionary;
-- ddl-end --
ALTER SCHEMA dictionary OWNER TO postgres;
-- ddl-end --

SET search_path TO pg_catalog,public,rest,access,users,dictionary;
-- ddl-end --

-- object: rest.flows | type: TABLE --
-- DROP TABLE IF EXISTS rest.flows CASCADE;
CREATE TABLE rest.flows(
	id serial NOT NULL,
	flow_name text NOT NULL,
	description text,
	min_access_lvl smallint NOT NULL,
	CONSTRAINT ways_pk PRIMARY KEY (id),
	CONSTRAINT ways_uq UNIQUE (flow_name)

);
-- ddl-end --
COMMENT ON COLUMN rest.flows.flow_name IS 'имя потока';
-- ddl-end --
ALTER TABLE rest.flows OWNER TO postgres;
-- ddl-end --

INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'StartPage', E'Стартовая страница', E'0');
-- ddl-end --
INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'SimpleExcelInt', E'Помощьв в калькуляциях', E'0');
-- ddl-end --
INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'SimpleSpecParser', E'Работа с проектом для создания маршруток и др', E'0');
-- ddl-end --
INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'NewPerson', E'Профиль, регистрация и тд', E'0');
-- ddl-end --
INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'Authorization', E'Авторизация', E'0');
-- ddl-end --
INSERT INTO rest.flows (id, flow_name, description, min_access_lvl) VALUES (DEFAULT, E'SetAccesses', E'Изменение уровней доступа', E'30');
-- ddl-end --

-- object: access.accesses | type: TABLE --
-- DROP TABLE IF EXISTS access.accesses CASCADE;
CREATE TABLE access.accesses(
	id serial NOT NULL,
	flow_id int4,
	user_id int4 NOT NULL,
	access_lvl_id int4 NOT NULL,
	CONSTRAINT accesses_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE access.accesses OWNER TO postgres;
-- ddl-end --

-- object: users.users | type: TABLE --
-- DROP TABLE IF EXISTS users.users CASCADE;
CREATE TABLE users.users(
	id serial NOT NULL,
	name text DEFAULT 'unknown',
	surname text,
	patronymic text,
	birthday date,
	removed bool DEFAULT false,
	CONSTRAINT user_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE users.users OWNER TO postgres;
-- ddl-end --

INSERT INTO users.users (id, name, surname, patronymic, birthday) VALUES (DEFAULT, E'root', E'root', E'root', DEFAULT);
-- ddl-end --

-- object: access.accesses_lvls | type: TABLE --
-- DROP TABLE IF EXISTS access.accesses_lvls CASCADE;
CREATE TABLE access.accesses_lvls(
	id serial NOT NULL,
	lvl_code text NOT NULL,
	description text,
	access_lvl smallint NOT NULL,
	CONSTRAINT accesses_lvls_pk PRIMARY KEY (id),
	CONSTRAINT access_lvl_uq UNIQUE (access_lvl)

);
-- ddl-end --
ALTER TABLE access.accesses_lvls OWNER TO postgres;
-- ddl-end --

INSERT INTO access.accesses_lvls (id, lvl_code, description, access_lvl) VALUES (DEFAULT, E'guest', E'уровень доступа как у гостя без регистрации', E'0');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description, access_lvl) VALUES (DEFAULT, E'regular', E'обычный уровень доступа ( допущен )', E'10');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description, access_lvl) VALUES (DEFAULT, E'boss', E'начальник', E'20');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description, access_lvl) VALUES (DEFAULT, E'admin', E'admin', E'30');
-- ddl-end --

-- object: users.passwords | type: TABLE --
-- DROP TABLE IF EXISTS users.passwords CASCADE;
CREATE TABLE users.passwords(
	id serial NOT NULL,
	user_id int4 NOT NULL,
	login text NOT NULL,
	pass text NOT NULL,
	CONSTRAINT passwords_pk PRIMARY KEY (id),
	CONSTRAINT passwords_uq UNIQUE (login)

);
-- ddl-end --
ALTER TABLE users.passwords OWNER TO postgres;
-- ddl-end --

INSERT INTO users.passwords (id, user_id, login, pass) VALUES (DEFAULT, E'1', E'root', E'bf01fc0344b08285c749e34db1ac51526ce944b2b7c032e109040cbdeeba458f');
-- ddl-end --

-- object: users.new_user_request | type: TABLE --
-- DROP TABLE IF EXISTS users.new_user_request CASCADE;
CREATE TABLE users.new_user_request(
	id serial NOT NULL,
	name text DEFAULT 'unknown',
	surname text DEFAULT 'unknown',
	patronymic text,
	login text NOT NULL,
	pass text NOT NULL,
	status smallint NOT NULL DEFAULT 0,
	user_ip text,
	date timestamp DEFAULT now(),
	CONSTRAINT new_user_request_pk PRIMARY KEY (id)

);
-- ddl-end --
COMMENT ON COLUMN users.new_user_request.status IS 'статус запроса 0 - не рассмотренно 1 - принято 2 - отвергнуто';
-- ddl-end --
ALTER TABLE users.new_user_request OWNER TO postgres;
-- ddl-end --

-- object: users.connections | type: TABLE --
-- DROP TABLE IF EXISTS users.connections CASCADE;
CREATE TABLE users.connections(
	id serial NOT NULL,
	user_id int4 NOT NULL,
	token text NOT NULL,
	made timestamp NOT NULL DEFAULT now(),
	removed bool DEFAULT false,
	CONSTRAINT con_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE users.connections OWNER TO postgres;
-- ddl-end --

-- object: dictionary.errors | type: TABLE --
-- DROP TABLE IF EXISTS dictionary.errors CASCADE;
CREATE TABLE dictionary.errors(
	id serial NOT NULL,
	code integer NOT NULL,
	message text NOT NULL,
	CONSTRAINT error_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE dictionary.errors OWNER TO postgres;
-- ddl-end --

INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'1', E'Необходимо задать логин');
-- ddl-end --
INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'2', E'Необходимо задать пароль');
-- ddl-end --
INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'3', E'Необходимо задать токен');
-- ddl-end --
INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'101', E'Пользователь с таким логином уже существует');
-- ddl-end --
INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'201', E'Неизвестная ошибка');
-- ddl-end --
INSERT INTO dictionary.errors (id, code, message) VALUES (DEFAULT, E'301', E'Ваш connection token устарел');
-- ddl-end --

-- object: flows_minfk | type: CONSTRAINT --
-- ALTER TABLE rest.flows DROP CONSTRAINT IF EXISTS flows_minfk CASCADE;
ALTER TABLE rest.flows ADD CONSTRAINT flows_minfk FOREIGN KEY (min_access_lvl)
REFERENCES access.accesses_lvls (access_lvl) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: accesses_fk_ways | type: CONSTRAINT --
-- ALTER TABLE access.accesses DROP CONSTRAINT IF EXISTS accesses_fk_ways CASCADE;
ALTER TABLE access.accesses ADD CONSTRAINT accesses_fk_ways FOREIGN KEY (flow_id)
REFERENCES rest.flows (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: accesses_fk_user | type: CONSTRAINT --
-- ALTER TABLE access.accesses DROP CONSTRAINT IF EXISTS accesses_fk_user CASCADE;
ALTER TABLE access.accesses ADD CONSTRAINT accesses_fk_user FOREIGN KEY (user_id)
REFERENCES users.users (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: accesses_fk_lvl | type: CONSTRAINT --
-- ALTER TABLE access.accesses DROP CONSTRAINT IF EXISTS accesses_fk_lvl CASCADE;
ALTER TABLE access.accesses ADD CONSTRAINT accesses_fk_lvl FOREIGN KEY (access_lvl_id)
REFERENCES access.accesses_lvls (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: passwords_fk_user | type: CONSTRAINT --
-- ALTER TABLE users.passwords DROP CONSTRAINT IF EXISTS passwords_fk_user CASCADE;
ALTER TABLE users.passwords ADD CONSTRAINT passwords_fk_user FOREIGN KEY (user_id)
REFERENCES users.users (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: con_fk | type: CONSTRAINT --
-- ALTER TABLE users.connections DROP CONSTRAINT IF EXISTS con_fk CASCADE;
ALTER TABLE users.connections ADD CONSTRAINT con_fk FOREIGN KEY (user_id)
REFERENCES users.users (id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


