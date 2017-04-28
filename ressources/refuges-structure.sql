--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

DROP INDEX public.type_precision_gps_ordre;
DROP INDEX public.polygones_nom_polygone;
DROP INDEX public.polygones_id_polygone_type;
DROP INDEX public.polygones_geom;
DROP INDEX public.polygone_type_ordre_taille;
DROP INDEX public.points_places_matelas;
DROP INDEX public.points_places;
DROP INDEX public.points_nom;
DROP INDEX public.points_modele;
DROP INDEX public.points_matelas;
DROP INDEX public.points_id_point_type;
DROP INDEX public.points_id_point_gps;
DROP INDEX public.points_gps_id_type_precision_gps;
DROP INDEX public.points_gps_geom;
DROP INDEX public.points_gps_altitude;
DROP INDEX public.points_ferme;
DROP INDEX public.phpbb_vote_voters_vote_user_ip;
DROP INDEX public.phpbb_vote_voters_vote_user_id;
DROP INDEX public.phpbb_vote_voters_vote_id;
DROP INDEX public.phpbb_vote_results_vote_option_id;
DROP INDEX public.phpbb_vote_results_vote_id;
DROP INDEX public.phpbb_vote_desc_topic_id;
DROP INDEX public.phpbb_users_user_session_time;
DROP INDEX public.phpbb_users_user_notify_new_topic;
DROP INDEX public.phpbb_user_group_user_id;
DROP INDEX public.phpbb_user_group_group_id;
DROP INDEX public.phpbb_topics_watch_user_id;
DROP INDEX public.phpbb_topics_watch_topic_id;
DROP INDEX public.phpbb_topics_watch_notify_status;
DROP INDEX public.phpbb_topics_topic_type;
DROP INDEX public.phpbb_topics_topic_status;
DROP INDEX public.phpbb_topics_topic_moved_id;
DROP INDEX public.phpbb_topics_topic_id_point;
DROP INDEX public.phpbb_topics_forum_id;
DROP INDEX public.phpbb_sessions_session_user_id;
DROP INDEX public.phpbb_sessions_session_id_session_ip_session_user_id;
DROP INDEX public.phpbb_search_wordmatch_word_id;
DROP INDEX public.phpbb_search_wordmatch_post_id;
DROP INDEX public.phpbb_search_wordlist_word_id;
DROP INDEX public.phpbb_search_results_session_id;
DROP INDEX public.phpbb_search_rebuild_end_post_id;
DROP INDEX public.phpbb_privmsgs_privmsgs_to_userid;
DROP INDEX public.phpbb_privmsgs_privmsgs_from_userid;
DROP INDEX public.phpbb_posts_topic_id;
DROP INDEX public.phpbb_posts_poster_id;
DROP INDEX public.phpbb_posts_post_time;
DROP INDEX public.phpbb_posts_forum_id;
DROP INDEX public.phpbb_groups_group_single_user;
DROP INDEX public.phpbb_forums_forum_order;
DROP INDEX public.phpbb_forums_forum_last_post_id;
DROP INDEX public.phpbb_forums_cat_id;
DROP INDEX public.phpbb_forum_prune_forum_id;
DROP INDEX public.phpbb_categories_cat_order;
DROP INDEX public.phpbb_banlist_ban_ip_ban_userid;
DROP INDEX public.phpbb_auth_access_group_id;
DROP INDEX public.phpbb_auth_access_forum_id;
DROP INDEX public.index_nom_page;
DROP INDEX public.commentaires_photo_existe;
DROP INDEX public.commentaires_id_point;
DROP INDEX public.commentaires_id_createur;
DROP INDEX public.commentaires_demande_correction;
DROP INDEX public.commentaires_date;
DROP INDEX public.commentaires_auteur;
ALTER TABLE ONLY public.type_precision_gps DROP CONSTRAINT type_precision_gps_id_type_precision_gps_pkey;
ALTER TABLE ONLY public.polygones DROP CONSTRAINT polygones_id_polygone_pkey;
ALTER TABLE ONLY public.polygone_type DROP CONSTRAINT polygone_type_id_polygone_type_pkey;
ALTER TABLE ONLY public.points DROP CONSTRAINT points_id_point_pkey;
ALTER TABLE ONLY public.points_gps DROP CONSTRAINT points_gps_id_point_gps_pkey;
ALTER TABLE ONLY public.point_type DROP CONSTRAINT point_type_id_point_type_pkey;
ALTER TABLE ONLY public.phpbb_words DROP CONSTRAINT phpbb_words_word_id_pkey;
ALTER TABLE ONLY public.phpbb_vote_desc DROP CONSTRAINT phpbb_vote_desc_vote_id_pkey;
ALTER TABLE ONLY public.phpbb_users DROP CONSTRAINT phpbb_users_user_id_pkey;
ALTER TABLE ONLY public.phpbb_topics DROP CONSTRAINT phpbb_topics_topic_id_pkey;
ALTER TABLE ONLY public.phpbb_themes DROP CONSTRAINT phpbb_themes_themes_id_pkey;
ALTER TABLE ONLY public.phpbb_themes_name DROP CONSTRAINT phpbb_themes_name_themes_id_pkey;
ALTER TABLE ONLY public.phpbb_smilies DROP CONSTRAINT phpbb_smilies_smilies_id_pkey;
ALTER TABLE ONLY public.phpbb_sessions DROP CONSTRAINT phpbb_sessions_session_id_pkey;
ALTER TABLE ONLY public.phpbb_search_wordlist DROP CONSTRAINT phpbb_search_wordlist_word_text_pkey;
ALTER TABLE ONLY public.phpbb_search_results DROP CONSTRAINT phpbb_search_results_search_id_pkey;
ALTER TABLE ONLY public.phpbb_search_rebuild DROP CONSTRAINT phpbb_search_rebuild_rebuild_session_id_pkey;
ALTER TABLE ONLY public.phpbb_ranks DROP CONSTRAINT phpbb_ranks_rank_id_pkey;
ALTER TABLE ONLY public.phpbb_privmsgs_text DROP CONSTRAINT phpbb_privmsgs_text_privmsgs_text_id_pkey;
ALTER TABLE ONLY public.phpbb_privmsgs DROP CONSTRAINT phpbb_privmsgs_privmsgs_id_pkey;
ALTER TABLE ONLY public.phpbb_posts_text DROP CONSTRAINT phpbb_posts_text_post_id_pkey;
ALTER TABLE ONLY public.phpbb_posts DROP CONSTRAINT phpbb_posts_post_id_pkey;
ALTER TABLE ONLY public.phpbb_groups DROP CONSTRAINT phpbb_groups_group_id_pkey;
ALTER TABLE ONLY public.phpbb_forums DROP CONSTRAINT phpbb_forums_forum_id_pkey;
ALTER TABLE ONLY public.phpbb_forum_prune DROP CONSTRAINT phpbb_forum_prune_prune_id_pkey;
ALTER TABLE ONLY public.phpbb_disallow DROP CONSTRAINT phpbb_disallow_disallow_id_pkey;
ALTER TABLE ONLY public.phpbb_confirm DROP CONSTRAINT phpbb_confirm_session_id_confirm_id_pkey;
ALTER TABLE ONLY public.phpbb_config DROP CONSTRAINT phpbb_config_config_name_pkey;
ALTER TABLE ONLY public.phpbb_categories DROP CONSTRAINT phpbb_categories_cat_id_pkey;
ALTER TABLE ONLY public.phpbb_banlist DROP CONSTRAINT phpbb_banlist_ban_id_pkey;
ALTER TABLE ONLY public.commentaires DROP CONSTRAINT commentaires_id_commentaire_pkey;
DROP VIEW public.wfs_polys;
DROP TABLE public.type_precision_gps;
DROP SEQUENCE public.type_precision_gps_id_type_precision_gps_seq;
DROP VIEW public.polys_6;
DROP VIEW public.polys_3;
DROP VIEW public.polys_13;
DROP VIEW public.polys_12;
DROP VIEW public.polys_11;
DROP VIEW public.polys_10;
DROP VIEW public.polys_1;
DROP TABLE public.polygones;
DROP SEQUENCE public.polygones_id_polygone_seq;
DROP TABLE public.polygone_type;
DROP SEQUENCE public.polygone_type_id_polygone_type_seq;
DROP SEQUENCE public.points_gps_sans_poly_id_point_gps_seq;
DROP TABLE public.points_gps;
DROP SEQUENCE public.points_gps_id_point_gps_seq;
DROP TABLE public.points;
DROP SEQUENCE public.points_id_point_seq;
DROP TABLE public.point_type;
DROP SEQUENCE public.point_type_id_point_type_seq;
DROP TABLE public.phpbb_words;
DROP SEQUENCE public.phpbb_words_word_id_seq;
DROP TABLE public.phpbb_vote_voters;
DROP TABLE public.phpbb_vote_results;
DROP TABLE public.phpbb_vote_desc;
DROP SEQUENCE public.phpbb_vote_desc_vote_id_seq;
DROP TABLE public.phpbb_users;
DROP TABLE public.phpbb_user_group;
DROP TABLE public.phpbb_topics_watch;
DROP TABLE public.phpbb_topics;
DROP SEQUENCE public.phpbb_topics_topic_id_seq;
DROP TABLE public.phpbb_themes_name;
DROP TABLE public.phpbb_themes;
DROP SEQUENCE public.phpbb_themes_themes_id_seq;
DROP TABLE public.phpbb_smilies;
DROP SEQUENCE public.phpbb_smilies_smilies_id_seq;
DROP TABLE public.phpbb_sessions;
DROP TABLE public.phpbb_search_wordmatch;
DROP TABLE public.phpbb_search_wordlist;
DROP SEQUENCE public.phpbb_search_wordlist_word_id_seq;
DROP TABLE public.phpbb_search_results;
DROP TABLE public.phpbb_search_rebuild;
DROP SEQUENCE public.phpbb_search_rebuild_rebuild_session_id_seq;
DROP TABLE public.phpbb_ranks;
DROP SEQUENCE public.phpbb_ranks_rank_id_seq;
DROP TABLE public.phpbb_privmsgs_text;
DROP TABLE public.phpbb_privmsgs;
DROP SEQUENCE public.phpbb_privmsgs_privmsgs_id_seq;
DROP TABLE public.phpbb_posts_text;
DROP TABLE public.phpbb_posts;
DROP SEQUENCE public.phpbb_posts_post_id_seq;
DROP TABLE public.phpbb_groups;
DROP SEQUENCE public.phpbb_groups_group_id_seq;
DROP TABLE public.phpbb_forums;
DROP TABLE public.phpbb_forum_prune;
DROP SEQUENCE public.phpbb_forum_prune_prune_id_seq;
DROP TABLE public.phpbb_disallow;
DROP SEQUENCE public.phpbb_disallow_disallow_id_seq;
DROP TABLE public.phpbb_confirm;
DROP TABLE public.phpbb_config;
DROP TABLE public.phpbb_categories;
DROP SEQUENCE public.phpbb_categories_cat_id_seq;
DROP TABLE public.phpbb_banlist;
DROP SEQUENCE public.phpbb_banlist_ban_id_seq;
DROP TABLE public.phpbb_auth_access;
DROP TABLE public.pages_wiki;
DROP SEQUENCE public.osm_tags_id_osm_tag_seq;
DROP SEQUENCE public.lien_polygone_gps_id_lien_polygone_gps_seq;
DROP TABLE public.commentaires;
DROP SEQUENCE public.commentaires_id_commentaire_seq;
DROP EXTENSION unaccent;
DROP EXTENSION postgis;
DROP EXTENSION pg_trgm;
DROP EXTENSION fuzzystrmatch;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: fuzzystrmatch; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;


--
-- Name: EXTENSION fuzzystrmatch; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';


--
-- Name: pg_trgm; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pg_trgm WITH SCHEMA public;


--
-- Name: EXTENSION pg_trgm; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pg_trgm IS 'text similarity measurement and index searching based on trigrams';


--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


--
-- Name: unaccent; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS unaccent WITH SCHEMA public;


--
-- Name: EXTENSION unaccent; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION unaccent IS 'text search dictionary that removes accents';


SET search_path = public, pg_catalog;

--
-- Name: commentaires_id_commentaire_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE commentaires_id_commentaire_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commentaires_id_commentaire_seq OWNER TO refuges;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: commentaires; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE commentaires (
    id_commentaire integer DEFAULT nextval('commentaires_id_commentaire_seq'::regclass) NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_point integer DEFAULT 0 NOT NULL,
    texte text NOT NULL,
    auteur_commentaire character varying(80),
    photo_existe integer DEFAULT 0 NOT NULL,
    date_photo date,
    demande_correction integer DEFAULT 0 NOT NULL,
    id_createur_commentaire integer DEFAULT 0 NOT NULL
);


ALTER TABLE commentaires OWNER TO refuges;

--
-- Name: COLUMN commentaires.date; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN commentaires.date IS 'ajout de default now, qu''on ait pas besoin de le gerer';


--
-- Name: lien_polygone_gps_id_lien_polygone_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE lien_polygone_gps_id_lien_polygone_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lien_polygone_gps_id_lien_polygone_gps_seq OWNER TO refuges;

--
-- Name: osm_tags_id_osm_tag_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE osm_tags_id_osm_tag_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE osm_tags_id_osm_tag_seq OWNER TO refuges;

--
-- Name: pages_wiki; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE pages_wiki (
    nom_page character varying(200) NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    contenu text
);


ALTER TABLE pages_wiki OWNER TO refuges;

--
-- Name: phpbb_auth_access; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_auth_access (
    group_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    auth_view integer DEFAULT 0 NOT NULL,
    auth_read integer DEFAULT 0 NOT NULL,
    auth_post integer DEFAULT 0 NOT NULL,
    auth_reply integer DEFAULT 0 NOT NULL,
    auth_edit integer DEFAULT 0 NOT NULL,
    auth_delete integer DEFAULT 0 NOT NULL,
    auth_sticky integer DEFAULT 0 NOT NULL,
    auth_announce integer DEFAULT 0 NOT NULL,
    auth_vote integer DEFAULT 0 NOT NULL,
    auth_pollcreate integer DEFAULT 0 NOT NULL,
    auth_attachments integer DEFAULT 0 NOT NULL,
    auth_mod integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_auth_access OWNER TO refuges;

--
-- Name: phpbb_banlist_ban_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_banlist_ban_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_banlist_ban_id_seq OWNER TO refuges;

--
-- Name: phpbb_banlist; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_banlist (
    ban_id integer DEFAULT nextval('phpbb_banlist_ban_id_seq'::regclass) NOT NULL,
    ban_userid integer DEFAULT 0 NOT NULL,
    ban_ip character varying(8) DEFAULT ''::character varying NOT NULL,
    ban_email character varying(255)
);


ALTER TABLE phpbb_banlist OWNER TO refuges;

--
-- Name: phpbb_categories_cat_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_categories_cat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_categories_cat_id_seq OWNER TO refuges;

--
-- Name: phpbb_categories; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_categories (
    cat_id integer DEFAULT nextval('phpbb_categories_cat_id_seq'::regclass) NOT NULL,
    cat_title character varying(100),
    cat_order integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_categories OWNER TO refuges;

--
-- Name: phpbb_config; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_config (
    config_name character varying(255) DEFAULT ''::character varying NOT NULL,
    config_value text NOT NULL
);


ALTER TABLE phpbb_config OWNER TO refuges;

--
-- Name: phpbb_confirm; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_confirm (
    confirm_id character(32) DEFAULT ''::character(1) NOT NULL,
    session_id character(32) DEFAULT ''::character(1) NOT NULL,
    code character(6) DEFAULT ''::character(1) NOT NULL
);


ALTER TABLE phpbb_confirm OWNER TO refuges;

--
-- Name: phpbb_disallow_disallow_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_disallow_disallow_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_disallow_disallow_id_seq OWNER TO refuges;

--
-- Name: phpbb_disallow; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_disallow (
    disallow_id integer DEFAULT nextval('phpbb_disallow_disallow_id_seq'::regclass) NOT NULL,
    disallow_username character varying(25) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE phpbb_disallow OWNER TO refuges;

--
-- Name: phpbb_forum_prune_prune_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_forum_prune_prune_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_forum_prune_prune_id_seq OWNER TO refuges;

--
-- Name: phpbb_forum_prune; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_forum_prune (
    prune_id integer DEFAULT nextval('phpbb_forum_prune_prune_id_seq'::regclass) NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    prune_days integer DEFAULT 0 NOT NULL,
    prune_freq integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_forum_prune OWNER TO refuges;

--
-- Name: phpbb_forums; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_forums (
    forum_id integer DEFAULT 0 NOT NULL,
    cat_id integer DEFAULT 0 NOT NULL,
    forum_name character varying(150),
    forum_desc text,
    forum_status integer DEFAULT 0 NOT NULL,
    forum_order integer DEFAULT 1 NOT NULL,
    forum_posts integer DEFAULT 0 NOT NULL,
    forum_topics integer DEFAULT 0 NOT NULL,
    forum_last_post_id integer DEFAULT 0 NOT NULL,
    prune_next integer,
    prune_enable integer DEFAULT 0 NOT NULL,
    auth_view integer DEFAULT 0 NOT NULL,
    auth_read integer DEFAULT 0 NOT NULL,
    auth_post integer DEFAULT 0 NOT NULL,
    auth_reply integer DEFAULT 0 NOT NULL,
    auth_edit integer DEFAULT 0 NOT NULL,
    auth_delete integer DEFAULT 0 NOT NULL,
    auth_sticky integer DEFAULT 0 NOT NULL,
    auth_announce integer DEFAULT 0 NOT NULL,
    auth_vote integer DEFAULT 0 NOT NULL,
    auth_pollcreate integer DEFAULT 0 NOT NULL,
    auth_attachments integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_forums OWNER TO refuges;

--
-- Name: phpbb_groups_group_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_groups_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_groups_group_id_seq OWNER TO refuges;

--
-- Name: phpbb_groups; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_groups (
    group_id integer DEFAULT nextval('phpbb_groups_group_id_seq'::regclass) NOT NULL,
    group_type integer DEFAULT 1 NOT NULL,
    group_name character varying(40) DEFAULT ''::character varying NOT NULL,
    group_description character varying(255) DEFAULT ''::character varying NOT NULL,
    group_moderator integer DEFAULT 0 NOT NULL,
    group_single_user integer DEFAULT 1 NOT NULL
);


ALTER TABLE phpbb_groups OWNER TO refuges;

--
-- Name: phpbb_posts_post_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_posts_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_posts_post_id_seq OWNER TO refuges;

--
-- Name: phpbb_posts; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_posts (
    post_id integer DEFAULT nextval('phpbb_posts_post_id_seq'::regclass) NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    poster_id integer DEFAULT 0 NOT NULL,
    post_time integer DEFAULT 0 NOT NULL,
    poster_ip character varying(32) DEFAULT ''::character varying NOT NULL,
    post_username character varying(25),
    enable_bbcode integer DEFAULT 1 NOT NULL,
    enable_html integer DEFAULT 0 NOT NULL,
    enable_smilies integer DEFAULT 1 NOT NULL,
    enable_sig integer DEFAULT 1 NOT NULL,
    post_edit_time integer,
    post_edit_count integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_posts OWNER TO refuges;

--
-- Name: phpbb_posts_text; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_posts_text (
    post_id integer DEFAULT 0 NOT NULL,
    bbcode_uid character varying(10) DEFAULT ''::character varying NOT NULL,
    post_subject character varying(90),
    post_text text
);


ALTER TABLE phpbb_posts_text OWNER TO refuges;

--
-- Name: phpbb_privmsgs_privmsgs_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_privmsgs_privmsgs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_privmsgs_privmsgs_id_seq OWNER TO refuges;

--
-- Name: phpbb_privmsgs; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_privmsgs (
    privmsgs_id integer DEFAULT nextval('phpbb_privmsgs_privmsgs_id_seq'::regclass) NOT NULL,
    privmsgs_type integer DEFAULT 0 NOT NULL,
    privmsgs_subject character varying(255) DEFAULT '0'::character varying NOT NULL,
    privmsgs_from_userid integer DEFAULT 0 NOT NULL,
    privmsgs_to_userid integer DEFAULT 0 NOT NULL,
    privmsgs_date integer DEFAULT 0 NOT NULL,
    privmsgs_ip character varying(32) DEFAULT ''::character varying NOT NULL,
    privmsgs_enable_bbcode integer DEFAULT 1 NOT NULL,
    privmsgs_enable_html integer DEFAULT 0 NOT NULL,
    privmsgs_enable_smilies integer DEFAULT 1 NOT NULL,
    privmsgs_attach_sig integer DEFAULT 1 NOT NULL
);


ALTER TABLE phpbb_privmsgs OWNER TO refuges;

--
-- Name: phpbb_privmsgs_text; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_privmsgs_text (
    privmsgs_text_id integer DEFAULT 0 NOT NULL,
    privmsgs_bbcode_uid character varying(10) DEFAULT '0'::character varying NOT NULL,
    privmsgs_text text
);


ALTER TABLE phpbb_privmsgs_text OWNER TO refuges;

--
-- Name: phpbb_ranks_rank_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_ranks_rank_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_ranks_rank_id_seq OWNER TO refuges;

--
-- Name: phpbb_ranks; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_ranks (
    rank_id integer DEFAULT nextval('phpbb_ranks_rank_id_seq'::regclass) NOT NULL,
    rank_title character varying(50) DEFAULT ''::character varying NOT NULL,
    rank_min integer DEFAULT 0 NOT NULL,
    rank_special integer DEFAULT 0,
    rank_image character varying(255)
);


ALTER TABLE phpbb_ranks OWNER TO refuges;

--
-- Name: phpbb_search_rebuild_rebuild_session_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_search_rebuild_rebuild_session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_search_rebuild_rebuild_session_id_seq OWNER TO refuges;

--
-- Name: phpbb_search_rebuild; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_search_rebuild (
    rebuild_session_id integer DEFAULT nextval('phpbb_search_rebuild_rebuild_session_id_seq'::regclass) NOT NULL,
    start_post_id integer DEFAULT 0 NOT NULL,
    end_post_id integer DEFAULT 0 NOT NULL,
    start_time integer DEFAULT 0 NOT NULL,
    end_time integer DEFAULT 0 NOT NULL,
    last_cycle_time integer DEFAULT 0 NOT NULL,
    session_time integer DEFAULT 0 NOT NULL,
    session_posts integer DEFAULT 0 NOT NULL,
    session_cycles integer DEFAULT 0 NOT NULL,
    search_size bigint DEFAULT 0 NOT NULL,
    rebuild_session_status integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_search_rebuild OWNER TO refuges;

--
-- Name: phpbb_search_results; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_search_results (
    search_id bigint DEFAULT 0 NOT NULL,
    session_id character varying(32) DEFAULT ''::character varying NOT NULL,
    search_array text NOT NULL
);


ALTER TABLE phpbb_search_results OWNER TO refuges;

--
-- Name: phpbb_search_wordlist_word_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_search_wordlist_word_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_search_wordlist_word_id_seq OWNER TO refuges;

--
-- Name: phpbb_search_wordlist; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_search_wordlist (
    word_text character varying(50) DEFAULT ''::character varying NOT NULL,
    word_id integer DEFAULT nextval('phpbb_search_wordlist_word_id_seq'::regclass) NOT NULL,
    word_common bigint DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_search_wordlist OWNER TO refuges;

--
-- Name: phpbb_search_wordmatch; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_search_wordmatch (
    post_id integer DEFAULT 0 NOT NULL,
    word_id integer DEFAULT 0 NOT NULL,
    title_match integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_search_wordmatch OWNER TO refuges;

--
-- Name: phpbb_sessions; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_sessions (
    session_id character(32) DEFAULT ''::character(1) NOT NULL,
    session_user_id integer DEFAULT 0 NOT NULL,
    session_start integer DEFAULT 0 NOT NULL,
    session_time integer DEFAULT 0 NOT NULL,
    session_ip character(32) DEFAULT '0'::character(1) NOT NULL,
    session_page integer DEFAULT 0 NOT NULL,
    session_logged_in integer DEFAULT 0 NOT NULL,
    session_admin integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_sessions OWNER TO refuges;

--
-- Name: phpbb_smilies_smilies_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_smilies_smilies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_smilies_smilies_id_seq OWNER TO refuges;

--
-- Name: phpbb_smilies; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_smilies (
    smilies_id integer DEFAULT nextval('phpbb_smilies_smilies_id_seq'::regclass) NOT NULL,
    code character varying(50),
    smile_url character varying(100),
    emoticon character varying(75)
);


ALTER TABLE phpbb_smilies OWNER TO refuges;

--
-- Name: phpbb_themes_themes_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_themes_themes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_themes_themes_id_seq OWNER TO refuges;

--
-- Name: phpbb_themes; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_themes (
    themes_id integer DEFAULT nextval('phpbb_themes_themes_id_seq'::regclass) NOT NULL,
    template_name character varying(30) DEFAULT ''::character varying NOT NULL,
    style_name character varying(30) DEFAULT ''::character varying NOT NULL,
    head_stylesheet character varying(100),
    body_background character varying(100),
    body_bgcolor character varying(6),
    body_text character varying(6),
    body_link character varying(6),
    body_vlink character varying(6),
    body_alink character varying(6),
    body_hlink character varying(6),
    tr_color1 character varying(6),
    tr_color2 character varying(6),
    tr_color3 character varying(6),
    tr_class1 character varying(25),
    tr_class2 character varying(25),
    tr_class3 character varying(25),
    th_color1 character varying(6),
    th_color2 character varying(6),
    th_color3 character varying(6),
    th_class1 character varying(25),
    th_class2 character varying(25),
    th_class3 character varying(25),
    td_color1 character varying(6),
    td_color2 character varying(6),
    td_color3 character varying(6),
    td_class1 character varying(25),
    td_class2 character varying(25),
    td_class3 character varying(25),
    fontface1 character varying(50),
    fontface2 character varying(50),
    fontface3 character varying(50),
    fontsize1 integer,
    fontsize2 integer,
    fontsize3 integer,
    fontcolor1 character varying(6),
    fontcolor2 character varying(6),
    fontcolor3 character varying(6),
    span_class1 character varying(25),
    span_class2 character varying(25),
    span_class3 character varying(25),
    img_size_poll integer,
    img_size_privmsg integer
);


ALTER TABLE phpbb_themes OWNER TO refuges;

--
-- Name: phpbb_themes_name; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_themes_name (
    themes_id integer DEFAULT 0 NOT NULL,
    tr_color1_name character(50),
    tr_color2_name character(50),
    tr_color3_name character(50),
    tr_class1_name character(50),
    tr_class2_name character(50),
    tr_class3_name character(50),
    th_color1_name character(50),
    th_color2_name character(50),
    th_color3_name character(50),
    th_class1_name character(50),
    th_class2_name character(50),
    th_class3_name character(50),
    td_color1_name character(50),
    td_color2_name character(50),
    td_color3_name character(50),
    td_class1_name character(50),
    td_class2_name character(50),
    td_class3_name character(50),
    fontface1_name character(50),
    fontface2_name character(50),
    fontface3_name character(50),
    fontsize1_name character(50),
    fontsize2_name character(50),
    fontsize3_name character(50),
    fontcolor1_name character(50),
    fontcolor2_name character(50),
    fontcolor3_name character(50),
    span_class1_name character(50),
    span_class2_name character(50),
    span_class3_name character(50)
);


ALTER TABLE phpbb_themes_name OWNER TO refuges;

--
-- Name: phpbb_topics_topic_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_topics_topic_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_topics_topic_id_seq OWNER TO refuges;

--
-- Name: phpbb_topics; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_topics (
    topic_id integer DEFAULT nextval('phpbb_topics_topic_id_seq'::regclass) NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    topic_title character varying(90) NOT NULL,
    topic_poster integer DEFAULT 0 NOT NULL,
    topic_time integer DEFAULT 0 NOT NULL,
    topic_views integer DEFAULT 0 NOT NULL,
    topic_replies integer DEFAULT 0 NOT NULL,
    topic_status integer DEFAULT 0 NOT NULL,
    topic_vote integer DEFAULT 0 NOT NULL,
    topic_type integer DEFAULT 0 NOT NULL,
    topic_first_post_id integer DEFAULT 0 NOT NULL,
    topic_last_post_id integer DEFAULT 0 NOT NULL,
    topic_moved_id integer DEFAULT 0 NOT NULL,
    topic_id_point integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_topics OWNER TO refuges;

--
-- Name: phpbb_topics_watch; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_topics_watch (
    topic_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    notify_status integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_topics_watch OWNER TO refuges;

--
-- Name: phpbb_user_group; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_user_group (
    group_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    user_pending integer
);


ALTER TABLE phpbb_user_group OWNER TO refuges;

--
-- Name: phpbb_users; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_users (
    user_id integer DEFAULT 0 NOT NULL,
    user_active integer DEFAULT 1,
    username character varying(25) DEFAULT ''::character varying NOT NULL,
    user_password character varying(32) DEFAULT ''::character varying NOT NULL,
    user_session_time integer DEFAULT 0 NOT NULL,
    user_session_page smallint DEFAULT 0 NOT NULL,
    user_lastvisit integer DEFAULT 0 NOT NULL,
    user_regdate integer DEFAULT 0 NOT NULL,
    user_level integer DEFAULT 0,
    user_posts integer DEFAULT 0 NOT NULL,
    user_timezone numeric(5,2) DEFAULT 0.00 NOT NULL,
    user_style integer,
    user_lang character varying(255),
    user_dateformat character varying(14) DEFAULT 'd M Y H:i'::character varying NOT NULL,
    user_new_privmsg integer DEFAULT 0 NOT NULL,
    user_unread_privmsg integer DEFAULT 0 NOT NULL,
    user_last_privmsg integer DEFAULT 0 NOT NULL,
    user_emailtime integer,
    user_viewemail integer,
    user_attachsig integer,
    user_allowhtml integer DEFAULT 1,
    user_allowbbcode integer DEFAULT 1,
    user_allowsmile integer DEFAULT 1,
    user_allowavatar integer DEFAULT 1 NOT NULL,
    user_allow_pm integer DEFAULT 1 NOT NULL,
    user_allow_viewonline integer DEFAULT 1 NOT NULL,
    user_notify integer DEFAULT 1 NOT NULL,
    user_notify_new_topic integer DEFAULT 0 NOT NULL,
    user_notify_pm integer DEFAULT 0 NOT NULL,
    user_popup_pm integer DEFAULT 0 NOT NULL,
    user_rank integer DEFAULT 0,
    user_avatar character varying(100),
    user_avatar_type integer DEFAULT 0 NOT NULL,
    user_email character varying(255),
    user_icq character varying(15),
    user_website character varying(100),
    user_from character varying(100),
    user_sig text,
    user_sig_bbcode_uid character varying(10),
    user_aim character varying(255),
    user_yim character varying(255),
    user_msnm character varying(255),
    user_occ character varying(100),
    user_interests character varying(255),
    user_actkey character varying(32),
    user_newpasswd character varying(32)
);


ALTER TABLE phpbb_users OWNER TO refuges;

--
-- Name: phpbb_vote_desc_vote_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_vote_desc_vote_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_vote_desc_vote_id_seq OWNER TO refuges;

--
-- Name: phpbb_vote_desc; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_vote_desc (
    vote_id integer DEFAULT nextval('phpbb_vote_desc_vote_id_seq'::regclass) NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    vote_text text NOT NULL,
    vote_start integer DEFAULT 0 NOT NULL,
    vote_length integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_vote_desc OWNER TO refuges;

--
-- Name: phpbb_vote_results; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_vote_results (
    vote_id integer DEFAULT 0 NOT NULL,
    vote_option_id bigint DEFAULT 0 NOT NULL,
    vote_option_text character varying(255) DEFAULT ''::character varying NOT NULL,
    vote_result integer DEFAULT 0 NOT NULL
);


ALTER TABLE phpbb_vote_results OWNER TO refuges;

--
-- Name: phpbb_vote_voters; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_vote_voters (
    vote_id integer DEFAULT 0 NOT NULL,
    vote_user_id integer DEFAULT 0 NOT NULL,
    vote_user_ip character(8) DEFAULT ''::character(1) NOT NULL
);


ALTER TABLE phpbb_vote_voters OWNER TO refuges;

--
-- Name: phpbb_words_word_id_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE phpbb_words_word_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phpbb_words_word_id_seq OWNER TO refuges;

--
-- Name: phpbb_words; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE phpbb_words (
    word_id integer DEFAULT nextval('phpbb_words_word_id_seq'::regclass) NOT NULL,
    word character(100) DEFAULT ''::character(1) NOT NULL,
    replacement character(100) DEFAULT ''::character(1) NOT NULL
);


ALTER TABLE phpbb_words OWNER TO refuges;

--
-- Name: point_type_id_point_type_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE point_type_id_point_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE point_type_id_point_type_seq OWNER TO refuges;

--
-- Name: point_type; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE point_type (
    id_point_type integer DEFAULT nextval('point_type_id_point_type_seq'::regclass) NOT NULL,
    article_demonstratif character varying(20) NOT NULL,
    article_defini character varying(20) NOT NULL,
    article_partitif_point_type character varying(20) NOT NULL,
    nom_type character varying(50) NOT NULL,
    equivalent_site_officiel character varying(255) NOT NULL,
    equivalent_manque_un_mur character varying(255) NOT NULL,
    equivalent_places character varying(50) NOT NULL,
    equivalent_proprio character varying(200) NOT NULL,
    equivalent_conditions_utilisation character varying(255) NOT NULL,
    equivalent_cheminee character varying(255) NOT NULL,
    equivalent_poele character varying(255) NOT NULL,
    equivalent_couvertures character varying(255) NOT NULL,
    equivalent_places_matelas character varying(255) NOT NULL,
    equivalent_latrines character varying(255) NOT NULL,
    equivalent_bois_a_proximite character varying(255) NOT NULL,
    equivalent_eau_a_proximite character varying(255) NOT NULL,
    ech_max integer DEFAULT 50 NOT NULL,
    importance integer DEFAULT 0 NOT NULL,
    pas_afficher integer DEFAULT 0 NOT NULL,
    symbole character varying(50)
);


ALTER TABLE point_type OWNER TO refuges;

--
-- Name: COLUMN point_type.symbole; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN point_type.symbole IS 'Pictos pour GPS Garmin';


--
-- Name: points_id_point_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE points_id_point_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE points_id_point_seq OWNER TO refuges;

--
-- Name: points; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE points (
    id_point integer DEFAULT nextval('points_id_point_seq'::regclass) NOT NULL,
    id_point_gps integer DEFAULT 0 NOT NULL,
    nom character varying(80) NOT NULL,
    id_point_type integer DEFAULT 0 NOT NULL,
    site_officiel character varying(255),
    places bigint DEFAULT 0 NOT NULL,
    remark text,
    proprio text,
    conditions_utilisation character varying(255) DEFAULT 'ouverture'::character varying,
    matelas character varying(255),
    places_matelas integer,
    nom_createur character varying(255),
    date_derniere_modification timestamp without time zone DEFAULT now(),
    id_createur integer DEFAULT 0 NOT NULL,
    modele integer DEFAULT 0 NOT NULL,
    date_creation timestamp without time zone DEFAULT now() NOT NULL,
    manque_un_mur boolean,
    cheminee boolean,
    poele boolean,
    couvertures boolean,
    latrines boolean,
    bois_a_proximite boolean,
    eau_a_proximite boolean,
    censure boolean DEFAULT false,
    topic_id integer DEFAULT 0
);


ALTER TABLE points OWNER TO refuges;

--
-- Name: COLUMN points.conditions_utilisation; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN points.conditions_utilisation IS 'ouverture ou fermeture ou detruit ou clef_a_recuperer';


--
-- Name: COLUMN points.matelas; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN points.matelas IS 'a supprimer . remplace par places_matelas';


--
-- Name: COLUMN points.places_matelas; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN points.places_matelas IS 'NULL-> on sait pas, 0 yen a , N il y a N matelas -1 ya pas';


--
-- Name: COLUMN points.date_creation; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN points.date_creation IS 'remplace date_insertion (bigint)';


--
-- Name: points_gps_id_point_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE points_gps_id_point_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE points_gps_id_point_gps_seq OWNER TO refuges;

--
-- Name: points_gps; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE points_gps (
    id_point_gps integer DEFAULT nextval('points_gps_id_point_gps_seq'::regclass) NOT NULL,
    altitude integer NOT NULL,
    acces text NOT NULL,
    id_type_precision_gps integer NOT NULL,
    geom geometry,
    CONSTRAINT enforce_dims_geom CHECK ((st_ndims(geom) = 2)),
    CONSTRAINT enforce_geotype_geom CHECK (((geometrytype(geom) = 'POINT'::text) OR (geom IS NULL))),
    CONSTRAINT enforce_srid_geom CHECK ((st_srid(geom) = 4326))
);


ALTER TABLE points_gps OWNER TO refuges;

--
-- Name: points_gps_sans_poly_id_point_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE points_gps_sans_poly_id_point_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE points_gps_sans_poly_id_point_gps_seq OWNER TO refuges;

--
-- Name: polygone_type_id_polygone_type_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE polygone_type_id_polygone_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE polygone_type_id_polygone_type_seq OWNER TO refuges;

--
-- Name: polygone_type; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE polygone_type (
    id_polygone_type integer DEFAULT nextval('polygone_type_id_polygone_type_seq'::regclass) NOT NULL,
    art_dem_poly character varying(6) NOT NULL,
    art_def_poly character varying(6) NOT NULL,
    type_polygone character varying(32) NOT NULL,
    ordre_taille integer DEFAULT 0 NOT NULL,
    categorie_polygone_type character varying(255)
);


ALTER TABLE polygone_type OWNER TO refuges;

--
-- Name: COLUMN polygone_type.ordre_taille; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN polygone_type.ordre_taille IS 'importance';


--
-- Name: polygones_id_polygone_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE polygones_id_polygone_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE polygones_id_polygone_seq OWNER TO refuges;

--
-- Name: polygones; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE polygones (
    id_polygone integer DEFAULT nextval('polygones_id_polygone_seq'::regclass) NOT NULL,
    id_polygone_type integer DEFAULT 1 NOT NULL,
    article_partitif character varying(20),
    nom_polygone character varying(255) NOT NULL,
    source character varying(255),
    message_information_polygone text,
    url_exterieure character varying(255),
    geom geometry,
    site_web character varying(255),
    CONSTRAINT enforce_dims_geom CHECK ((st_ndims(geom) = 2)),
    CONSTRAINT enforce_geotype_geom CHECK (((geometrytype(geom) = 'MULTIPOLYGON'::text) OR (geom IS NULL))),
    CONSTRAINT enforce_srid_geom CHECK ((st_srid(geom) = 4326))
);


ALTER TABLE polygones OWNER TO refuges;

--
-- Name: COLUMN polygones.article_partitif; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN polygones.article_partitif IS 'il y avait une merdouille sur le default, ca a fait des 4 partout';


--
-- Name: COLUMN polygones.url_exterieure; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN polygones.url_exterieure IS 'URL plus précise pour tirer des infos utiles pour wri (exemple : pages des restrictions pour les réserves)';


--
-- Name: COLUMN polygones.site_web; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN polygones.site_web IS 'Adresse du site web principal du polygone (si existe)';


--
-- Name: polys_1; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_1 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 1));


ALTER TABLE polys_1 OWNER TO refuges;

--
-- Name: polys_10; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_10 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 10));


ALTER TABLE polys_10 OWNER TO refuges;

--
-- Name: polys_11; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_11 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 11));


ALTER TABLE polys_11 OWNER TO refuges;

--
-- Name: polys_12; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_12 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 12));


ALTER TABLE polys_12 OWNER TO refuges;

--
-- Name: polys_13; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_13 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 13));


ALTER TABLE polys_13 OWNER TO refuges;

--
-- Name: polys_3; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_3 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 3));


ALTER TABLE polys_3 OWNER TO refuges;

--
-- Name: polys_6; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW polys_6 AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE ((polygones.geom IS NOT NULL) AND (polygones.id_polygone_type = 6));


ALTER TABLE polys_6 OWNER TO refuges;

--
-- Name: type_precision_gps_id_type_precision_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE type_precision_gps_id_type_precision_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE type_precision_gps_id_type_precision_gps_seq OWNER TO refuges;

--
-- Name: type_precision_gps; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE type_precision_gps (
    id_type_precision_gps integer DEFAULT nextval('type_precision_gps_id_type_precision_gps_seq'::regclass) NOT NULL,
    nom_precision_gps character varying(255) NOT NULL,
    ordre integer DEFAULT 0 NOT NULL
);


ALTER TABLE type_precision_gps OWNER TO refuges;

--
-- Name: wfs_polys; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW wfs_polys AS
 SELECT polygones.id_polygone,
    polygones.id_polygone_type,
    polygones.nom_polygone,
    polygones.article_partitif,
    polygone_type.art_dem_poly,
    polygone_type.art_def_poly,
    polygone_type.type_polygone,
    polygone_type.ordre_taille AS importance,
    to_char((random() * (1000000)::double precision), 'FM#000000'::text) AS couleur,
    polygones.geom
   FROM (polygones
     JOIN polygone_type USING (id_polygone_type))
  WHERE (polygones.geom IS NOT NULL)
  ORDER BY polygone_type.ordre_taille;


ALTER TABLE wfs_polys OWNER TO refuges;

--
-- Name: commentaires_id_commentaire_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY commentaires
    ADD CONSTRAINT commentaires_id_commentaire_pkey PRIMARY KEY (id_commentaire);


--
-- Name: phpbb_banlist_ban_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_banlist
    ADD CONSTRAINT phpbb_banlist_ban_id_pkey PRIMARY KEY (ban_id);


--
-- Name: phpbb_categories_cat_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_categories
    ADD CONSTRAINT phpbb_categories_cat_id_pkey PRIMARY KEY (cat_id);


--
-- Name: phpbb_config_config_name_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_config
    ADD CONSTRAINT phpbb_config_config_name_pkey PRIMARY KEY (config_name);


--
-- Name: phpbb_confirm_session_id_confirm_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_confirm
    ADD CONSTRAINT phpbb_confirm_session_id_confirm_id_pkey PRIMARY KEY (session_id, confirm_id);


--
-- Name: phpbb_disallow_disallow_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_disallow
    ADD CONSTRAINT phpbb_disallow_disallow_id_pkey PRIMARY KEY (disallow_id);


--
-- Name: phpbb_forum_prune_prune_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_forum_prune
    ADD CONSTRAINT phpbb_forum_prune_prune_id_pkey PRIMARY KEY (prune_id);


--
-- Name: phpbb_forums_forum_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_forums
    ADD CONSTRAINT phpbb_forums_forum_id_pkey PRIMARY KEY (forum_id);


--
-- Name: phpbb_groups_group_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_groups
    ADD CONSTRAINT phpbb_groups_group_id_pkey PRIMARY KEY (group_id);


--
-- Name: phpbb_posts_post_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_posts
    ADD CONSTRAINT phpbb_posts_post_id_pkey PRIMARY KEY (post_id);


--
-- Name: phpbb_posts_text_post_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_posts_text
    ADD CONSTRAINT phpbb_posts_text_post_id_pkey PRIMARY KEY (post_id);


--
-- Name: phpbb_privmsgs_privmsgs_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_privmsgs
    ADD CONSTRAINT phpbb_privmsgs_privmsgs_id_pkey PRIMARY KEY (privmsgs_id);


--
-- Name: phpbb_privmsgs_text_privmsgs_text_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_privmsgs_text
    ADD CONSTRAINT phpbb_privmsgs_text_privmsgs_text_id_pkey PRIMARY KEY (privmsgs_text_id);


--
-- Name: phpbb_ranks_rank_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_ranks
    ADD CONSTRAINT phpbb_ranks_rank_id_pkey PRIMARY KEY (rank_id);


--
-- Name: phpbb_search_rebuild_rebuild_session_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_search_rebuild
    ADD CONSTRAINT phpbb_search_rebuild_rebuild_session_id_pkey PRIMARY KEY (rebuild_session_id);


--
-- Name: phpbb_search_results_search_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_search_results
    ADD CONSTRAINT phpbb_search_results_search_id_pkey PRIMARY KEY (search_id);


--
-- Name: phpbb_search_wordlist_word_text_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_search_wordlist
    ADD CONSTRAINT phpbb_search_wordlist_word_text_pkey PRIMARY KEY (word_text);


--
-- Name: phpbb_sessions_session_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_sessions
    ADD CONSTRAINT phpbb_sessions_session_id_pkey PRIMARY KEY (session_id);


--
-- Name: phpbb_smilies_smilies_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_smilies
    ADD CONSTRAINT phpbb_smilies_smilies_id_pkey PRIMARY KEY (smilies_id);


--
-- Name: phpbb_themes_name_themes_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_themes_name
    ADD CONSTRAINT phpbb_themes_name_themes_id_pkey PRIMARY KEY (themes_id);


--
-- Name: phpbb_themes_themes_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_themes
    ADD CONSTRAINT phpbb_themes_themes_id_pkey PRIMARY KEY (themes_id);


--
-- Name: phpbb_topics_topic_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_topics
    ADD CONSTRAINT phpbb_topics_topic_id_pkey PRIMARY KEY (topic_id);


--
-- Name: phpbb_users_user_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_users
    ADD CONSTRAINT phpbb_users_user_id_pkey PRIMARY KEY (user_id);


--
-- Name: phpbb_vote_desc_vote_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_vote_desc
    ADD CONSTRAINT phpbb_vote_desc_vote_id_pkey PRIMARY KEY (vote_id);


--
-- Name: phpbb_words_word_id_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY phpbb_words
    ADD CONSTRAINT phpbb_words_word_id_pkey PRIMARY KEY (word_id);


--
-- Name: point_type_id_point_type_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY point_type
    ADD CONSTRAINT point_type_id_point_type_pkey PRIMARY KEY (id_point_type);


--
-- Name: points_gps_id_point_gps_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY points_gps
    ADD CONSTRAINT points_gps_id_point_gps_pkey PRIMARY KEY (id_point_gps);


--
-- Name: points_id_point_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY points
    ADD CONSTRAINT points_id_point_pkey PRIMARY KEY (id_point);


--
-- Name: polygone_type_id_polygone_type_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY polygone_type
    ADD CONSTRAINT polygone_type_id_polygone_type_pkey PRIMARY KEY (id_polygone_type);


--
-- Name: polygones_id_polygone_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY polygones
    ADD CONSTRAINT polygones_id_polygone_pkey PRIMARY KEY (id_polygone);


--
-- Name: type_precision_gps_id_type_precision_gps_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY type_precision_gps
    ADD CONSTRAINT type_precision_gps_id_type_precision_gps_pkey PRIMARY KEY (id_type_precision_gps);


--
-- Name: commentaires_auteur; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_auteur ON commentaires USING btree (auteur_commentaire);


--
-- Name: commentaires_date; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_date ON commentaires USING btree (date);


--
-- Name: commentaires_demande_correction; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_demande_correction ON commentaires USING btree (demande_correction);


--
-- Name: commentaires_id_createur; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_id_createur ON commentaires USING btree (id_createur_commentaire);


--
-- Name: commentaires_id_point; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_id_point ON commentaires USING btree (id_point);


--
-- Name: commentaires_photo_existe; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_photo_existe ON commentaires USING btree (photo_existe);


--
-- Name: index_nom_page; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX index_nom_page ON pages_wiki USING btree (nom_page);


--
-- Name: phpbb_auth_access_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_auth_access_forum_id ON phpbb_auth_access USING btree (forum_id);


--
-- Name: phpbb_auth_access_group_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_auth_access_group_id ON phpbb_auth_access USING btree (group_id);


--
-- Name: phpbb_banlist_ban_ip_ban_userid; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_banlist_ban_ip_ban_userid ON phpbb_banlist USING btree (ban_ip, ban_userid);


--
-- Name: phpbb_categories_cat_order; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_categories_cat_order ON phpbb_categories USING btree (cat_order);


--
-- Name: phpbb_forum_prune_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_forum_prune_forum_id ON phpbb_forum_prune USING btree (forum_id);


--
-- Name: phpbb_forums_cat_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_forums_cat_id ON phpbb_forums USING btree (cat_id);


--
-- Name: phpbb_forums_forum_last_post_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_forums_forum_last_post_id ON phpbb_forums USING btree (forum_last_post_id);


--
-- Name: phpbb_forums_forum_order; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_forums_forum_order ON phpbb_forums USING btree (forum_order);


--
-- Name: phpbb_groups_group_single_user; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_groups_group_single_user ON phpbb_groups USING btree (group_single_user);


--
-- Name: phpbb_posts_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_posts_forum_id ON phpbb_posts USING btree (forum_id);


--
-- Name: phpbb_posts_post_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_posts_post_time ON phpbb_posts USING btree (post_time);


--
-- Name: phpbb_posts_poster_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_posts_poster_id ON phpbb_posts USING btree (poster_id);


--
-- Name: phpbb_posts_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_posts_topic_id ON phpbb_posts USING btree (topic_id);


--
-- Name: phpbb_privmsgs_privmsgs_from_userid; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_privmsgs_privmsgs_from_userid ON phpbb_privmsgs USING btree (privmsgs_from_userid);


--
-- Name: phpbb_privmsgs_privmsgs_to_userid; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_privmsgs_privmsgs_to_userid ON phpbb_privmsgs USING btree (privmsgs_to_userid);


--
-- Name: phpbb_search_rebuild_end_post_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_search_rebuild_end_post_id ON phpbb_search_rebuild USING btree (end_post_id);


--
-- Name: phpbb_search_results_session_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_search_results_session_id ON phpbb_search_results USING btree (session_id);


--
-- Name: phpbb_search_wordlist_word_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_search_wordlist_word_id ON phpbb_search_wordlist USING btree (word_id);


--
-- Name: phpbb_search_wordmatch_post_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_search_wordmatch_post_id ON phpbb_search_wordmatch USING btree (post_id);


--
-- Name: phpbb_search_wordmatch_word_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_search_wordmatch_word_id ON phpbb_search_wordmatch USING btree (word_id);


--
-- Name: phpbb_sessions_session_id_session_ip_session_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_sessions_session_id_session_ip_session_user_id ON phpbb_sessions USING btree (session_id, session_ip, session_user_id);


--
-- Name: phpbb_sessions_session_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_sessions_session_user_id ON phpbb_sessions USING btree (session_user_id);


--
-- Name: phpbb_topics_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_forum_id ON phpbb_topics USING btree (forum_id);


--
-- Name: phpbb_topics_topic_id_point; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_topic_id_point ON phpbb_topics USING btree (topic_id_point);


--
-- Name: phpbb_topics_topic_moved_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_topic_moved_id ON phpbb_topics USING btree (topic_moved_id);


--
-- Name: phpbb_topics_topic_status; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_topic_status ON phpbb_topics USING btree (topic_status);


--
-- Name: phpbb_topics_topic_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_topic_type ON phpbb_topics USING btree (topic_type);


--
-- Name: phpbb_topics_watch_notify_status; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_watch_notify_status ON phpbb_topics_watch USING btree (notify_status);


--
-- Name: phpbb_topics_watch_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_watch_topic_id ON phpbb_topics_watch USING btree (topic_id);


--
-- Name: phpbb_topics_watch_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_topics_watch_user_id ON phpbb_topics_watch USING btree (user_id);


--
-- Name: phpbb_user_group_group_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_user_group_group_id ON phpbb_user_group USING btree (group_id);


--
-- Name: phpbb_user_group_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_user_group_user_id ON phpbb_user_group USING btree (user_id);


--
-- Name: phpbb_users_user_notify_new_topic; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_users_user_notify_new_topic ON phpbb_users USING btree (user_notify_new_topic);


--
-- Name: phpbb_users_user_session_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_users_user_session_time ON phpbb_users USING btree (user_session_time);


--
-- Name: phpbb_vote_desc_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_desc_topic_id ON phpbb_vote_desc USING btree (topic_id);


--
-- Name: phpbb_vote_results_vote_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_results_vote_id ON phpbb_vote_results USING btree (vote_id);


--
-- Name: phpbb_vote_results_vote_option_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_results_vote_option_id ON phpbb_vote_results USING btree (vote_option_id);


--
-- Name: phpbb_vote_voters_vote_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_voters_vote_id ON phpbb_vote_voters USING btree (vote_id);


--
-- Name: phpbb_vote_voters_vote_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_voters_vote_user_id ON phpbb_vote_voters USING btree (vote_user_id);


--
-- Name: phpbb_vote_voters_vote_user_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb_vote_voters_vote_user_ip ON phpbb_vote_voters USING btree (vote_user_ip);


--
-- Name: points_ferme; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_ferme ON points USING btree (conditions_utilisation);


--
-- Name: points_gps_altitude; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_gps_altitude ON points_gps USING btree (altitude);


--
-- Name: points_gps_geom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_gps_geom ON points_gps USING gist (geom);


--
-- Name: points_gps_id_type_precision_gps; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_gps_id_type_precision_gps ON points_gps USING btree (id_type_precision_gps);


--
-- Name: points_id_point_gps; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_id_point_gps ON points USING btree (id_point_gps);


--
-- Name: points_id_point_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_id_point_type ON points USING btree (id_point_type);


--
-- Name: points_matelas; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_matelas ON points USING btree (matelas);


--
-- Name: points_modele; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_modele ON points USING btree (modele);


--
-- Name: points_nom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_nom ON points USING btree (nom);


--
-- Name: points_places; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_places ON points USING btree (places);


--
-- Name: points_places_matelas; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_places_matelas ON points USING btree (places_matelas);


--
-- Name: polygone_type_ordre_taille; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygone_type_ordre_taille ON polygone_type USING btree (ordre_taille);


--
-- Name: polygones_geom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_geom ON polygones USING gist (geom);


--
-- Name: polygones_id_polygone_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_id_polygone_type ON polygones USING btree (id_polygone_type);


--
-- Name: polygones_nom_polygone; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_nom_polygone ON polygones USING btree (nom_polygone);


--
-- Name: type_precision_gps_ordre; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX type_precision_gps_ordre ON type_precision_gps USING btree (ordre);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

