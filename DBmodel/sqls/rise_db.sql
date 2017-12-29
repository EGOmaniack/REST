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

SET search_path TO pg_catalog,public,rest,access,users;
-- ddl-end --

-- object: rest.ways | type: TABLE --
-- DROP TABLE IF EXISTS rest.ways CASCADE;
CREATE TABLE rest.ways(
	id serial NOT NULL,
	way_name text NOT NULL,
	description text,
	CONSTRAINT ways_pk PRIMARY KEY (id),
	CONSTRAINT ways_uq UNIQUE (way_name)

);
-- ddl-end --
COMMENT ON COLUMN rest.ways.way_name IS 'имя пути';
-- ddl-end --
ALTER TABLE rest.ways OWNER TO postgres;
-- ddl-end --

INSERT INTO rest.ways (id, way_name, description) VALUES (DEFAULT, E'StartPage', E'Стартовая страница');
-- ddl-end --
INSERT INTO rest.ways (id, way_name, description) VALUES (DEFAULT, E'ExcelInt', E'Помощьв в калькуляциях');
-- ddl-end --
INSERT INTO rest.ways (id, way_name, description) VALUES (DEFAULT, E'SpecParcer', E'Работа с проектом для создания маршруток и др');
-- ddl-end --
INSERT INTO rest.ways (id, way_name, description) VALUES (DEFAULT, E'Identification', E'Профиль, регистрация и тд');
-- ddl-end --

-- object: access.accesses | type: TABLE --
-- DROP TABLE IF EXISTS access.accesses CASCADE;
CREATE TABLE access.accesses(
	id serial NOT NULL,
	way_id int4,
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
	name text NOT NULL DEFAULT 'unknown',
	surname text NOT NULL DEFAULT 'unknown',
	birthday date,
	CONSTRAINT user_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE users.users OWNER TO postgres;
-- ddl-end --

-- object: access.accesses_lvls | type: TABLE --
-- DROP TABLE IF EXISTS access.accesses_lvls CASCADE;
CREATE TABLE access.accesses_lvls(
	id serial NOT NULL,
	lvl_code text NOT NULL,
	description text,
	CONSTRAINT accesses_lvls_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE access.accesses_lvls OWNER TO postgres;
-- ddl-end --

INSERT INTO access.accesses_lvls (id, lvl_code, description) VALUES (DEFAULT, E'admin', E'admin');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description) VALUES (DEFAULT, E'boss', E'начальник');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description) VALUES (DEFAULT, E'regular', E'обычный уровень доступа ( допущен )');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description) VALUES (DEFAULT, E'guest', E'уровень доступа как у гостя без регистрации');
-- ddl-end --
INSERT INTO access.accesses_lvls (id, lvl_code, description) VALUES (DEFAULT, E'no_access', E'нет доступа');
-- ddl-end --

-- object: users.passwords | type: TABLE --
-- DROP TABLE IF EXISTS users.passwords CASCADE;
CREATE TABLE users.passwords(
	id serial NOT NULL,
	user_id int4 NOT NULL,
	login text NOT NULL,
	pass text NOT NULL,
	CONSTRAINT passwords_pk PRIMARY KEY (id)

);
-- ddl-end --
ALTER TABLE users.passwords OWNER TO postgres;
-- ddl-end --

-- object: users.new_user_request | type: TABLE --
-- DROP TABLE IF EXISTS users.new_user_request CASCADE;
CREATE TABLE users.new_user_request(
	id serial NOT NULL,
	name text DEFAULT 'unknown',
	surname text DEFAULT 'unknown',
	login text NOT NULL,
	pass text NOT NULL,
	status smallint NOT NULL DEFAULT 0,
	user_ip text,
	date date DEFAULT now(),
	CONSTRAINT new_user_request_pk PRIMARY KEY (id)

);
-- ddl-end --
COMMENT ON COLUMN users.new_user_request.status IS 'статус запроса 0 - не рассмотренно 1 - принято 2 - отвергнуто';
-- ddl-end --
ALTER TABLE users.new_user_request OWNER TO postgres;
-- ddl-end --

-- object: accesses_fk_ways | type: CONSTRAINT --
-- ALTER TABLE access.accesses DROP CONSTRAINT IF EXISTS accesses_fk_ways CASCADE;
ALTER TABLE access.accesses ADD CONSTRAINT accesses_fk_ways FOREIGN KEY (way_id)
REFERENCES rest.ways (id) MATCH FULL
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


