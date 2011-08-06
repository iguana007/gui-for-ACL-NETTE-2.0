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

SELECT pg_catalog.setval('gui_acl_privileges_id_seq', 5, true);

ALTER TABLE gui_acl_privileges ALTER COLUMN id SET DEFAULT nextval('gui_acl_privileges_id_seq'::regclass);

INSERT INTO gui_acl_privileges (id, key_name, name, comment) VALUES (1, 'acl_access', 'Acl Access', 'Access to the GUI for Acl.');
INSERT INTO gui_acl_privileges (id, key_name, name, comment) VALUES (3, 'sprava', 'Správa', '');
INSERT INTO gui_acl_privileges (id, key_name, name, comment) VALUES (4, 'nahled', 'Náhled', '');

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

SELECT pg_catalog.setval('gui_acl_resources_id_seq', 23, true);

ALTER TABLE gui_acl_resources ALTER COLUMN id SET DEFAULT nextval('gui_acl_resources_id_seq'::regclass);

INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (1, 'acl_permission', NULL, 'Acl Permission', 'GUI for Acl');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (2, 'ceska_sporitelna', NULL, 'Česká Spořitelna', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (3, 'oblast_zlin', 2, 'Oblast Zlín', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (4, 'oblast_praha', 2, 'Oblash Praha', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (5, 'oblast_usti', 2, 'Oblash Ústí', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (6, 'zlinsky_region', 3, 'Zlínský region', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (7, 'kromerizsky_region', 3, 'Kroměřížský region', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (8, 'vsetinsky_region', 3, 'Vsetínský region', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (9, 'pobocka_zarami', 6, 'Pobočka Zarámí', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (10, 'pobocka_tr_t_bati', 6, 'Pobočka Tř. T. Bati', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (11, 'pobocka_j_svahy', 6, 'Pobočka Jižní Svahy', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (12, 'pobocka_slusovice', 6, 'Pobočka Slušovice', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (13, 'pobocka_frystak', 6, 'Pobočka Fryšták', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (14, 'stavebni_sporitelna', 2, 'Stavební Spořitelna', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (15, 'penzijni_fond', 2, 'Penzijní fond ČS', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (16, 'ceska_pojistovna', 2, 'České pojišťovna', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (17, 'zlinsky_kraj', 16, 'Zlínský kraj', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (19, 'moravskoslezsky_kraj', 16, 'Moravskoslezský kraj', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (18, 'jihomoravsky_kraj', 16, 'Jihomoravský kraj', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (20, 'zlin', 17, 'Zlín', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (21, 'vsetin', 17, 'Vsetín', '');
INSERT INTO gui_acl_resources (id, key_name, parent_id, name, comment) VALUES (22, 'kromeriz', 17, 'Kroměříž', '');

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

SELECT pg_catalog.setval('gui_acl_roles_id_seq', 20, true);

ALTER TABLE gui_acl_roles ALTER COLUMN id SET DEFAULT nextval('gui_acl_roles_id_seq'::regclass);

INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (1, NULL, 'acl_admin', 'Acl Admin', 'Has access to the GUI for ACL.');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (2, NULL, 'generalni_reditel', 'Generální ředitel', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (3, 2, '1_namestek', '1. náměstek', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (4, 2, '2_namestek', '2. náměstek', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (6, 3, 'financni_rizeni', 'Finanční řízení', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (7, 3, 'rizeni_majetku', 'Řízení majetku', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (8, 4, 'podpora_prodeje', 'Podpora prodeje', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (9, 4, 'usek_bezpecnosti', 'Úsek bezpečnosti', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (10, 4, 'informacni_technologie', 'Informační technologie', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (11, 10, 'administrator', 'Administrátor', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (12, 11, 'it_technik', 'IT Technik', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (16, NULL, 'guest', 'Guest', 'Role of anonymous user.');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (17 ,NULL, 'financni_rizeni_2', 'Finanční řízení 2', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (18, 17, '1_namestek_2', '1. náměstek 2', '');
INSERT INTO gui_acl_roles (id, parent_id, key_name, name, comment) VALUES (19, 18, 'generalni_reditel_2', 'Generální ředitel 2', '');


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

SELECT pg_catalog.setval('gui_users_id_seq', 37, false);

ALTER TABLE gui_users ALTER COLUMN id SET DEFAULT nextval('gui_users_id_seq'::regclass);

INSERT INTO gui_users (id, name, password) VALUES (1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5');
INSERT INTO gui_users (id, name, password) VALUES (22, 'Tom', 'd9ffaca46d5990ec39501bcdf22ee7a1');
INSERT INTO gui_users (id, name, password) VALUES (23, 'Ota', 'ce2f7df9517a478394cd6f6954e8237a');
INSERT INTO gui_users (id, name, password) VALUES (24, 'Petr', 'e3407b95ce4f9d4c42415ca35513b903');
INSERT INTO gui_users (id, name, password) VALUES (25, 'Martin', '81d6f316d169150d0e8733866c38684d');
INSERT INTO gui_users (id, name, password) VALUES (26, 'Kristyna', 'd74ba6d91abd272d509cfe11cdef9171');
INSERT INTO gui_users (id, name, password) VALUES (27, 'Dasa', 'b9bd1167a96c54236d2740d8dc41e410');
INSERT INTO gui_users (id, name, password) VALUES (28, 'Karel', 'c63b94714facab1f24e9b96d72436d77');
INSERT INTO gui_users (id, name, password) VALUES (29, 'Jirka', '01b61ad8993fced8614cfa80289d4483');
INSERT INTO gui_users (id, name, password) VALUES (30, 'Ales', 'ba73c1cbc7244121edd7a02a70083cda');
INSERT INTO gui_users (id, name, password) VALUES (31, 'Roman', 'b5df36ac79aa6391ffb432b9e5ad7880');
INSERT INTO gui_users (id, name, password) VALUES (32, 'Jakub', '8cc6fcef7d3e41ff8bda76c7aefff7a2');
INSERT INTO gui_users (id, name, password) VALUES (33, 'Ivo', 'd51a04fb46898421a81f0016993b1cb0');
INSERT INTO gui_users (id, name, password) VALUES (34, 'Honza', '33430040b67a6d9eb31b4463bc358738');
INSERT INTO gui_users (id, name, password) VALUES (35, 'Marek', '091cbaf8fc9a3d12ce957d6228b3c04c');
INSERT INTO gui_users (id, name, password) VALUES (36, 'Jana', 'f1a7074f7ad4776b17046a2abcc6d4d4');

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
INSERT INTO gui_users_roles (user_id, role_id) VALUES (22, 1);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (22, 2);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (23, 3);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (24, 4);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (27, 6);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (26, 7);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (29, 10);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (28, 11);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (25, 12);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (30, 7);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (30, 12);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (34, 17);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (33, 18);
INSERT INTO gui_users_roles (user_id, role_id) VALUES (32, 19);

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

-- SELECT pg_catalog.setval('gui_acl_id_seq', 0, true);

ALTER TABLE gui_acl ALTER COLUMN id SET DEFAULT nextval('gui_acl_id_seq'::regclass);

INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (1, 1, 1, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (2, 4, 2, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (3, 3, 4, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (3, 3, 5, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (3, 3, 3, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 4, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 5, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 3, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 7, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 8, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (6, 3, 6, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 7, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 8, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 6, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 13, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 11, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 12, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 10, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 9, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 4, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 5, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (7, 3, 3, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (10, 3, 18, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (10, 3, 19, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (10, 3, 17, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 18, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 19, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 17, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 22, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 21, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (12, 3, 20, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (17, 4, 2, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (17, 3, 7, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (17, 3, 8, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (17, 3, 6, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (18, 3, 4, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (18, 3, 5, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (18, 3, 3, true);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 4, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 5, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 3, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 7, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 8, false);
INSERT INTO gui_acl (role_id, privilege_id, resource_id, access) VALUES (19, 3, 6, false);

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_pkey PRIMARY KEY (id);

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_privilege_id_fkey FOREIGN KEY (privilege_id) REFERENCES gui_acl_privileges(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_resource_id_fkey FOREIGN KEY (resource_id) REFERENCES gui_acl_resources(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY gui_acl
ADD CONSTRAINT gui_acl_role_id_fkey FOREIGN KEY (role_id) REFERENCES gui_acl_roles(id) ON UPDATE CASCADE ON DELETE CASCADE;
