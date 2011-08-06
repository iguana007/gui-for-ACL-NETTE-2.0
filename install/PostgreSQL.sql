--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';

CREATE TABLE gui_acl_privileges (
    id integer NOT NULL,
    key_name character varying(64) NOT NULL,
    name character varying(64) NOT NULL,
    comment character varying(250)
);

CREATE SEQUENCE gui_acl_privileges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

SELECT pg_catalog.setval('gui_acl_privileges_id_seq', 2, true);

ALTER TABLE gui_acl_privileges ALTER COLUMN id SET DEFAULT nextval('gui_acl_privileges_id_seq'::regclass);

INSERT INTO gui_acl_privileges (id, key_name, name, comment) VALUES (1, 'acl_access', 'Acl Access', 'Access to the GUI for Acl.');

ALTER TABLE ONLY gui_acl_privileges
ADD CONSTRAINT gui_acl_privileges_name_key UNIQUE (key_name);

ALTER TABLE ONLY gui_acl_privileges
ADD CONSTRAINT gui_privileges_pkey PRIMARY KEY (id);


-------------------------------------------------------------------------


CREATE TABLE gui_acl_resources (
    id integer NOT NULL,
    parent_id integer,
    key_name character varying(64) NOT NULL,
    name character varying(64) NOT NULL,
    comment character varying(250)
);

CREATE SEQUENCE gui_acl_resources_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

SELECT pg_catalog.setval('gui_acl_resources_id_seq', 2, true);

ALTER TABLE gui_acl_resources ALTER COLUMN id SET DEFAULT nextval('gui_acl_resources_id_seq'::regclass);

INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (1, 'acl_permission', NULL, 'Acl Permission', 'GUI for Acl');

ALTER TABLE ONLY gui_acl_resources
ADD CONSTRAINT gui_acl_resources_name_key UNIQUE (key_name);

ALTER TABLE ONLY gui_acl_resources
ADD CONSTRAINT gui_resources_pkey PRIMARY KEY (id);

ALTER TABLE ONLY gui_acl_resources
ADD CONSTRAINT gui_acl_resources_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES gui_acl_resources(id) ON UPDATE CASCADE ON DELETE CASCADE;


-------------------------------------------------------------------------


CREATE TABLE gui_acl_roles (
    id integer NOT NULL,
    parent_id integer,
    key_name character varying(64) NOT NULL,
    name character varying(64) NOT NULL,
    comment character varying(250)
);

CREATE SEQUENCE gui_acl_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

SELECT pg_catalog.setval('gui_acl_roles_id_seq', 3, true);

ALTER TABLE gui_acl_roles ALTER COLUMN id SET DEFAULT nextval('gui_acl_roles_id_seq'::regclass);

INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (1, NULL, 'acl_admin', 'Acl Admin', 'Has access to the GUI for ACL.');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (2, NULL, 'guest', 'Guest', 'Role of anonymous user.');

ALTER TABLE ONLY gui_acl_roles
ADD CONSTRAINT gui_acl_roles_name_key UNIQUE (key_name);

ALTER TABLE ONLY gui_acl_roles
ADD CONSTRAINT gui_roles_pkey PRIMARY KEY (id);

ALTER TABLE ONLY gui_acl_roles
ADD CONSTRAINT gui_roles_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES gui_acl_roles(id) ON UPDATE CASCADE ON DELETE CASCADE;


-------------------------------------------------------------------------


CREATE TABLE gui_users (
    id integer NOT NULL,
    name character varying(64) NOT NULL,
    password character varying(250) NOT NULL
);

CREATE SEQUENCE gui_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

SELECT pg_catalog.setval('gui_users_id_seq', 2, false);

ALTER TABLE gui_users ALTER COLUMN id SET DEFAULT nextval('gui_users_id_seq'::regclass);

INSERT INTO gui_users (id, name, password) VALUES (1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5');

ALTER TABLE ONLY gui_users
ADD CONSTRAINT gui_users_name_key UNIQUE (name);

ALTER TABLE ONLY gui_users
ADD CONSTRAINT gui_users_pkey PRIMARY KEY (id);


-------------------------------------------------------------------------


CREATE TABLE gui_users_roles (
    user_id integer NOT NULL,
    role_id integer NOT NULL
);

INSERT INTO gui_users_roles (user_id, role_id) VALUES (1, 1);

ALTER TABLE ONLY gui_users_roles
ADD CONSTRAINT gui_users_roles_pkey PRIMARY KEY (user_id, role_id);

ALTER TABLE ONLY gui_users_roles
ADD CONSTRAINT gui_users_roles_role_id_fkey FOREIGN KEY (role_id) REFERENCES gui_acl_roles(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY gui_users_roles
ADD CONSTRAINT gui_users_roles_user_id_fkey FOREIGN KEY (user_id) REFERENCES gui_users(id) ON UPDATE CASCADE ON DELETE CASCADE;

-------------------------------------------------------------------------

CREATE TABLE gui_acl (
    id integer NOT NULL,
    role_id integer NOT NULL,
    privilege_id integer,
    resource_id integer,
    access boolean
);

CREATE SEQUENCE gui_acl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

SELECT pg_catalog.setval('gui_acl_id_seq', 2, true);

ALTER TABLE gui_acl ALTER COLUMN id SET DEFAULT nextval('gui_acl_id_seq'::regclass);

INSERT INTO gui_acl (id, role_id, privilege_id, resource_id, access) VALUES (1, 1, 1, 1, true);

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_pkey PRIMARY KEY (id);

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_privilege_id_fkey FOREIGN KEY (privilege_id) REFERENCES gui_acl_privileges(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_resource_id_fkey FOREIGN KEY (resource_id) REFERENCES gui_acl_resources(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_role_id_fkey FOREIGN KEY (role_id) REFERENCES gui_acl_roles(id) ON UPDATE CASCADE ON DELETE CASCADE;
