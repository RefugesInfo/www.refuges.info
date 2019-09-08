--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;

--
-- Name: varchar_ci; Type: DOMAIN; Schema: public; Owner: refuges
--

CREATE DOMAIN public.varchar_ci AS character varying(255) NOT NULL DEFAULT ''::character varying;


ALTER DOMAIN public.varchar_ci OWNER TO refuges;

--
-- Name: _varchar_ci_equal(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_equal(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) = LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_equal(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: _varchar_ci_greater_equals(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_greater_equals(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) >= LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_greater_equals(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: _varchar_ci_greater_than(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_greater_than(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) > LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_greater_than(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: _varchar_ci_less_equal(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_less_equal(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) <= LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_less_equal(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: _varchar_ci_less_than(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_less_than(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) < LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_less_than(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: _varchar_ci_not_equal(public.varchar_ci, public.varchar_ci); Type: FUNCTION; Schema: public; Owner: refuges
--

CREATE FUNCTION public._varchar_ci_not_equal(public.varchar_ci, public.varchar_ci) RETURNS boolean
    LANGUAGE sql STRICT
    AS $_$SELECT LOWER($1) != LOWER($2)$_$;


ALTER FUNCTION public._varchar_ci_not_equal(public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: <; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.< (
    PROCEDURE = public._varchar_ci_less_than,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.>),
    NEGATOR = OPERATOR(public.>=),
    RESTRICT = scalarltsel,
    JOIN = scalarltjoinsel
);


ALTER OPERATOR public.< (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: <=; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.<= (
    PROCEDURE = public._varchar_ci_less_equal,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.>=),
    NEGATOR = OPERATOR(public.>),
    RESTRICT = scalarltsel,
    JOIN = scalarltjoinsel
);


ALTER OPERATOR public.<= (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: <>; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.<> (
    PROCEDURE = public._varchar_ci_not_equal,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.<>),
    NEGATOR = OPERATOR(public.=),
    RESTRICT = neqsel,
    JOIN = neqjoinsel
);


ALTER OPERATOR public.<> (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: =; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.= (
    PROCEDURE = public._varchar_ci_equal,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.=),
    NEGATOR = OPERATOR(public.<>),
    MERGES,
    HASHES,
    RESTRICT = eqsel,
    JOIN = eqjoinsel
);


ALTER OPERATOR public.= (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: >; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.> (
    PROCEDURE = public._varchar_ci_greater_than,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.<),
    NEGATOR = OPERATOR(public.<=),
    RESTRICT = scalargtsel,
    JOIN = scalargtjoinsel
);


ALTER OPERATOR public.> (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: >=; Type: OPERATOR; Schema: public; Owner: refuges
--

CREATE OPERATOR public.>= (
    PROCEDURE = public._varchar_ci_greater_equals,
    LEFTARG = public.varchar_ci,
    RIGHTARG = public.varchar_ci,
    COMMUTATOR = OPERATOR(public.<=),
    NEGATOR = OPERATOR(public.<),
    RESTRICT = scalargtsel,
    JOIN = scalargtjoinsel
);


ALTER OPERATOR public.>= (public.varchar_ci, public.varchar_ci) OWNER TO refuges;

--
-- Name: commentaires_id_commentaire_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.commentaires_id_commentaire_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commentaires_id_commentaire_seq OWNER TO refuges;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: commentaires; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.commentaires (
    id_commentaire integer DEFAULT nextval('public.commentaires_id_commentaire_seq'::regclass) NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    id_point integer DEFAULT 0 NOT NULL,
    texte text NOT NULL,
    auteur_commentaire character varying(80),
    photo_existe integer DEFAULT 0 NOT NULL,
    date_photo date,
    demande_correction integer DEFAULT 0 NOT NULL,
    id_createur_commentaire integer DEFAULT 0 NOT NULL,
    raison_demande_correction text
);


ALTER TABLE public.commentaires OWNER TO refuges;

--
-- Name: COLUMN commentaires.date; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.commentaires.date IS 'ajout de default now, qu''on ait pas besoin de le gerer';


--
-- Name: lien_polygone_gps_id_lien_polygone_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.lien_polygone_gps_id_lien_polygone_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lien_polygone_gps_id_lien_polygone_gps_seq OWNER TO refuges;

--
-- Name: osm_tags_id_osm_tag_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.osm_tags_id_osm_tag_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.osm_tags_id_osm_tag_seq OWNER TO refuges;

--
-- Name: pages_wiki; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.pages_wiki (
    nom_page character varying(200) NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL,
    contenu text
);


ALTER TABLE public.pages_wiki OWNER TO refuges;

--
-- Name: phpbb3_acl_groups; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_acl_groups (
    group_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    auth_option_id integer DEFAULT 0 NOT NULL,
    auth_role_id integer DEFAULT 0 NOT NULL,
    auth_setting smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_acl_groups_auth_option_id_check CHECK ((auth_option_id >= 0)),
    CONSTRAINT phpbb3_acl_groups_auth_role_id_check CHECK ((auth_role_id >= 0)),
    CONSTRAINT phpbb3_acl_groups_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_acl_groups_group_id_check CHECK ((group_id >= 0))
);


ALTER TABLE public.phpbb3_acl_groups OWNER TO refuges;

--
-- Name: phpbb3_acl_options_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_acl_options_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_acl_options_seq OWNER TO refuges;

--
-- Name: phpbb3_acl_options; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_acl_options (
    auth_option_id integer DEFAULT nextval('public.phpbb3_acl_options_seq'::regclass) NOT NULL,
    auth_option character varying(50) DEFAULT ''::character varying NOT NULL,
    is_global smallint DEFAULT (0)::smallint NOT NULL,
    is_local smallint DEFAULT (0)::smallint NOT NULL,
    founder_only smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_acl_options_auth_option_id_check CHECK ((auth_option_id >= 0)),
    CONSTRAINT phpbb3_acl_options_founder_only_check CHECK ((founder_only >= 0)),
    CONSTRAINT phpbb3_acl_options_is_global_check CHECK ((is_global >= 0)),
    CONSTRAINT phpbb3_acl_options_is_local_check CHECK ((is_local >= 0))
);


ALTER TABLE public.phpbb3_acl_options OWNER TO refuges;

--
-- Name: phpbb3_acl_roles_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_acl_roles_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_acl_roles_seq OWNER TO refuges;

--
-- Name: phpbb3_acl_roles; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_acl_roles (
    role_id integer DEFAULT nextval('public.phpbb3_acl_roles_seq'::regclass) NOT NULL,
    role_name character varying(255) DEFAULT ''::character varying NOT NULL,
    role_description character varying(4000) DEFAULT ''::character varying NOT NULL,
    role_type character varying(10) DEFAULT ''::character varying NOT NULL,
    role_order smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_acl_roles_role_id_check CHECK ((role_id >= 0)),
    CONSTRAINT phpbb3_acl_roles_role_order_check CHECK ((role_order >= 0))
);


ALTER TABLE public.phpbb3_acl_roles OWNER TO refuges;

--
-- Name: phpbb3_acl_roles_data; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_acl_roles_data (
    role_id integer DEFAULT 0 NOT NULL,
    auth_option_id integer DEFAULT 0 NOT NULL,
    auth_setting smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_acl_roles_data_auth_option_id_check CHECK ((auth_option_id >= 0)),
    CONSTRAINT phpbb3_acl_roles_data_role_id_check CHECK ((role_id >= 0))
);


ALTER TABLE public.phpbb3_acl_roles_data OWNER TO refuges;

--
-- Name: phpbb3_acl_users; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_acl_users (
    user_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    auth_option_id integer DEFAULT 0 NOT NULL,
    auth_role_id integer DEFAULT 0 NOT NULL,
    auth_setting smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_acl_users_auth_option_id_check CHECK ((auth_option_id >= 0)),
    CONSTRAINT phpbb3_acl_users_auth_role_id_check CHECK ((auth_role_id >= 0)),
    CONSTRAINT phpbb3_acl_users_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_acl_users_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_acl_users OWNER TO refuges;

--
-- Name: phpbb3_attachments_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_attachments_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_attachments_seq OWNER TO refuges;

--
-- Name: phpbb3_attachments; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_attachments (
    attach_id integer DEFAULT nextval('public.phpbb3_attachments_seq'::regclass) NOT NULL,
    post_msg_id integer DEFAULT 0 NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    in_message smallint DEFAULT (0)::smallint NOT NULL,
    poster_id integer DEFAULT 0 NOT NULL,
    is_orphan smallint DEFAULT (1)::smallint NOT NULL,
    physical_filename character varying(255) DEFAULT ''::character varying NOT NULL,
    real_filename character varying(255) DEFAULT ''::character varying NOT NULL,
    download_count integer DEFAULT 0 NOT NULL,
    attach_comment character varying(4000) DEFAULT ''::character varying NOT NULL,
    extension character varying(100) DEFAULT ''::character varying NOT NULL,
    mimetype character varying(100) DEFAULT ''::character varying NOT NULL,
    filesize integer DEFAULT 0 NOT NULL,
    filetime integer DEFAULT 0 NOT NULL,
    thumbnail smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_attachments_attach_id_check CHECK ((attach_id >= 0)),
    CONSTRAINT phpbb3_attachments_download_count_check CHECK ((download_count >= 0)),
    CONSTRAINT phpbb3_attachments_filesize_check CHECK ((filesize >= 0)),
    CONSTRAINT phpbb3_attachments_filetime_check CHECK ((filetime >= 0)),
    CONSTRAINT phpbb3_attachments_in_message_check CHECK ((in_message >= 0)),
    CONSTRAINT phpbb3_attachments_is_orphan_check CHECK ((is_orphan >= 0)),
    CONSTRAINT phpbb3_attachments_post_msg_id_check CHECK ((post_msg_id >= 0)),
    CONSTRAINT phpbb3_attachments_poster_id_check CHECK ((poster_id >= 0)),
    CONSTRAINT phpbb3_attachments_thumbnail_check CHECK ((thumbnail >= 0)),
    CONSTRAINT phpbb3_attachments_topic_id_check CHECK ((topic_id >= 0))
);


ALTER TABLE public.phpbb3_attachments OWNER TO refuges;

--
-- Name: phpbb3_banlist_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_banlist_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_banlist_seq OWNER TO refuges;

--
-- Name: phpbb3_banlist; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_banlist (
    ban_id integer DEFAULT nextval('public.phpbb3_banlist_seq'::regclass) NOT NULL,
    ban_userid integer DEFAULT 0 NOT NULL,
    ban_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    ban_email character varying(100) DEFAULT ''::character varying NOT NULL,
    ban_start integer DEFAULT 0 NOT NULL,
    ban_end integer DEFAULT 0 NOT NULL,
    ban_exclude smallint DEFAULT (0)::smallint NOT NULL,
    ban_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    ban_give_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_banlist_ban_end_check CHECK ((ban_end >= 0)),
    CONSTRAINT phpbb3_banlist_ban_exclude_check CHECK ((ban_exclude >= 0)),
    CONSTRAINT phpbb3_banlist_ban_id_check CHECK ((ban_id >= 0)),
    CONSTRAINT phpbb3_banlist_ban_start_check CHECK ((ban_start >= 0)),
    CONSTRAINT phpbb3_banlist_ban_userid_check CHECK ((ban_userid >= 0))
);


ALTER TABLE public.phpbb3_banlist OWNER TO refuges;

--
-- Name: phpbb3_bbcodes; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_bbcodes (
    bbcode_id smallint DEFAULT (0)::smallint NOT NULL,
    bbcode_tag character varying(16) DEFAULT ''::character varying NOT NULL,
    bbcode_helpline character varying(255) DEFAULT ''::character varying NOT NULL,
    display_on_posting smallint DEFAULT (0)::smallint NOT NULL,
    bbcode_match character varying(4000) DEFAULT ''::character varying NOT NULL,
    bbcode_tpl text DEFAULT ''::text NOT NULL,
    first_pass_match text DEFAULT ''::text NOT NULL,
    first_pass_replace text DEFAULT ''::text NOT NULL,
    second_pass_match text DEFAULT ''::text NOT NULL,
    second_pass_replace text DEFAULT ''::text NOT NULL,
    CONSTRAINT phpbb3_bbcodes_bbcode_id_check CHECK ((bbcode_id >= 0)),
    CONSTRAINT phpbb3_bbcodes_display_on_posting_check CHECK ((display_on_posting >= 0))
);


ALTER TABLE public.phpbb3_bbcodes OWNER TO refuges;

--
-- Name: phpbb3_bookmarks; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_bookmarks (
    topic_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_bookmarks_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_bookmarks_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_bookmarks OWNER TO refuges;

--
-- Name: phpbb3_bots_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_bots_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_bots_seq OWNER TO refuges;

--
-- Name: phpbb3_bots; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_bots (
    bot_id integer DEFAULT nextval('public.phpbb3_bots_seq'::regclass) NOT NULL,
    bot_active smallint DEFAULT (1)::smallint NOT NULL,
    bot_name character varying(255) DEFAULT ''::character varying NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    bot_agent character varying(255) DEFAULT ''::character varying NOT NULL,
    bot_ip character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_bots_bot_active_check CHECK ((bot_active >= 0)),
    CONSTRAINT phpbb3_bots_bot_id_check CHECK ((bot_id >= 0)),
    CONSTRAINT phpbb3_bots_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_bots OWNER TO refuges;

--
-- Name: phpbb3_captcha_answers; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_captcha_answers (
    question_id integer DEFAULT 0 NOT NULL,
    answer_text character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_captcha_answers_question_id_check CHECK ((question_id >= 0))
);


ALTER TABLE public.phpbb3_captcha_answers OWNER TO refuges;

--
-- Name: phpbb3_captcha_questions_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_captcha_questions_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_captcha_questions_seq OWNER TO refuges;

--
-- Name: phpbb3_captcha_questions; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_captcha_questions (
    question_id integer DEFAULT nextval('public.phpbb3_captcha_questions_seq'::regclass) NOT NULL,
    strict smallint DEFAULT (0)::smallint NOT NULL,
    lang_id integer DEFAULT 0 NOT NULL,
    lang_iso character varying(30) DEFAULT ''::character varying NOT NULL,
    question_text character varying(4000) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_captcha_questions_lang_id_check CHECK ((lang_id >= 0)),
    CONSTRAINT phpbb3_captcha_questions_question_id_check CHECK ((question_id >= 0)),
    CONSTRAINT phpbb3_captcha_questions_strict_check CHECK ((strict >= 0))
);


ALTER TABLE public.phpbb3_captcha_questions OWNER TO refuges;

--
-- Name: phpbb3_cleantalk_sfw; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_cleantalk_sfw (
    network integer DEFAULT 0 NOT NULL,
    mask integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_cleantalk_sfw_mask_check CHECK ((mask >= 0)),
    CONSTRAINT phpbb3_cleantalk_sfw_network_check CHECK ((network >= 0))
);


ALTER TABLE public.phpbb3_cleantalk_sfw OWNER TO refuges;

--
-- Name: phpbb3_cleantalk_sfw_logs; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_cleantalk_sfw_logs (
    ip character varying(15) DEFAULT ''::character varying NOT NULL,
    all_entries integer DEFAULT 0,
    blocked_entries integer DEFAULT 0,
    entries_timestamp integer DEFAULT 0
);


ALTER TABLE public.phpbb3_cleantalk_sfw_logs OWNER TO refuges;

--
-- Name: phpbb3_config; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_config (
    config_name character varying(255) DEFAULT ''::character varying NOT NULL,
    config_value character varying(255) DEFAULT ''::character varying NOT NULL,
    is_dynamic smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_config_is_dynamic_check CHECK ((is_dynamic >= 0))
);


ALTER TABLE public.phpbb3_config OWNER TO refuges;

--
-- Name: phpbb3_config_text; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_config_text (
    config_name character varying(255) DEFAULT ''::character varying NOT NULL,
    config_value text DEFAULT ''::text NOT NULL
);


ALTER TABLE public.phpbb3_config_text OWNER TO refuges;

--
-- Name: phpbb3_confirm; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_confirm (
    confirm_id character(32) DEFAULT ''::bpchar NOT NULL,
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    confirm_type smallint DEFAULT (0)::smallint NOT NULL,
    code character varying(8) DEFAULT ''::character varying NOT NULL,
    seed integer DEFAULT 0 NOT NULL,
    attempts integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_confirm_attempts_check CHECK ((attempts >= 0)),
    CONSTRAINT phpbb3_confirm_seed_check CHECK ((seed >= 0))
);


ALTER TABLE public.phpbb3_confirm OWNER TO refuges;

--
-- Name: phpbb3_disallow_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_disallow_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_disallow_seq OWNER TO refuges;

--
-- Name: phpbb3_disallow; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_disallow (
    disallow_id integer DEFAULT nextval('public.phpbb3_disallow_seq'::regclass) NOT NULL,
    disallow_username character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_disallow_disallow_id_check CHECK ((disallow_id >= 0))
);


ALTER TABLE public.phpbb3_disallow OWNER TO refuges;

--
-- Name: phpbb3_drafts_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_drafts_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_drafts_seq OWNER TO refuges;

--
-- Name: phpbb3_drafts; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_drafts (
    draft_id integer DEFAULT nextval('public.phpbb3_drafts_seq'::regclass) NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    save_time integer DEFAULT 0 NOT NULL,
    draft_subject character varying(255) DEFAULT ''::character varying NOT NULL,
    draft_message text DEFAULT ''::text NOT NULL,
    CONSTRAINT phpbb3_drafts_draft_id_check CHECK ((draft_id >= 0)),
    CONSTRAINT phpbb3_drafts_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_drafts_save_time_check CHECK ((save_time >= 0)),
    CONSTRAINT phpbb3_drafts_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_drafts_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_drafts OWNER TO refuges;

--
-- Name: phpbb3_ext; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_ext (
    ext_name character varying(255) DEFAULT ''::character varying NOT NULL,
    ext_active smallint DEFAULT (0)::smallint NOT NULL,
    ext_state character varying(8000) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_ext_ext_active_check CHECK ((ext_active >= 0))
);


ALTER TABLE public.phpbb3_ext OWNER TO refuges;

--
-- Name: phpbb3_extension_groups_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_extension_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_extension_groups_seq OWNER TO refuges;

--
-- Name: phpbb3_extension_groups; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_extension_groups (
    group_id integer DEFAULT nextval('public.phpbb3_extension_groups_seq'::regclass) NOT NULL,
    group_name character varying(255) DEFAULT ''::character varying NOT NULL,
    cat_id smallint DEFAULT (0)::smallint NOT NULL,
    allow_group smallint DEFAULT (0)::smallint NOT NULL,
    download_mode smallint DEFAULT (1)::smallint NOT NULL,
    upload_icon character varying(255) DEFAULT ''::character varying NOT NULL,
    max_filesize integer DEFAULT 0 NOT NULL,
    allowed_forums character varying(8000) DEFAULT ''::character varying NOT NULL,
    allow_in_pm smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_extension_groups_allow_group_check CHECK ((allow_group >= 0)),
    CONSTRAINT phpbb3_extension_groups_allow_in_pm_check CHECK ((allow_in_pm >= 0)),
    CONSTRAINT phpbb3_extension_groups_download_mode_check CHECK ((download_mode >= 0)),
    CONSTRAINT phpbb3_extension_groups_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_extension_groups_max_filesize_check CHECK ((max_filesize >= 0))
);


ALTER TABLE public.phpbb3_extension_groups OWNER TO refuges;

--
-- Name: phpbb3_extensions_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_extensions_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_extensions_seq OWNER TO refuges;

--
-- Name: phpbb3_extensions; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_extensions (
    extension_id integer DEFAULT nextval('public.phpbb3_extensions_seq'::regclass) NOT NULL,
    group_id integer DEFAULT 0 NOT NULL,
    extension character varying(100) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_extensions_extension_id_check CHECK ((extension_id >= 0)),
    CONSTRAINT phpbb3_extensions_group_id_check CHECK ((group_id >= 0))
);


ALTER TABLE public.phpbb3_extensions OWNER TO refuges;

--
-- Name: phpbb3_forums_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_forums_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_forums_seq OWNER TO refuges;

--
-- Name: phpbb3_forums; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_forums (
    forum_id integer DEFAULT nextval('public.phpbb3_forums_seq'::regclass) NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL,
    left_id integer DEFAULT 0 NOT NULL,
    right_id integer DEFAULT 0 NOT NULL,
    forum_parents text DEFAULT ''::text NOT NULL,
    forum_name character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_desc character varying(4000) DEFAULT ''::character varying NOT NULL,
    forum_desc_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_desc_options integer DEFAULT 7 NOT NULL,
    forum_desc_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    forum_link character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_password character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_style integer DEFAULT 0 NOT NULL,
    forum_image character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_rules character varying(4000) DEFAULT ''::character varying NOT NULL,
    forum_rules_link character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_rules_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_rules_options integer DEFAULT 7 NOT NULL,
    forum_rules_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    forum_topics_per_page smallint DEFAULT (0)::smallint NOT NULL,
    forum_type smallint DEFAULT (0)::smallint NOT NULL,
    forum_status smallint DEFAULT (0)::smallint NOT NULL,
    forum_last_post_id integer DEFAULT 0 NOT NULL,
    forum_last_poster_id integer DEFAULT 0 NOT NULL,
    forum_last_post_subject character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_last_post_time integer DEFAULT 0 NOT NULL,
    forum_last_poster_name character varying(255) DEFAULT ''::character varying NOT NULL,
    forum_last_poster_colour character varying(6) DEFAULT ''::character varying NOT NULL,
    forum_flags smallint DEFAULT (32)::smallint NOT NULL,
    display_on_index smallint DEFAULT (1)::smallint NOT NULL,
    enable_indexing smallint DEFAULT (1)::smallint NOT NULL,
    enable_icons smallint DEFAULT (1)::smallint NOT NULL,
    enable_prune smallint DEFAULT (0)::smallint NOT NULL,
    prune_next integer DEFAULT 0 NOT NULL,
    prune_days integer DEFAULT 0 NOT NULL,
    prune_viewed integer DEFAULT 0 NOT NULL,
    prune_freq integer DEFAULT 0 NOT NULL,
    display_subforum_list smallint DEFAULT (1)::smallint NOT NULL,
    forum_options integer DEFAULT 0 NOT NULL,
    forum_posts_approved integer DEFAULT 0 NOT NULL,
    forum_posts_unapproved integer DEFAULT 0 NOT NULL,
    forum_posts_softdeleted integer DEFAULT 0 NOT NULL,
    forum_topics_approved integer DEFAULT 0 NOT NULL,
    forum_topics_unapproved integer DEFAULT 0 NOT NULL,
    forum_topics_softdeleted integer DEFAULT 0 NOT NULL,
    enable_shadow_prune smallint DEFAULT (0)::smallint NOT NULL,
    prune_shadow_days integer DEFAULT 7 NOT NULL,
    prune_shadow_freq integer DEFAULT 1 NOT NULL,
    prune_shadow_next integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_forums_display_on_index_check CHECK ((display_on_index >= 0)),
    CONSTRAINT phpbb3_forums_display_subforum_list_check CHECK ((display_subforum_list >= 0)),
    CONSTRAINT phpbb3_forums_enable_icons_check CHECK ((enable_icons >= 0)),
    CONSTRAINT phpbb3_forums_enable_indexing_check CHECK ((enable_indexing >= 0)),
    CONSTRAINT phpbb3_forums_enable_prune_check CHECK ((enable_prune >= 0)),
    CONSTRAINT phpbb3_forums_enable_shadow_prune_check CHECK ((enable_shadow_prune >= 0)),
    CONSTRAINT phpbb3_forums_forum_desc_options_check CHECK ((forum_desc_options >= 0)),
    CONSTRAINT phpbb3_forums_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_forums_forum_last_post_id_check CHECK ((forum_last_post_id >= 0)),
    CONSTRAINT phpbb3_forums_forum_last_post_time_check CHECK ((forum_last_post_time >= 0)),
    CONSTRAINT phpbb3_forums_forum_last_poster_id_check CHECK ((forum_last_poster_id >= 0)),
    CONSTRAINT phpbb3_forums_forum_options_check CHECK ((forum_options >= 0)),
    CONSTRAINT phpbb3_forums_forum_posts_approved_check CHECK ((forum_posts_approved >= 0)),
    CONSTRAINT phpbb3_forums_forum_posts_softdeleted_check CHECK ((forum_posts_softdeleted >= 0)),
    CONSTRAINT phpbb3_forums_forum_posts_unapproved_check CHECK ((forum_posts_unapproved >= 0)),
    CONSTRAINT phpbb3_forums_forum_rules_options_check CHECK ((forum_rules_options >= 0)),
    CONSTRAINT phpbb3_forums_forum_style_check CHECK ((forum_style >= 0)),
    CONSTRAINT phpbb3_forums_forum_topics_approved_check CHECK ((forum_topics_approved >= 0)),
    CONSTRAINT phpbb3_forums_forum_topics_softdeleted_check CHECK ((forum_topics_softdeleted >= 0)),
    CONSTRAINT phpbb3_forums_forum_topics_unapproved_check CHECK ((forum_topics_unapproved >= 0)),
    CONSTRAINT phpbb3_forums_left_id_check CHECK ((left_id >= 0)),
    CONSTRAINT phpbb3_forums_parent_id_check CHECK ((parent_id >= 0)),
    CONSTRAINT phpbb3_forums_prune_days_check CHECK ((prune_days >= 0)),
    CONSTRAINT phpbb3_forums_prune_freq_check CHECK ((prune_freq >= 0)),
    CONSTRAINT phpbb3_forums_prune_next_check CHECK ((prune_next >= 0)),
    CONSTRAINT phpbb3_forums_prune_shadow_days_check CHECK ((prune_shadow_days >= 0)),
    CONSTRAINT phpbb3_forums_prune_shadow_freq_check CHECK ((prune_shadow_freq >= 0)),
    CONSTRAINT phpbb3_forums_prune_viewed_check CHECK ((prune_viewed >= 0)),
    CONSTRAINT phpbb3_forums_right_id_check CHECK ((right_id >= 0))
);


ALTER TABLE public.phpbb3_forums OWNER TO refuges;

--
-- Name: phpbb3_forums_access; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_forums_access (
    forum_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    CONSTRAINT phpbb3_forums_access_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_forums_access_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_forums_access OWNER TO refuges;

--
-- Name: phpbb3_forums_track; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_forums_track (
    user_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    mark_time integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_forums_track_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_forums_track_mark_time_check CHECK ((mark_time >= 0)),
    CONSTRAINT phpbb3_forums_track_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_forums_track OWNER TO refuges;

--
-- Name: phpbb3_forums_watch; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_forums_watch (
    forum_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    notify_status smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_forums_watch_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_forums_watch_notify_status_check CHECK ((notify_status >= 0)),
    CONSTRAINT phpbb3_forums_watch_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_forums_watch OWNER TO refuges;

--
-- Name: phpbb3_groups_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_groups_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_groups_seq OWNER TO refuges;

--
-- Name: phpbb3_groups; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_groups (
    group_id integer DEFAULT nextval('public.phpbb3_groups_seq'::regclass) NOT NULL,
    group_type smallint DEFAULT (1)::smallint NOT NULL,
    group_founder_manage smallint DEFAULT (0)::smallint NOT NULL,
    group_skip_auth smallint DEFAULT (0)::smallint NOT NULL,
    group_name public.varchar_ci DEFAULT ''::character varying NOT NULL,
    group_desc character varying(4000) DEFAULT ''::character varying NOT NULL,
    group_desc_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    group_desc_options integer DEFAULT 7 NOT NULL,
    group_desc_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    group_display smallint DEFAULT (0)::smallint NOT NULL,
    group_avatar character varying(255) DEFAULT ''::character varying NOT NULL,
    group_avatar_type character varying(255) DEFAULT ''::character varying NOT NULL,
    group_avatar_width smallint DEFAULT (0)::smallint NOT NULL,
    group_avatar_height smallint DEFAULT (0)::smallint NOT NULL,
    group_rank integer DEFAULT 0 NOT NULL,
    group_colour character varying(6) DEFAULT ''::character varying NOT NULL,
    group_sig_chars integer DEFAULT 0 NOT NULL,
    group_receive_pm smallint DEFAULT (0)::smallint NOT NULL,
    group_message_limit integer DEFAULT 0 NOT NULL,
    group_legend integer DEFAULT 0 NOT NULL,
    group_max_recipients integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_groups_group_avatar_height_check CHECK ((group_avatar_height >= 0)),
    CONSTRAINT phpbb3_groups_group_avatar_width_check CHECK ((group_avatar_width >= 0)),
    CONSTRAINT phpbb3_groups_group_desc_options_check CHECK ((group_desc_options >= 0)),
    CONSTRAINT phpbb3_groups_group_display_check CHECK ((group_display >= 0)),
    CONSTRAINT phpbb3_groups_group_founder_manage_check CHECK ((group_founder_manage >= 0)),
    CONSTRAINT phpbb3_groups_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_groups_group_legend_check CHECK ((group_legend >= 0)),
    CONSTRAINT phpbb3_groups_group_max_recipients_check CHECK ((group_max_recipients >= 0)),
    CONSTRAINT phpbb3_groups_group_message_limit_check CHECK ((group_message_limit >= 0)),
    CONSTRAINT phpbb3_groups_group_rank_check CHECK ((group_rank >= 0)),
    CONSTRAINT phpbb3_groups_group_receive_pm_check CHECK ((group_receive_pm >= 0)),
    CONSTRAINT phpbb3_groups_group_sig_chars_check CHECK ((group_sig_chars >= 0)),
    CONSTRAINT phpbb3_groups_group_skip_auth_check CHECK ((group_skip_auth >= 0))
);


ALTER TABLE public.phpbb3_groups OWNER TO refuges;

--
-- Name: phpbb3_icons_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_icons_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_icons_seq OWNER TO refuges;

--
-- Name: phpbb3_icons; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_icons (
    icons_id integer DEFAULT nextval('public.phpbb3_icons_seq'::regclass) NOT NULL,
    icons_url character varying(255) DEFAULT ''::character varying NOT NULL,
    icons_width smallint DEFAULT (0)::smallint NOT NULL,
    icons_height smallint DEFAULT (0)::smallint NOT NULL,
    icons_alt character varying(255) DEFAULT ''::character varying NOT NULL,
    icons_order integer DEFAULT 0 NOT NULL,
    display_on_posting smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_icons_display_on_posting_check CHECK ((display_on_posting >= 0)),
    CONSTRAINT phpbb3_icons_icons_id_check CHECK ((icons_id >= 0)),
    CONSTRAINT phpbb3_icons_icons_order_check CHECK ((icons_order >= 0))
);


ALTER TABLE public.phpbb3_icons OWNER TO refuges;

--
-- Name: phpbb3_lang_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_lang_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_lang_seq OWNER TO refuges;

--
-- Name: phpbb3_lang; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_lang (
    lang_id smallint DEFAULT nextval('public.phpbb3_lang_seq'::regclass) NOT NULL,
    lang_iso character varying(30) DEFAULT ''::character varying NOT NULL,
    lang_dir character varying(30) DEFAULT ''::character varying NOT NULL,
    lang_english_name character varying(100) DEFAULT ''::character varying NOT NULL,
    lang_local_name character varying(255) DEFAULT ''::character varying NOT NULL,
    lang_author character varying(255) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE public.phpbb3_lang OWNER TO refuges;

--
-- Name: phpbb3_log_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_log_seq OWNER TO refuges;

--
-- Name: phpbb3_log; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_log (
    log_id integer DEFAULT nextval('public.phpbb3_log_seq'::regclass) NOT NULL,
    log_type smallint DEFAULT (0)::smallint NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    post_id integer DEFAULT 0 NOT NULL,
    reportee_id integer DEFAULT 0 NOT NULL,
    log_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    log_time integer DEFAULT 0 NOT NULL,
    log_operation character varying(4000) DEFAULT ''::character varying NOT NULL,
    log_data text DEFAULT ''::text NOT NULL,
    CONSTRAINT phpbb3_log_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_log_log_id_check CHECK ((log_id >= 0)),
    CONSTRAINT phpbb3_log_log_time_check CHECK ((log_time >= 0)),
    CONSTRAINT phpbb3_log_post_id_check CHECK ((post_id >= 0)),
    CONSTRAINT phpbb3_log_reportee_id_check CHECK ((reportee_id >= 0)),
    CONSTRAINT phpbb3_log_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_log_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_log OWNER TO refuges;

--
-- Name: phpbb3_login_attempts; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_login_attempts (
    attempt_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    attempt_browser character varying(150) DEFAULT ''::character varying NOT NULL,
    attempt_forwarded_for character varying(255) DEFAULT ''::character varying NOT NULL,
    attempt_time integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    username character varying(255) DEFAULT '0'::character varying NOT NULL,
    username_clean public.varchar_ci DEFAULT '0'::character varying NOT NULL,
    CONSTRAINT phpbb3_login_attempts_attempt_time_check CHECK ((attempt_time >= 0)),
    CONSTRAINT phpbb3_login_attempts_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_login_attempts OWNER TO refuges;

--
-- Name: phpbb3_migrations; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_migrations (
    migration_name character varying(255) DEFAULT ''::character varying NOT NULL,
    migration_depends_on character varying(8000) DEFAULT ''::character varying NOT NULL,
    migration_schema_done smallint DEFAULT (0)::smallint NOT NULL,
    migration_data_done smallint DEFAULT (0)::smallint NOT NULL,
    migration_data_state character varying(8000) DEFAULT ''::character varying NOT NULL,
    migration_start_time integer DEFAULT 0 NOT NULL,
    migration_end_time integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_migrations_migration_data_done_check CHECK ((migration_data_done >= 0)),
    CONSTRAINT phpbb3_migrations_migration_end_time_check CHECK ((migration_end_time >= 0)),
    CONSTRAINT phpbb3_migrations_migration_schema_done_check CHECK ((migration_schema_done >= 0)),
    CONSTRAINT phpbb3_migrations_migration_start_time_check CHECK ((migration_start_time >= 0))
);


ALTER TABLE public.phpbb3_migrations OWNER TO refuges;

--
-- Name: phpbb3_moderator_cache; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_moderator_cache (
    forum_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    username character varying(255) DEFAULT ''::character varying NOT NULL,
    group_id integer DEFAULT 0 NOT NULL,
    group_name character varying(255) DEFAULT ''::character varying NOT NULL,
    display_on_index smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_moderator_cache_display_on_index_check CHECK ((display_on_index >= 0)),
    CONSTRAINT phpbb3_moderator_cache_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_moderator_cache_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_moderator_cache_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_moderator_cache OWNER TO refuges;

--
-- Name: phpbb3_modules_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_modules_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_modules_seq OWNER TO refuges;

--
-- Name: phpbb3_modules; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_modules (
    module_id integer DEFAULT nextval('public.phpbb3_modules_seq'::regclass) NOT NULL,
    module_enabled smallint DEFAULT (1)::smallint NOT NULL,
    module_display smallint DEFAULT (1)::smallint NOT NULL,
    module_basename character varying(255) DEFAULT ''::character varying NOT NULL,
    module_class character varying(10) DEFAULT ''::character varying NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL,
    left_id integer DEFAULT 0 NOT NULL,
    right_id integer DEFAULT 0 NOT NULL,
    module_langname character varying(255) DEFAULT ''::character varying NOT NULL,
    module_mode character varying(255) DEFAULT ''::character varying NOT NULL,
    module_auth character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_modules_left_id_check CHECK ((left_id >= 0)),
    CONSTRAINT phpbb3_modules_module_display_check CHECK ((module_display >= 0)),
    CONSTRAINT phpbb3_modules_module_enabled_check CHECK ((module_enabled >= 0)),
    CONSTRAINT phpbb3_modules_module_id_check CHECK ((module_id >= 0)),
    CONSTRAINT phpbb3_modules_parent_id_check CHECK ((parent_id >= 0)),
    CONSTRAINT phpbb3_modules_right_id_check CHECK ((right_id >= 0))
);


ALTER TABLE public.phpbb3_modules OWNER TO refuges;

--
-- Name: phpbb3_notification_types_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_notification_types_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_notification_types_seq OWNER TO refuges;

--
-- Name: phpbb3_notification_types; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_notification_types (
    notification_type_id smallint DEFAULT nextval('public.phpbb3_notification_types_seq'::regclass) NOT NULL,
    notification_type_name character varying(255) DEFAULT ''::character varying NOT NULL,
    notification_type_enabled smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_notification_types_notification_type_enabled_check CHECK ((notification_type_enabled >= 0)),
    CONSTRAINT phpbb3_notification_types_notification_type_id_check CHECK ((notification_type_id >= 0))
);


ALTER TABLE public.phpbb3_notification_types OWNER TO refuges;

--
-- Name: phpbb3_notifications_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_notifications_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_notifications_seq OWNER TO refuges;

--
-- Name: phpbb3_notifications; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_notifications (
    notification_id integer DEFAULT nextval('public.phpbb3_notifications_seq'::regclass) NOT NULL,
    notification_type_id smallint DEFAULT (0)::smallint NOT NULL,
    item_id integer DEFAULT 0 NOT NULL,
    item_parent_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    notification_read smallint DEFAULT (0)::smallint NOT NULL,
    notification_time integer DEFAULT 1 NOT NULL,
    notification_data character varying(4000) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_notifications_item_id_check CHECK ((item_id >= 0)),
    CONSTRAINT phpbb3_notifications_item_parent_id_check CHECK ((item_parent_id >= 0)),
    CONSTRAINT phpbb3_notifications_notification_id_check CHECK ((notification_id >= 0)),
    CONSTRAINT phpbb3_notifications_notification_read_check CHECK ((notification_read >= 0)),
    CONSTRAINT phpbb3_notifications_notification_time_check CHECK ((notification_time >= 0)),
    CONSTRAINT phpbb3_notifications_notification_type_id_check CHECK ((notification_type_id >= 0)),
    CONSTRAINT phpbb3_notifications_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_notifications OWNER TO refuges;

--
-- Name: phpbb3_oauth_accounts; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_oauth_accounts (
    user_id integer DEFAULT 0 NOT NULL,
    provider character varying(255) DEFAULT ''::character varying NOT NULL,
    oauth_provider_id character varying(4000) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_oauth_accounts_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_oauth_accounts OWNER TO refuges;

--
-- Name: phpbb3_oauth_states; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_oauth_states (
    user_id integer DEFAULT 0 NOT NULL,
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    provider character varying(255) DEFAULT ''::character varying NOT NULL,
    oauth_state character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_oauth_states_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_oauth_states OWNER TO refuges;

--
-- Name: phpbb3_oauth_tokens; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_oauth_tokens (
    user_id integer DEFAULT 0 NOT NULL,
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    provider character varying(255) DEFAULT ''::character varying NOT NULL,
    oauth_token text DEFAULT ''::text NOT NULL,
    CONSTRAINT phpbb3_oauth_tokens_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_oauth_tokens OWNER TO refuges;

--
-- Name: phpbb3_poll_options; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_poll_options (
    poll_option_id smallint DEFAULT (0)::smallint NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    poll_option_text character varying(4000) DEFAULT ''::character varying NOT NULL,
    poll_option_total integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_poll_options_poll_option_total_check CHECK ((poll_option_total >= 0)),
    CONSTRAINT phpbb3_poll_options_topic_id_check CHECK ((topic_id >= 0))
);


ALTER TABLE public.phpbb3_poll_options OWNER TO refuges;

--
-- Name: phpbb3_poll_votes; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_poll_votes (
    topic_id integer DEFAULT 0 NOT NULL,
    poll_option_id smallint DEFAULT (0)::smallint NOT NULL,
    vote_user_id integer DEFAULT 0 NOT NULL,
    vote_user_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_poll_votes_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_poll_votes_vote_user_id_check CHECK ((vote_user_id >= 0))
);


ALTER TABLE public.phpbb3_poll_votes OWNER TO refuges;

--
-- Name: phpbb3_posts_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_posts_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_posts_seq OWNER TO refuges;

--
-- Name: phpbb3_posts; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_posts (
    post_id integer DEFAULT nextval('public.phpbb3_posts_seq'::regclass) NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    poster_id integer DEFAULT 0 NOT NULL,
    icon_id integer DEFAULT 0 NOT NULL,
    poster_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    post_time integer DEFAULT 0 NOT NULL,
    post_reported smallint DEFAULT (0)::smallint NOT NULL,
    enable_bbcode smallint DEFAULT (1)::smallint NOT NULL,
    enable_smilies smallint DEFAULT (1)::smallint NOT NULL,
    enable_magic_url smallint DEFAULT (1)::smallint NOT NULL,
    enable_sig smallint DEFAULT (1)::smallint NOT NULL,
    post_username character varying(255) DEFAULT ''::character varying NOT NULL,
    post_subject character varying(255) DEFAULT ''::character varying NOT NULL,
    post_text text DEFAULT ''::text NOT NULL,
    post_checksum character varying(32) DEFAULT ''::character varying NOT NULL,
    post_attachment smallint DEFAULT (0)::smallint NOT NULL,
    bbcode_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    bbcode_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    post_postcount smallint DEFAULT (1)::smallint NOT NULL,
    post_edit_time integer DEFAULT 0 NOT NULL,
    post_edit_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    post_edit_user integer DEFAULT 0 NOT NULL,
    post_edit_count smallint DEFAULT (0)::smallint NOT NULL,
    post_edit_locked smallint DEFAULT (0)::smallint NOT NULL,
    post_visibility smallint DEFAULT (0)::smallint NOT NULL,
    post_delete_time integer DEFAULT 0 NOT NULL,
    post_delete_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    post_delete_user integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_posts_enable_bbcode_check CHECK ((enable_bbcode >= 0)),
    CONSTRAINT phpbb3_posts_enable_magic_url_check CHECK ((enable_magic_url >= 0)),
    CONSTRAINT phpbb3_posts_enable_sig_check CHECK ((enable_sig >= 0)),
    CONSTRAINT phpbb3_posts_enable_smilies_check CHECK ((enable_smilies >= 0)),
    CONSTRAINT phpbb3_posts_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_posts_icon_id_check CHECK ((icon_id >= 0)),
    CONSTRAINT phpbb3_posts_post_attachment_check CHECK ((post_attachment >= 0)),
    CONSTRAINT phpbb3_posts_post_delete_time_check CHECK ((post_delete_time >= 0)),
    CONSTRAINT phpbb3_posts_post_delete_user_check CHECK ((post_delete_user >= 0)),
    CONSTRAINT phpbb3_posts_post_edit_count_check CHECK ((post_edit_count >= 0)),
    CONSTRAINT phpbb3_posts_post_edit_locked_check CHECK ((post_edit_locked >= 0)),
    CONSTRAINT phpbb3_posts_post_edit_time_check CHECK ((post_edit_time >= 0)),
    CONSTRAINT phpbb3_posts_post_edit_user_check CHECK ((post_edit_user >= 0)),
    CONSTRAINT phpbb3_posts_post_id_check CHECK ((post_id >= 0)),
    CONSTRAINT phpbb3_posts_post_postcount_check CHECK ((post_postcount >= 0)),
    CONSTRAINT phpbb3_posts_post_reported_check CHECK ((post_reported >= 0)),
    CONSTRAINT phpbb3_posts_post_time_check CHECK ((post_time >= 0)),
    CONSTRAINT phpbb3_posts_poster_id_check CHECK ((poster_id >= 0)),
    CONSTRAINT phpbb3_posts_topic_id_check CHECK ((topic_id >= 0))
);


ALTER TABLE public.phpbb3_posts OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_privmsgs_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_privmsgs_seq OWNER TO refuges;

--
-- Name: phpbb3_privmsgs; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_privmsgs (
    msg_id integer DEFAULT nextval('public.phpbb3_privmsgs_seq'::regclass) NOT NULL,
    root_level integer DEFAULT 0 NOT NULL,
    author_id integer DEFAULT 0 NOT NULL,
    icon_id integer DEFAULT 0 NOT NULL,
    author_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    message_time integer DEFAULT 0 NOT NULL,
    enable_bbcode smallint DEFAULT (1)::smallint NOT NULL,
    enable_smilies smallint DEFAULT (1)::smallint NOT NULL,
    enable_magic_url smallint DEFAULT (1)::smallint NOT NULL,
    enable_sig smallint DEFAULT (1)::smallint NOT NULL,
    message_subject character varying(255) DEFAULT ''::character varying NOT NULL,
    message_text text DEFAULT ''::text NOT NULL,
    message_edit_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    message_edit_user integer DEFAULT 0 NOT NULL,
    message_attachment smallint DEFAULT (0)::smallint NOT NULL,
    bbcode_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    bbcode_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    message_edit_time integer DEFAULT 0 NOT NULL,
    message_edit_count smallint DEFAULT (0)::smallint NOT NULL,
    to_address character varying(4000) DEFAULT ''::character varying NOT NULL,
    bcc_address character varying(4000) DEFAULT ''::character varying NOT NULL,
    message_reported smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_privmsgs_author_id_check CHECK ((author_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_enable_bbcode_check CHECK ((enable_bbcode >= 0)),
    CONSTRAINT phpbb3_privmsgs_enable_magic_url_check CHECK ((enable_magic_url >= 0)),
    CONSTRAINT phpbb3_privmsgs_enable_sig_check CHECK ((enable_sig >= 0)),
    CONSTRAINT phpbb3_privmsgs_enable_smilies_check CHECK ((enable_smilies >= 0)),
    CONSTRAINT phpbb3_privmsgs_icon_id_check CHECK ((icon_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_attachment_check CHECK ((message_attachment >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_edit_count_check CHECK ((message_edit_count >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_edit_time_check CHECK ((message_edit_time >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_edit_user_check CHECK ((message_edit_user >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_reported_check CHECK ((message_reported >= 0)),
    CONSTRAINT phpbb3_privmsgs_message_time_check CHECK ((message_time >= 0)),
    CONSTRAINT phpbb3_privmsgs_msg_id_check CHECK ((msg_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_root_level_check CHECK ((root_level >= 0))
);


ALTER TABLE public.phpbb3_privmsgs OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_folder_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_privmsgs_folder_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_privmsgs_folder_seq OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_folder; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_privmsgs_folder (
    folder_id integer DEFAULT nextval('public.phpbb3_privmsgs_folder_seq'::regclass) NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    folder_name character varying(255) DEFAULT ''::character varying NOT NULL,
    pm_count integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_privmsgs_folder_folder_id_check CHECK ((folder_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_folder_pm_count_check CHECK ((pm_count >= 0)),
    CONSTRAINT phpbb3_privmsgs_folder_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_privmsgs_folder OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_rules_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_privmsgs_rules_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_privmsgs_rules_seq OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_rules; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_privmsgs_rules (
    rule_id integer DEFAULT nextval('public.phpbb3_privmsgs_rules_seq'::regclass) NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    rule_check integer DEFAULT 0 NOT NULL,
    rule_connection integer DEFAULT 0 NOT NULL,
    rule_string character varying(255) DEFAULT ''::character varying NOT NULL,
    rule_user_id integer DEFAULT 0 NOT NULL,
    rule_group_id integer DEFAULT 0 NOT NULL,
    rule_action integer DEFAULT 0 NOT NULL,
    rule_folder_id integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_privmsgs_rules_rule_action_check CHECK ((rule_action >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_rule_check_check CHECK ((rule_check >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_rule_connection_check CHECK ((rule_connection >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_rule_group_id_check CHECK ((rule_group_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_rule_id_check CHECK ((rule_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_rule_user_id_check CHECK ((rule_user_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_rules_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_privmsgs_rules OWNER TO refuges;

--
-- Name: phpbb3_privmsgs_to; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_privmsgs_to (
    msg_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    author_id integer DEFAULT 0 NOT NULL,
    pm_deleted smallint DEFAULT (0)::smallint NOT NULL,
    pm_new smallint DEFAULT (1)::smallint NOT NULL,
    pm_unread smallint DEFAULT (1)::smallint NOT NULL,
    pm_replied smallint DEFAULT (0)::smallint NOT NULL,
    pm_marked smallint DEFAULT (0)::smallint NOT NULL,
    pm_forwarded smallint DEFAULT (0)::smallint NOT NULL,
    folder_id integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_privmsgs_to_author_id_check CHECK ((author_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_msg_id_check CHECK ((msg_id >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_deleted_check CHECK ((pm_deleted >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_forwarded_check CHECK ((pm_forwarded >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_marked_check CHECK ((pm_marked >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_new_check CHECK ((pm_new >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_replied_check CHECK ((pm_replied >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_pm_unread_check CHECK ((pm_unread >= 0)),
    CONSTRAINT phpbb3_privmsgs_to_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_privmsgs_to OWNER TO refuges;

--
-- Name: phpbb3_profile_fields_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_profile_fields_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_profile_fields_seq OWNER TO refuges;

--
-- Name: phpbb3_profile_fields; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_profile_fields (
    field_id integer DEFAULT nextval('public.phpbb3_profile_fields_seq'::regclass) NOT NULL,
    field_name character varying(255) DEFAULT ''::character varying NOT NULL,
    field_type character varying(100) DEFAULT ''::character varying NOT NULL,
    field_ident character varying(20) DEFAULT ''::character varying NOT NULL,
    field_length character varying(20) DEFAULT ''::character varying NOT NULL,
    field_minlen character varying(255) DEFAULT ''::character varying NOT NULL,
    field_maxlen character varying(255) DEFAULT ''::character varying NOT NULL,
    field_novalue character varying(255) DEFAULT ''::character varying NOT NULL,
    field_default_value character varying(255) DEFAULT ''::character varying NOT NULL,
    field_validation character varying(64) DEFAULT ''::character varying NOT NULL,
    field_required smallint DEFAULT (0)::smallint NOT NULL,
    field_show_on_reg smallint DEFAULT (0)::smallint NOT NULL,
    field_hide smallint DEFAULT (0)::smallint NOT NULL,
    field_no_view smallint DEFAULT (0)::smallint NOT NULL,
    field_active smallint DEFAULT (0)::smallint NOT NULL,
    field_order integer DEFAULT 0 NOT NULL,
    field_show_profile smallint DEFAULT (0)::smallint NOT NULL,
    field_show_on_vt smallint DEFAULT (0)::smallint NOT NULL,
    field_show_novalue smallint DEFAULT (0)::smallint NOT NULL,
    field_show_on_pm smallint DEFAULT (0)::smallint NOT NULL,
    field_show_on_ml smallint DEFAULT (0)::smallint NOT NULL,
    field_is_contact smallint DEFAULT (0)::smallint NOT NULL,
    field_contact_desc character varying(255) DEFAULT ''::character varying NOT NULL,
    field_contact_url character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_profile_fields_field_active_check CHECK ((field_active >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_hide_check CHECK ((field_hide >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_id_check CHECK ((field_id >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_is_contact_check CHECK ((field_is_contact >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_no_view_check CHECK ((field_no_view >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_order_check CHECK ((field_order >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_required_check CHECK ((field_required >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_novalue_check CHECK ((field_show_novalue >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_on_ml_check CHECK ((field_show_on_ml >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_on_pm_check CHECK ((field_show_on_pm >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_on_reg_check CHECK ((field_show_on_reg >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_on_vt_check CHECK ((field_show_on_vt >= 0)),
    CONSTRAINT phpbb3_profile_fields_field_show_profile_check CHECK ((field_show_profile >= 0))
);


ALTER TABLE public.phpbb3_profile_fields OWNER TO refuges;

--
-- Name: phpbb3_profile_fields_data; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_profile_fields_data (
    user_id integer DEFAULT 0 NOT NULL,
    pf_phpbb_interests text DEFAULT ''::text NOT NULL,
    pf_phpbb_occupation text DEFAULT ''::text NOT NULL,
    pf_phpbb_location character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_youtube character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_facebook character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_icq character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_skype character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_twitter character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_googleplus character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_website character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_yahoo character varying(255) DEFAULT ''::character varying NOT NULL,
    pf_phpbb_aol character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_profile_fields_data_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_profile_fields_data OWNER TO refuges;

--
-- Name: phpbb3_profile_fields_lang; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_profile_fields_lang (
    field_id integer DEFAULT 0 NOT NULL,
    lang_id integer DEFAULT 0 NOT NULL,
    option_id integer DEFAULT 0 NOT NULL,
    field_type character varying(100) DEFAULT ''::character varying NOT NULL,
    lang_value character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_profile_fields_lang_field_id_check CHECK ((field_id >= 0)),
    CONSTRAINT phpbb3_profile_fields_lang_lang_id_check CHECK ((lang_id >= 0)),
    CONSTRAINT phpbb3_profile_fields_lang_option_id_check CHECK ((option_id >= 0))
);


ALTER TABLE public.phpbb3_profile_fields_lang OWNER TO refuges;

--
-- Name: phpbb3_profile_lang; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_profile_lang (
    field_id integer DEFAULT 0 NOT NULL,
    lang_id integer DEFAULT 0 NOT NULL,
    lang_name character varying(255) DEFAULT ''::character varying NOT NULL,
    lang_explain character varying(4000) DEFAULT ''::character varying NOT NULL,
    lang_default_value character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_profile_lang_field_id_check CHECK ((field_id >= 0)),
    CONSTRAINT phpbb3_profile_lang_lang_id_check CHECK ((lang_id >= 0))
);


ALTER TABLE public.phpbb3_profile_lang OWNER TO refuges;

--
-- Name: phpbb3_qa_confirm; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_qa_confirm (
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    confirm_id character(32) DEFAULT ''::bpchar NOT NULL,
    lang_iso character varying(30) DEFAULT ''::character varying NOT NULL,
    question_id integer DEFAULT 0 NOT NULL,
    attempts integer DEFAULT 0 NOT NULL,
    confirm_type smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_qa_confirm_attempts_check CHECK ((attempts >= 0)),
    CONSTRAINT phpbb3_qa_confirm_confirm_type_check CHECK ((confirm_type >= 0)),
    CONSTRAINT phpbb3_qa_confirm_question_id_check CHECK ((question_id >= 0))
);


ALTER TABLE public.phpbb3_qa_confirm OWNER TO refuges;

--
-- Name: phpbb3_ranks_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_ranks_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_ranks_seq OWNER TO refuges;

--
-- Name: phpbb3_ranks; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_ranks (
    rank_id integer DEFAULT nextval('public.phpbb3_ranks_seq'::regclass) NOT NULL,
    rank_title character varying(255) DEFAULT ''::character varying NOT NULL,
    rank_min integer DEFAULT 0 NOT NULL,
    rank_special smallint DEFAULT (0)::smallint NOT NULL,
    rank_image character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_ranks_rank_id_check CHECK ((rank_id >= 0)),
    CONSTRAINT phpbb3_ranks_rank_min_check CHECK ((rank_min >= 0)),
    CONSTRAINT phpbb3_ranks_rank_special_check CHECK ((rank_special >= 0))
);


ALTER TABLE public.phpbb3_ranks OWNER TO refuges;

--
-- Name: phpbb3_reports_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_reports_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_reports_seq OWNER TO refuges;

--
-- Name: phpbb3_reports; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_reports (
    report_id integer DEFAULT nextval('public.phpbb3_reports_seq'::regclass) NOT NULL,
    reason_id smallint DEFAULT (0)::smallint NOT NULL,
    post_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    user_notify smallint DEFAULT (0)::smallint NOT NULL,
    report_closed smallint DEFAULT (0)::smallint NOT NULL,
    report_time integer DEFAULT 0 NOT NULL,
    report_text text DEFAULT ''::text NOT NULL,
    pm_id integer DEFAULT 0 NOT NULL,
    reported_post_enable_bbcode smallint DEFAULT (1)::smallint NOT NULL,
    reported_post_enable_smilies smallint DEFAULT (1)::smallint NOT NULL,
    reported_post_enable_magic_url smallint DEFAULT (1)::smallint NOT NULL,
    reported_post_text text DEFAULT ''::text NOT NULL,
    reported_post_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    reported_post_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_reports_pm_id_check CHECK ((pm_id >= 0)),
    CONSTRAINT phpbb3_reports_post_id_check CHECK ((post_id >= 0)),
    CONSTRAINT phpbb3_reports_reason_id_check CHECK ((reason_id >= 0)),
    CONSTRAINT phpbb3_reports_report_closed_check CHECK ((report_closed >= 0)),
    CONSTRAINT phpbb3_reports_report_id_check CHECK ((report_id >= 0)),
    CONSTRAINT phpbb3_reports_report_time_check CHECK ((report_time >= 0)),
    CONSTRAINT phpbb3_reports_reported_post_enable_bbcode_check CHECK ((reported_post_enable_bbcode >= 0)),
    CONSTRAINT phpbb3_reports_reported_post_enable_magic_url_check CHECK ((reported_post_enable_magic_url >= 0)),
    CONSTRAINT phpbb3_reports_reported_post_enable_smilies_check CHECK ((reported_post_enable_smilies >= 0)),
    CONSTRAINT phpbb3_reports_user_id_check CHECK ((user_id >= 0)),
    CONSTRAINT phpbb3_reports_user_notify_check CHECK ((user_notify >= 0))
);


ALTER TABLE public.phpbb3_reports OWNER TO refuges;

--
-- Name: phpbb3_reports_reasons_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_reports_reasons_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_reports_reasons_seq OWNER TO refuges;

--
-- Name: phpbb3_reports_reasons; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_reports_reasons (
    reason_id smallint DEFAULT nextval('public.phpbb3_reports_reasons_seq'::regclass) NOT NULL,
    reason_title character varying(255) DEFAULT ''::character varying NOT NULL,
    reason_description text DEFAULT ''::text NOT NULL,
    reason_order smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_reports_reasons_reason_id_check CHECK ((reason_id >= 0)),
    CONSTRAINT phpbb3_reports_reasons_reason_order_check CHECK ((reason_order >= 0))
);


ALTER TABLE public.phpbb3_reports_reasons OWNER TO refuges;

--
-- Name: phpbb3_search_results; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_search_results (
    search_key character varying(32) DEFAULT ''::character varying NOT NULL,
    search_time integer DEFAULT 0 NOT NULL,
    search_keywords text DEFAULT ''::text NOT NULL,
    search_authors text DEFAULT ''::text NOT NULL,
    CONSTRAINT phpbb3_search_results_search_time_check CHECK ((search_time >= 0))
);


ALTER TABLE public.phpbb3_search_results OWNER TO refuges;

--
-- Name: phpbb3_search_wordlist_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_search_wordlist_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_search_wordlist_seq OWNER TO refuges;

--
-- Name: phpbb3_search_wordlist; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_search_wordlist (
    word_id integer DEFAULT nextval('public.phpbb3_search_wordlist_seq'::regclass) NOT NULL,
    word_text character varying(255) DEFAULT ''::character varying NOT NULL,
    word_common smallint DEFAULT (0)::smallint NOT NULL,
    word_count integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_search_wordlist_word_common_check CHECK ((word_common >= 0)),
    CONSTRAINT phpbb3_search_wordlist_word_count_check CHECK ((word_count >= 0)),
    CONSTRAINT phpbb3_search_wordlist_word_id_check CHECK ((word_id >= 0))
);


ALTER TABLE public.phpbb3_search_wordlist OWNER TO refuges;

--
-- Name: phpbb3_search_wordmatch; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_search_wordmatch (
    post_id integer DEFAULT 0 NOT NULL,
    word_id integer DEFAULT 0 NOT NULL,
    title_match smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_search_wordmatch_post_id_check CHECK ((post_id >= 0)),
    CONSTRAINT phpbb3_search_wordmatch_title_match_check CHECK ((title_match >= 0)),
    CONSTRAINT phpbb3_search_wordmatch_word_id_check CHECK ((word_id >= 0))
);


ALTER TABLE public.phpbb3_search_wordmatch OWNER TO refuges;

--
-- Name: phpbb3_sessions; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_sessions (
    session_id character(32) DEFAULT ''::bpchar NOT NULL,
    session_user_id integer DEFAULT 0 NOT NULL,
    session_last_visit integer DEFAULT 0 NOT NULL,
    session_start integer DEFAULT 0 NOT NULL,
    session_time integer DEFAULT 0 NOT NULL,
    session_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    session_browser character varying(150) DEFAULT ''::character varying NOT NULL,
    session_forwarded_for character varying(255) DEFAULT ''::character varying NOT NULL,
    session_page character varying(255) DEFAULT ''::character varying NOT NULL,
    session_viewonline smallint DEFAULT (1)::smallint NOT NULL,
    session_autologin smallint DEFAULT (0)::smallint NOT NULL,
    session_admin smallint DEFAULT (0)::smallint NOT NULL,
    session_forum_id integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_sessions_session_admin_check CHECK ((session_admin >= 0)),
    CONSTRAINT phpbb3_sessions_session_autologin_check CHECK ((session_autologin >= 0)),
    CONSTRAINT phpbb3_sessions_session_forum_id_check CHECK ((session_forum_id >= 0)),
    CONSTRAINT phpbb3_sessions_session_last_visit_check CHECK ((session_last_visit >= 0)),
    CONSTRAINT phpbb3_sessions_session_start_check CHECK ((session_start >= 0)),
    CONSTRAINT phpbb3_sessions_session_time_check CHECK ((session_time >= 0)),
    CONSTRAINT phpbb3_sessions_session_user_id_check CHECK ((session_user_id >= 0)),
    CONSTRAINT phpbb3_sessions_session_viewonline_check CHECK ((session_viewonline >= 0))
);


ALTER TABLE public.phpbb3_sessions OWNER TO refuges;

--
-- Name: phpbb3_sessions_keys; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_sessions_keys (
    key_id character(32) DEFAULT ''::bpchar NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    last_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    last_login integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_sessions_keys_last_login_check CHECK ((last_login >= 0)),
    CONSTRAINT phpbb3_sessions_keys_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_sessions_keys OWNER TO refuges;

--
-- Name: phpbb3_sitelist_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_sitelist_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_sitelist_seq OWNER TO refuges;

--
-- Name: phpbb3_sitelist; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_sitelist (
    site_id integer DEFAULT nextval('public.phpbb3_sitelist_seq'::regclass) NOT NULL,
    site_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    site_hostname character varying(255) DEFAULT ''::character varying NOT NULL,
    ip_exclude smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_sitelist_ip_exclude_check CHECK ((ip_exclude >= 0)),
    CONSTRAINT phpbb3_sitelist_site_id_check CHECK ((site_id >= 0))
);


ALTER TABLE public.phpbb3_sitelist OWNER TO refuges;

--
-- Name: phpbb3_smilies_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_smilies_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_smilies_seq OWNER TO refuges;

--
-- Name: phpbb3_smilies; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_smilies (
    smiley_id integer DEFAULT nextval('public.phpbb3_smilies_seq'::regclass) NOT NULL,
    code character varying(50) DEFAULT ''::character varying NOT NULL,
    emotion character varying(255) DEFAULT ''::character varying NOT NULL,
    smiley_url character varying(50) DEFAULT ''::character varying NOT NULL,
    smiley_width smallint DEFAULT (0)::smallint NOT NULL,
    smiley_height smallint DEFAULT (0)::smallint NOT NULL,
    smiley_order integer DEFAULT 0 NOT NULL,
    display_on_posting smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_smilies_display_on_posting_check CHECK ((display_on_posting >= 0)),
    CONSTRAINT phpbb3_smilies_smiley_height_check CHECK ((smiley_height >= 0)),
    CONSTRAINT phpbb3_smilies_smiley_id_check CHECK ((smiley_id >= 0)),
    CONSTRAINT phpbb3_smilies_smiley_order_check CHECK ((smiley_order >= 0)),
    CONSTRAINT phpbb3_smilies_smiley_width_check CHECK ((smiley_width >= 0))
);


ALTER TABLE public.phpbb3_smilies OWNER TO refuges;

--
-- Name: phpbb3_styles_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_styles_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_styles_seq OWNER TO refuges;

--
-- Name: phpbb3_styles; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_styles (
    style_id integer DEFAULT nextval('public.phpbb3_styles_seq'::regclass) NOT NULL,
    style_name character varying(255) DEFAULT ''::character varying NOT NULL,
    style_copyright character varying(255) DEFAULT ''::character varying NOT NULL,
    style_active smallint DEFAULT (1)::smallint NOT NULL,
    style_path character varying(100) DEFAULT ''::character varying NOT NULL,
    bbcode_bitfield character varying(255) DEFAULT 'kNg='::character varying NOT NULL,
    style_parent_id integer DEFAULT 0 NOT NULL,
    style_parent_tree character varying(8000) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_styles_style_active_check CHECK ((style_active >= 0)),
    CONSTRAINT phpbb3_styles_style_id_check CHECK ((style_id >= 0)),
    CONSTRAINT phpbb3_styles_style_parent_id_check CHECK ((style_parent_id >= 0))
);


ALTER TABLE public.phpbb3_styles OWNER TO refuges;

--
-- Name: phpbb3_teampage_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_teampage_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_teampage_seq OWNER TO refuges;

--
-- Name: phpbb3_teampage; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_teampage (
    teampage_id integer DEFAULT nextval('public.phpbb3_teampage_seq'::regclass) NOT NULL,
    group_id integer DEFAULT 0 NOT NULL,
    teampage_name character varying(255) DEFAULT ''::character varying NOT NULL,
    teampage_position integer DEFAULT 0 NOT NULL,
    teampage_parent integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_teampage_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_teampage_teampage_id_check CHECK ((teampage_id >= 0)),
    CONSTRAINT phpbb3_teampage_teampage_parent_check CHECK ((teampage_parent >= 0)),
    CONSTRAINT phpbb3_teampage_teampage_position_check CHECK ((teampage_position >= 0))
);


ALTER TABLE public.phpbb3_teampage OWNER TO refuges;

--
-- Name: phpbb3_topics_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_topics_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_topics_seq OWNER TO refuges;

--
-- Name: phpbb3_topics; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_topics (
    topic_id integer DEFAULT nextval('public.phpbb3_topics_seq'::regclass) NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    icon_id integer DEFAULT 0 NOT NULL,
    topic_attachment smallint DEFAULT (0)::smallint NOT NULL,
    topic_reported smallint DEFAULT (0)::smallint NOT NULL,
    topic_title character varying(255) DEFAULT ''::character varying NOT NULL,
    topic_poster integer DEFAULT 0 NOT NULL,
    topic_time integer DEFAULT 0 NOT NULL,
    topic_time_limit integer DEFAULT 0 NOT NULL,
    topic_views integer DEFAULT 0 NOT NULL,
    topic_status smallint DEFAULT (0)::smallint NOT NULL,
    topic_type smallint DEFAULT (0)::smallint NOT NULL,
    topic_first_post_id integer DEFAULT 0 NOT NULL,
    topic_first_poster_name character varying(255) DEFAULT ''::character varying NOT NULL,
    topic_first_poster_colour character varying(6) DEFAULT ''::character varying NOT NULL,
    topic_last_post_id integer DEFAULT 0 NOT NULL,
    topic_last_poster_id integer DEFAULT 0 NOT NULL,
    topic_last_poster_name character varying(255) DEFAULT ''::character varying NOT NULL,
    topic_last_poster_colour character varying(6) DEFAULT ''::character varying NOT NULL,
    topic_last_post_subject character varying(255) DEFAULT ''::character varying NOT NULL,
    topic_last_post_time integer DEFAULT 0 NOT NULL,
    topic_last_view_time integer DEFAULT 0 NOT NULL,
    topic_moved_id integer DEFAULT 0 NOT NULL,
    topic_bumped smallint DEFAULT (0)::smallint NOT NULL,
    topic_bumper integer DEFAULT 0 NOT NULL,
    poll_title character varying(255) DEFAULT ''::character varying NOT NULL,
    poll_start integer DEFAULT 0 NOT NULL,
    poll_length integer DEFAULT 0 NOT NULL,
    poll_max_options smallint DEFAULT (1)::smallint NOT NULL,
    poll_last_vote integer DEFAULT 0 NOT NULL,
    poll_vote_change smallint DEFAULT (0)::smallint NOT NULL,
    topic_visibility smallint DEFAULT (0)::smallint NOT NULL,
    topic_delete_time integer DEFAULT 0 NOT NULL,
    topic_delete_reason character varying(255) DEFAULT ''::character varying NOT NULL,
    topic_delete_user integer DEFAULT 0 NOT NULL,
    topic_posts_approved integer DEFAULT 0 NOT NULL,
    topic_posts_unapproved integer DEFAULT 0 NOT NULL,
    topic_posts_softdeleted integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_topics_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_topics_icon_id_check CHECK ((icon_id >= 0)),
    CONSTRAINT phpbb3_topics_poll_last_vote_check CHECK ((poll_last_vote >= 0)),
    CONSTRAINT phpbb3_topics_poll_length_check CHECK ((poll_length >= 0)),
    CONSTRAINT phpbb3_topics_poll_start_check CHECK ((poll_start >= 0)),
    CONSTRAINT phpbb3_topics_poll_vote_change_check CHECK ((poll_vote_change >= 0)),
    CONSTRAINT phpbb3_topics_topic_attachment_check CHECK ((topic_attachment >= 0)),
    CONSTRAINT phpbb3_topics_topic_bumped_check CHECK ((topic_bumped >= 0)),
    CONSTRAINT phpbb3_topics_topic_bumper_check CHECK ((topic_bumper >= 0)),
    CONSTRAINT phpbb3_topics_topic_delete_time_check CHECK ((topic_delete_time >= 0)),
    CONSTRAINT phpbb3_topics_topic_delete_user_check CHECK ((topic_delete_user >= 0)),
    CONSTRAINT phpbb3_topics_topic_first_post_id_check CHECK ((topic_first_post_id >= 0)),
    CONSTRAINT phpbb3_topics_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_topics_topic_last_post_id_check CHECK ((topic_last_post_id >= 0)),
    CONSTRAINT phpbb3_topics_topic_last_post_time_check CHECK ((topic_last_post_time >= 0)),
    CONSTRAINT phpbb3_topics_topic_last_poster_id_check CHECK ((topic_last_poster_id >= 0)),
    CONSTRAINT phpbb3_topics_topic_last_view_time_check CHECK ((topic_last_view_time >= 0)),
    CONSTRAINT phpbb3_topics_topic_moved_id_check CHECK ((topic_moved_id >= 0)),
    CONSTRAINT phpbb3_topics_topic_poster_check CHECK ((topic_poster >= 0)),
    CONSTRAINT phpbb3_topics_topic_posts_approved_check CHECK ((topic_posts_approved >= 0)),
    CONSTRAINT phpbb3_topics_topic_posts_softdeleted_check CHECK ((topic_posts_softdeleted >= 0)),
    CONSTRAINT phpbb3_topics_topic_posts_unapproved_check CHECK ((topic_posts_unapproved >= 0)),
    CONSTRAINT phpbb3_topics_topic_reported_check CHECK ((topic_reported >= 0)),
    CONSTRAINT phpbb3_topics_topic_time_check CHECK ((topic_time >= 0)),
    CONSTRAINT phpbb3_topics_topic_time_limit_check CHECK ((topic_time_limit >= 0)),
    CONSTRAINT phpbb3_topics_topic_views_check CHECK ((topic_views >= 0))
);


ALTER TABLE public.phpbb3_topics OWNER TO refuges;

--
-- Name: phpbb3_topics_posted; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_topics_posted (
    user_id integer DEFAULT 0 NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    topic_posted smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_topics_posted_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_topics_posted_topic_posted_check CHECK ((topic_posted >= 0)),
    CONSTRAINT phpbb3_topics_posted_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_topics_posted OWNER TO refuges;

--
-- Name: phpbb3_topics_track; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_topics_track (
    user_id integer DEFAULT 0 NOT NULL,
    topic_id integer DEFAULT 0 NOT NULL,
    forum_id integer DEFAULT 0 NOT NULL,
    mark_time integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_topics_track_forum_id_check CHECK ((forum_id >= 0)),
    CONSTRAINT phpbb3_topics_track_mark_time_check CHECK ((mark_time >= 0)),
    CONSTRAINT phpbb3_topics_track_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_topics_track_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_topics_track OWNER TO refuges;

--
-- Name: phpbb3_topics_watch; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_topics_watch (
    topic_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    notify_status smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_topics_watch_notify_status_check CHECK ((notify_status >= 0)),
    CONSTRAINT phpbb3_topics_watch_topic_id_check CHECK ((topic_id >= 0)),
    CONSTRAINT phpbb3_topics_watch_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_topics_watch OWNER TO refuges;

--
-- Name: phpbb3_user_group; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_user_group (
    group_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    group_leader smallint DEFAULT (0)::smallint NOT NULL,
    user_pending smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_user_group_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_user_group_group_leader_check CHECK ((group_leader >= 0)),
    CONSTRAINT phpbb3_user_group_user_id_check CHECK ((user_id >= 0)),
    CONSTRAINT phpbb3_user_group_user_pending_check CHECK ((user_pending >= 0))
);


ALTER TABLE public.phpbb3_user_group OWNER TO refuges;

--
-- Name: phpbb3_user_notifications; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_user_notifications (
    item_type character varying(255) DEFAULT ''::character varying NOT NULL,
    item_id integer DEFAULT 0 NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    method character varying(255) DEFAULT ''::character varying NOT NULL,
    notify smallint DEFAULT (1)::smallint NOT NULL,
    CONSTRAINT phpbb3_user_notifications_item_id_check CHECK ((item_id >= 0)),
    CONSTRAINT phpbb3_user_notifications_notify_check CHECK ((notify >= 0)),
    CONSTRAINT phpbb3_user_notifications_user_id_check CHECK ((user_id >= 0))
);


ALTER TABLE public.phpbb3_user_notifications OWNER TO refuges;

--
-- Name: phpbb3_users_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_users_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_users_seq OWNER TO refuges;

--
-- Name: phpbb3_users; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_users (
    user_id integer DEFAULT nextval('public.phpbb3_users_seq'::regclass) NOT NULL,
    user_type smallint DEFAULT (0)::smallint NOT NULL,
    group_id integer DEFAULT 3 NOT NULL,
    user_permissions text DEFAULT ''::text NOT NULL,
    user_perm_from integer DEFAULT 0 NOT NULL,
    user_ip character varying(40) DEFAULT ''::character varying NOT NULL,
    user_regdate integer DEFAULT 0 NOT NULL,
    username public.varchar_ci DEFAULT ''::character varying NOT NULL,
    username_clean public.varchar_ci DEFAULT ''::character varying NOT NULL,
    user_password character varying(255) DEFAULT ''::character varying NOT NULL,
    user_passchg integer DEFAULT 0 NOT NULL,
    user_email character varying(100) DEFAULT ''::character varying NOT NULL,
    user_email_hash bigint DEFAULT (0)::bigint NOT NULL,
    user_birthday character varying(10) DEFAULT ''::character varying NOT NULL,
    user_lastvisit integer DEFAULT 0 NOT NULL,
    user_lastmark integer DEFAULT 0 NOT NULL,
    user_lastpost_time integer DEFAULT 0 NOT NULL,
    user_lastpage character varying(200) DEFAULT ''::character varying NOT NULL,
    user_last_confirm_key character varying(10) DEFAULT ''::character varying NOT NULL,
    user_last_search integer DEFAULT 0 NOT NULL,
    user_warnings smallint DEFAULT (0)::smallint NOT NULL,
    user_last_warning integer DEFAULT 0 NOT NULL,
    user_login_attempts smallint DEFAULT (0)::smallint NOT NULL,
    user_inactive_reason smallint DEFAULT (0)::smallint NOT NULL,
    user_inactive_time integer DEFAULT 0 NOT NULL,
    user_posts integer DEFAULT 0 NOT NULL,
    user_lang character varying(30) DEFAULT ''::character varying NOT NULL,
    user_timezone character varying(100) DEFAULT ''::character varying NOT NULL,
    user_dateformat character varying(64) DEFAULT 'd M Y H:i'::character varying NOT NULL,
    user_style integer DEFAULT 0 NOT NULL,
    user_rank integer DEFAULT 0 NOT NULL,
    user_colour character varying(6) DEFAULT ''::character varying NOT NULL,
    user_new_privmsg integer DEFAULT 0 NOT NULL,
    user_unread_privmsg integer DEFAULT 0 NOT NULL,
    user_last_privmsg integer DEFAULT 0 NOT NULL,
    user_message_rules smallint DEFAULT (0)::smallint NOT NULL,
    user_full_folder integer DEFAULT (-3) NOT NULL,
    user_emailtime integer DEFAULT 0 NOT NULL,
    user_topic_show_days smallint DEFAULT (0)::smallint NOT NULL,
    user_topic_sortby_type character varying(1) DEFAULT 't'::character varying NOT NULL,
    user_topic_sortby_dir character varying(1) DEFAULT 'd'::character varying NOT NULL,
    user_post_show_days smallint DEFAULT (0)::smallint NOT NULL,
    user_post_sortby_type character varying(1) DEFAULT 't'::character varying NOT NULL,
    user_post_sortby_dir character varying(1) DEFAULT 'a'::character varying NOT NULL,
    user_notify smallint DEFAULT (0)::smallint NOT NULL,
    user_notify_pm smallint DEFAULT (1)::smallint NOT NULL,
    user_notify_type smallint DEFAULT (0)::smallint NOT NULL,
    user_allow_pm smallint DEFAULT (1)::smallint NOT NULL,
    user_allow_viewonline smallint DEFAULT (1)::smallint NOT NULL,
    user_allow_viewemail smallint DEFAULT (1)::smallint NOT NULL,
    user_allow_massemail smallint DEFAULT (1)::smallint NOT NULL,
    user_options integer DEFAULT 230271 NOT NULL,
    user_avatar character varying(255) DEFAULT ''::character varying NOT NULL,
    user_avatar_type character varying(255) DEFAULT ''::character varying NOT NULL,
    user_avatar_width smallint DEFAULT (0)::smallint NOT NULL,
    user_avatar_height smallint DEFAULT (0)::smallint NOT NULL,
    user_sig text DEFAULT ''::text NOT NULL,
    user_sig_bbcode_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    user_sig_bbcode_bitfield character varying(255) DEFAULT ''::character varying NOT NULL,
    user_jabber character varying(255) DEFAULT ''::character varying NOT NULL,
    user_actkey character varying(32) DEFAULT ''::character varying NOT NULL,
    user_newpasswd character varying(255) DEFAULT ''::character varying NOT NULL,
    user_form_salt character varying(32) DEFAULT ''::character varying NOT NULL,
    user_new smallint DEFAULT (1)::smallint NOT NULL,
    user_reminded smallint DEFAULT (0)::smallint NOT NULL,
    user_reminded_time integer DEFAULT 0 NOT NULL,
    ct_marked integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_users_group_id_check CHECK ((group_id >= 0)),
    CONSTRAINT phpbb3_users_user_allow_massemail_check CHECK ((user_allow_massemail >= 0)),
    CONSTRAINT phpbb3_users_user_allow_pm_check CHECK ((user_allow_pm >= 0)),
    CONSTRAINT phpbb3_users_user_allow_viewemail_check CHECK ((user_allow_viewemail >= 0)),
    CONSTRAINT phpbb3_users_user_allow_viewonline_check CHECK ((user_allow_viewonline >= 0)),
    CONSTRAINT phpbb3_users_user_avatar_height_check CHECK ((user_avatar_height >= 0)),
    CONSTRAINT phpbb3_users_user_avatar_width_check CHECK ((user_avatar_width >= 0)),
    CONSTRAINT phpbb3_users_user_emailtime_check CHECK ((user_emailtime >= 0)),
    CONSTRAINT phpbb3_users_user_id_check CHECK ((user_id >= 0)),
    CONSTRAINT phpbb3_users_user_inactive_time_check CHECK ((user_inactive_time >= 0)),
    CONSTRAINT phpbb3_users_user_last_privmsg_check CHECK ((user_last_privmsg >= 0)),
    CONSTRAINT phpbb3_users_user_last_search_check CHECK ((user_last_search >= 0)),
    CONSTRAINT phpbb3_users_user_last_warning_check CHECK ((user_last_warning >= 0)),
    CONSTRAINT phpbb3_users_user_lastmark_check CHECK ((user_lastmark >= 0)),
    CONSTRAINT phpbb3_users_user_lastpost_time_check CHECK ((user_lastpost_time >= 0)),
    CONSTRAINT phpbb3_users_user_lastvisit_check CHECK ((user_lastvisit >= 0)),
    CONSTRAINT phpbb3_users_user_message_rules_check CHECK ((user_message_rules >= 0)),
    CONSTRAINT phpbb3_users_user_new_check CHECK ((user_new >= 0)),
    CONSTRAINT phpbb3_users_user_notify_check CHECK ((user_notify >= 0)),
    CONSTRAINT phpbb3_users_user_notify_pm_check CHECK ((user_notify_pm >= 0)),
    CONSTRAINT phpbb3_users_user_options_check CHECK ((user_options >= 0)),
    CONSTRAINT phpbb3_users_user_passchg_check CHECK ((user_passchg >= 0)),
    CONSTRAINT phpbb3_users_user_perm_from_check CHECK ((user_perm_from >= 0)),
    CONSTRAINT phpbb3_users_user_post_show_days_check CHECK ((user_post_show_days >= 0)),
    CONSTRAINT phpbb3_users_user_posts_check CHECK ((user_posts >= 0)),
    CONSTRAINT phpbb3_users_user_rank_check CHECK ((user_rank >= 0)),
    CONSTRAINT phpbb3_users_user_regdate_check CHECK ((user_regdate >= 0)),
    CONSTRAINT phpbb3_users_user_reminded_time_check CHECK ((user_reminded_time >= 0)),
    CONSTRAINT phpbb3_users_user_style_check CHECK ((user_style >= 0)),
    CONSTRAINT phpbb3_users_user_topic_show_days_check CHECK ((user_topic_show_days >= 0))
);


ALTER TABLE public.phpbb3_users OWNER TO refuges;

--
-- Name: phpbb3_warnings_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_warnings_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_warnings_seq OWNER TO refuges;

--
-- Name: phpbb3_warnings; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_warnings (
    warning_id integer DEFAULT nextval('public.phpbb3_warnings_seq'::regclass) NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    post_id integer DEFAULT 0 NOT NULL,
    log_id integer DEFAULT 0 NOT NULL,
    warning_time integer DEFAULT 0 NOT NULL,
    CONSTRAINT phpbb3_warnings_log_id_check CHECK ((log_id >= 0)),
    CONSTRAINT phpbb3_warnings_post_id_check CHECK ((post_id >= 0)),
    CONSTRAINT phpbb3_warnings_user_id_check CHECK ((user_id >= 0)),
    CONSTRAINT phpbb3_warnings_warning_id_check CHECK ((warning_id >= 0)),
    CONSTRAINT phpbb3_warnings_warning_time_check CHECK ((warning_time >= 0))
);


ALTER TABLE public.phpbb3_warnings OWNER TO refuges;

--
-- Name: phpbb3_words_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.phpbb3_words_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phpbb3_words_seq OWNER TO refuges;

--
-- Name: phpbb3_words; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_words (
    word_id integer DEFAULT nextval('public.phpbb3_words_seq'::regclass) NOT NULL,
    word character varying(255) DEFAULT ''::character varying NOT NULL,
    replacement character varying(255) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT phpbb3_words_word_id_check CHECK ((word_id >= 0))
);


ALTER TABLE public.phpbb3_words OWNER TO refuges;

--
-- Name: phpbb3_zebra; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.phpbb3_zebra (
    user_id integer DEFAULT 0 NOT NULL,
    zebra_id integer DEFAULT 0 NOT NULL,
    friend smallint DEFAULT (0)::smallint NOT NULL,
    foe smallint DEFAULT (0)::smallint NOT NULL,
    CONSTRAINT phpbb3_zebra_foe_check CHECK ((foe >= 0)),
    CONSTRAINT phpbb3_zebra_friend_check CHECK ((friend >= 0)),
    CONSTRAINT phpbb3_zebra_user_id_check CHECK ((user_id >= 0)),
    CONSTRAINT phpbb3_zebra_zebra_id_check CHECK ((zebra_id >= 0))
);


ALTER TABLE public.phpbb3_zebra OWNER TO refuges;

--
-- Name: point_type_id_point_type_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.point_type_id_point_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.point_type_id_point_type_seq OWNER TO refuges;

--
-- Name: point_type; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.point_type (
    id_point_type integer DEFAULT nextval('public.point_type_id_point_type_seq'::regclass) NOT NULL,
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


ALTER TABLE public.point_type OWNER TO refuges;

--
-- Name: COLUMN point_type.symbole; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.point_type.symbole IS 'Pictos pour GPS Garmin';


--
-- Name: points_id_point_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.points_id_point_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.points_id_point_seq OWNER TO refuges;

--
-- Name: points; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.points (
    id_point integer DEFAULT nextval('public.points_id_point_seq'::regclass) NOT NULL,
    nom character varying(80) NOT NULL,
    id_point_type integer DEFAULT 0 NOT NULL,
    site_officiel character varying(255),
    places bigint DEFAULT 0 NOT NULL,
    remark text,
    proprio text,
    conditions_utilisation character varying(255) DEFAULT 'ouverture'::character varying,
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
    en_attente boolean DEFAULT false,
    topic_id integer DEFAULT 0,
    altitude integer DEFAULT 0 NOT NULL,
    acces text DEFAULT ' '::text NOT NULL,
    id_type_precision_gps integer DEFAULT 0 NOT NULL,
    geom public.geometry,
    CONSTRAINT enforce_dims_geom CHECK ((public.st_ndims(geom) = 2)),
    CONSTRAINT enforce_geotype_geom CHECK (((public.geometrytype(geom) = 'POINT'::text) OR (geom IS NULL))),
    CONSTRAINT enforce_srid_geom CHECK ((public.st_srid(geom) = 4326))
);


ALTER TABLE public.points OWNER TO refuges;

--
-- Name: COLUMN points.conditions_utilisation; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.points.conditions_utilisation IS 'ouverture ou fermeture ou detruit ou clef_a_recuperer';


--
-- Name: COLUMN points.places_matelas; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.points.places_matelas IS 'NULL-> on sait pas, 0 yen a , N il y a N matelas -1 ya pas';


--
-- Name: COLUMN points.date_creation; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.points.date_creation IS 'remplace date_insertion (bigint)';


--
-- Name: polygone_type_id_polygone_type_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.polygone_type_id_polygone_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.polygone_type_id_polygone_type_seq OWNER TO refuges;

--
-- Name: polygone_type; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.polygone_type (
    id_polygone_type integer DEFAULT nextval('public.polygone_type_id_polygone_type_seq'::regclass) NOT NULL,
    art_dem_poly character varying(6) NOT NULL,
    art_def_poly character varying(6) NOT NULL,
    type_polygone character varying(32) NOT NULL,
    ordre_taille integer DEFAULT 0 NOT NULL,
    categorie_polygone_type character varying(255)
);


ALTER TABLE public.polygone_type OWNER TO refuges;

--
-- Name: COLUMN polygone_type.ordre_taille; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.polygone_type.ordre_taille IS 'importance';


--
-- Name: polygones_id_polygone_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.polygones_id_polygone_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.polygones_id_polygone_seq OWNER TO refuges;

--
-- Name: polygones; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.polygones (
    id_polygone integer DEFAULT nextval('public.polygones_id_polygone_seq'::regclass) NOT NULL,
    id_polygone_type integer DEFAULT 1 NOT NULL,
    article_partitif character varying(20),
    nom_polygone character varying(255) NOT NULL,
    source character varying(255),
    message_information_polygone text,
    url_exterieure character varying(255),
    geom public.geometry,
    site_web character varying(255),
    CONSTRAINT enforce_dims_geom CHECK ((public.st_ndims(geom) = 2)),
    CONSTRAINT enforce_geotype_geom CHECK (((public.geometrytype(geom) = 'MULTIPOLYGON'::text) OR (geom IS NULL))),
    CONSTRAINT enforce_srid_geom CHECK ((public.st_srid(geom) = 4326))
);


ALTER TABLE public.polygones OWNER TO refuges;

--
-- Name: COLUMN polygones.article_partitif; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.polygones.article_partitif IS 'il y avait une merdouille sur le default, ca a fait des 4 partout';


--
-- Name: COLUMN polygones.url_exterieure; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.polygones.url_exterieure IS 'URL plus précise pour tirer des infos utiles pour wri (exemple : pages des restrictions pour les réserves)';


--
-- Name: COLUMN polygones.site_web; Type: COMMENT; Schema: public; Owner: refuges
--

COMMENT ON COLUMN public.polygones.site_web IS 'Adresse du site web principal du polygone (si existe)';


--
-- Name: type_precision_gps_id_type_precision_gps_seq; Type: SEQUENCE; Schema: public; Owner: refuges
--

CREATE SEQUENCE public.type_precision_gps_id_type_precision_gps_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_precision_gps_id_type_precision_gps_seq OWNER TO refuges;

--
-- Name: type_precision_gps; Type: TABLE; Schema: public; Owner: refuges; Tablespace: 
--

CREATE TABLE public.type_precision_gps (
    id_type_precision_gps integer DEFAULT nextval('public.type_precision_gps_id_type_precision_gps_seq'::regclass) NOT NULL,
    nom_precision_gps character varying(255) NOT NULL,
    ordre integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.type_precision_gps OWNER TO refuges;

--
-- Name: wfs_polys; Type: VIEW; Schema: public; Owner: refuges
--

CREATE VIEW public.wfs_polys AS
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
   FROM (public.polygones
     JOIN public.polygone_type USING (id_polygone_type))
  WHERE (polygones.geom IS NOT NULL)
  ORDER BY polygone_type.ordre_taille;


ALTER TABLE public.wfs_polys OWNER TO refuges;

--
-- Name: commentaires_id_commentaire_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.commentaires
    ADD CONSTRAINT commentaires_id_commentaire_pkey PRIMARY KEY (id_commentaire);


--
-- Name: phpbb3_acl_options_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_acl_options
    ADD CONSTRAINT phpbb3_acl_options_pkey PRIMARY KEY (auth_option_id);


--
-- Name: phpbb3_acl_roles_data_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_acl_roles_data
    ADD CONSTRAINT phpbb3_acl_roles_data_pkey PRIMARY KEY (role_id, auth_option_id);


--
-- Name: phpbb3_acl_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_acl_roles
    ADD CONSTRAINT phpbb3_acl_roles_pkey PRIMARY KEY (role_id);


--
-- Name: phpbb3_attachments_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_attachments
    ADD CONSTRAINT phpbb3_attachments_pkey PRIMARY KEY (attach_id);


--
-- Name: phpbb3_banlist_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_banlist
    ADD CONSTRAINT phpbb3_banlist_pkey PRIMARY KEY (ban_id);


--
-- Name: phpbb3_bbcodes_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_bbcodes
    ADD CONSTRAINT phpbb3_bbcodes_pkey PRIMARY KEY (bbcode_id);


--
-- Name: phpbb3_bookmarks_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_bookmarks
    ADD CONSTRAINT phpbb3_bookmarks_pkey PRIMARY KEY (topic_id, user_id);


--
-- Name: phpbb3_bots_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_bots
    ADD CONSTRAINT phpbb3_bots_pkey PRIMARY KEY (bot_id);


--
-- Name: phpbb3_captcha_questions_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_captcha_questions
    ADD CONSTRAINT phpbb3_captcha_questions_pkey PRIMARY KEY (question_id);


--
-- Name: phpbb3_cleantalk_sfw_logs_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_cleantalk_sfw_logs
    ADD CONSTRAINT phpbb3_cleantalk_sfw_logs_pkey PRIMARY KEY (ip);


--
-- Name: phpbb3_config_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_config
    ADD CONSTRAINT phpbb3_config_pkey PRIMARY KEY (config_name);


--
-- Name: phpbb3_config_text_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_config_text
    ADD CONSTRAINT phpbb3_config_text_pkey PRIMARY KEY (config_name);


--
-- Name: phpbb3_confirm_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_confirm
    ADD CONSTRAINT phpbb3_confirm_pkey PRIMARY KEY (session_id, confirm_id);


--
-- Name: phpbb3_disallow_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_disallow
    ADD CONSTRAINT phpbb3_disallow_pkey PRIMARY KEY (disallow_id);


--
-- Name: phpbb3_drafts_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_drafts
    ADD CONSTRAINT phpbb3_drafts_pkey PRIMARY KEY (draft_id);


--
-- Name: phpbb3_extension_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_extension_groups
    ADD CONSTRAINT phpbb3_extension_groups_pkey PRIMARY KEY (group_id);


--
-- Name: phpbb3_extensions_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_extensions
    ADD CONSTRAINT phpbb3_extensions_pkey PRIMARY KEY (extension_id);


--
-- Name: phpbb3_forums_access_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_forums_access
    ADD CONSTRAINT phpbb3_forums_access_pkey PRIMARY KEY (forum_id, user_id, session_id);


--
-- Name: phpbb3_forums_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_forums
    ADD CONSTRAINT phpbb3_forums_pkey PRIMARY KEY (forum_id);


--
-- Name: phpbb3_forums_track_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_forums_track
    ADD CONSTRAINT phpbb3_forums_track_pkey PRIMARY KEY (user_id, forum_id);


--
-- Name: phpbb3_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_groups
    ADD CONSTRAINT phpbb3_groups_pkey PRIMARY KEY (group_id);


--
-- Name: phpbb3_icons_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_icons
    ADD CONSTRAINT phpbb3_icons_pkey PRIMARY KEY (icons_id);


--
-- Name: phpbb3_lang_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_lang
    ADD CONSTRAINT phpbb3_lang_pkey PRIMARY KEY (lang_id);


--
-- Name: phpbb3_log_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_log
    ADD CONSTRAINT phpbb3_log_pkey PRIMARY KEY (log_id);


--
-- Name: phpbb3_migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_migrations
    ADD CONSTRAINT phpbb3_migrations_pkey PRIMARY KEY (migration_name);


--
-- Name: phpbb3_modules_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_modules
    ADD CONSTRAINT phpbb3_modules_pkey PRIMARY KEY (module_id);


--
-- Name: phpbb3_notification_types_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_notification_types
    ADD CONSTRAINT phpbb3_notification_types_pkey PRIMARY KEY (notification_type_id);


--
-- Name: phpbb3_notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_notifications
    ADD CONSTRAINT phpbb3_notifications_pkey PRIMARY KEY (notification_id);


--
-- Name: phpbb3_oauth_accounts_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_oauth_accounts
    ADD CONSTRAINT phpbb3_oauth_accounts_pkey PRIMARY KEY (user_id, provider);


--
-- Name: phpbb3_posts_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_posts
    ADD CONSTRAINT phpbb3_posts_pkey PRIMARY KEY (post_id);


--
-- Name: phpbb3_privmsgs_folder_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_privmsgs_folder
    ADD CONSTRAINT phpbb3_privmsgs_folder_pkey PRIMARY KEY (folder_id);


--
-- Name: phpbb3_privmsgs_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_privmsgs
    ADD CONSTRAINT phpbb3_privmsgs_pkey PRIMARY KEY (msg_id);


--
-- Name: phpbb3_privmsgs_rules_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_privmsgs_rules
    ADD CONSTRAINT phpbb3_privmsgs_rules_pkey PRIMARY KEY (rule_id);


--
-- Name: phpbb3_profile_fields_data_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_profile_fields_data
    ADD CONSTRAINT phpbb3_profile_fields_data_pkey PRIMARY KEY (user_id);


--
-- Name: phpbb3_profile_fields_lang_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_profile_fields_lang
    ADD CONSTRAINT phpbb3_profile_fields_lang_pkey PRIMARY KEY (field_id, lang_id, option_id);


--
-- Name: phpbb3_profile_fields_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_profile_fields
    ADD CONSTRAINT phpbb3_profile_fields_pkey PRIMARY KEY (field_id);


--
-- Name: phpbb3_profile_lang_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_profile_lang
    ADD CONSTRAINT phpbb3_profile_lang_pkey PRIMARY KEY (field_id, lang_id);


--
-- Name: phpbb3_qa_confirm_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_qa_confirm
    ADD CONSTRAINT phpbb3_qa_confirm_pkey PRIMARY KEY (confirm_id);


--
-- Name: phpbb3_ranks_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_ranks
    ADD CONSTRAINT phpbb3_ranks_pkey PRIMARY KEY (rank_id);


--
-- Name: phpbb3_reports_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_reports
    ADD CONSTRAINT phpbb3_reports_pkey PRIMARY KEY (report_id);


--
-- Name: phpbb3_reports_reasons_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_reports_reasons
    ADD CONSTRAINT phpbb3_reports_reasons_pkey PRIMARY KEY (reason_id);


--
-- Name: phpbb3_search_results_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_search_results
    ADD CONSTRAINT phpbb3_search_results_pkey PRIMARY KEY (search_key);


--
-- Name: phpbb3_search_wordlist_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_search_wordlist
    ADD CONSTRAINT phpbb3_search_wordlist_pkey PRIMARY KEY (word_id);


--
-- Name: phpbb3_sessions_keys_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_sessions_keys
    ADD CONSTRAINT phpbb3_sessions_keys_pkey PRIMARY KEY (key_id, user_id);


--
-- Name: phpbb3_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_sessions
    ADD CONSTRAINT phpbb3_sessions_pkey PRIMARY KEY (session_id);


--
-- Name: phpbb3_sitelist_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_sitelist
    ADD CONSTRAINT phpbb3_sitelist_pkey PRIMARY KEY (site_id);


--
-- Name: phpbb3_smilies_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_smilies
    ADD CONSTRAINT phpbb3_smilies_pkey PRIMARY KEY (smiley_id);


--
-- Name: phpbb3_styles_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_styles
    ADD CONSTRAINT phpbb3_styles_pkey PRIMARY KEY (style_id);


--
-- Name: phpbb3_teampage_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_teampage
    ADD CONSTRAINT phpbb3_teampage_pkey PRIMARY KEY (teampage_id);


--
-- Name: phpbb3_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_topics
    ADD CONSTRAINT phpbb3_topics_pkey PRIMARY KEY (topic_id);


--
-- Name: phpbb3_topics_posted_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_topics_posted
    ADD CONSTRAINT phpbb3_topics_posted_pkey PRIMARY KEY (user_id, topic_id);


--
-- Name: phpbb3_topics_track_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_topics_track
    ADD CONSTRAINT phpbb3_topics_track_pkey PRIMARY KEY (user_id, topic_id);


--
-- Name: phpbb3_users_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_users
    ADD CONSTRAINT phpbb3_users_pkey PRIMARY KEY (user_id);


--
-- Name: phpbb3_warnings_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_warnings
    ADD CONSTRAINT phpbb3_warnings_pkey PRIMARY KEY (warning_id);


--
-- Name: phpbb3_words_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_words
    ADD CONSTRAINT phpbb3_words_pkey PRIMARY KEY (word_id);


--
-- Name: phpbb3_zebra_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.phpbb3_zebra
    ADD CONSTRAINT phpbb3_zebra_pkey PRIMARY KEY (user_id, zebra_id);


--
-- Name: point_type_id_point_type_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.point_type
    ADD CONSTRAINT point_type_id_point_type_pkey PRIMARY KEY (id_point_type);


--
-- Name: points_id_point_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.points
    ADD CONSTRAINT points_id_point_pkey PRIMARY KEY (id_point);


--
-- Name: polygone_type_id_polygone_type_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.polygone_type
    ADD CONSTRAINT polygone_type_id_polygone_type_pkey PRIMARY KEY (id_polygone_type);


--
-- Name: polygones_id_polygone_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.polygones
    ADD CONSTRAINT polygones_id_polygone_pkey PRIMARY KEY (id_polygone);


--
-- Name: type_precision_gps_id_type_precision_gps_pkey; Type: CONSTRAINT; Schema: public; Owner: refuges; Tablespace: 
--

ALTER TABLE ONLY public.type_precision_gps
    ADD CONSTRAINT type_precision_gps_id_type_precision_gps_pkey PRIMARY KEY (id_type_precision_gps);


--
-- Name: commentaires_auteur; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_auteur ON public.commentaires USING btree (auteur_commentaire);


--
-- Name: commentaires_date; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_date ON public.commentaires USING btree (date);


--
-- Name: commentaires_demande_correction; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_demande_correction ON public.commentaires USING btree (demande_correction);


--
-- Name: commentaires_id_createur; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_id_createur ON public.commentaires USING btree (id_createur_commentaire);


--
-- Name: commentaires_id_point; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_id_point ON public.commentaires USING btree (id_point);


--
-- Name: commentaires_photo_existe; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX commentaires_photo_existe ON public.commentaires USING btree (photo_existe);


--
-- Name: index_nom_page; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX index_nom_page ON public.pages_wiki USING btree (nom_page);


--
-- Name: phpbb3_acl_groups_auth_opt_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_groups_auth_opt_id ON public.phpbb3_acl_groups USING btree (auth_option_id);


--
-- Name: phpbb3_acl_groups_auth_role_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_groups_auth_role_id ON public.phpbb3_acl_groups USING btree (auth_role_id);


--
-- Name: phpbb3_acl_groups_group_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_groups_group_id ON public.phpbb3_acl_groups USING btree (group_id);


--
-- Name: phpbb3_acl_options_auth_option; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_acl_options_auth_option ON public.phpbb3_acl_options USING btree (auth_option);


--
-- Name: phpbb3_acl_roles_data_ath_op_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_roles_data_ath_op_id ON public.phpbb3_acl_roles_data USING btree (auth_option_id);


--
-- Name: phpbb3_acl_roles_role_order; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_roles_role_order ON public.phpbb3_acl_roles USING btree (role_order);


--
-- Name: phpbb3_acl_roles_role_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_roles_role_type ON public.phpbb3_acl_roles USING btree (role_type);


--
-- Name: phpbb3_acl_users_auth_option_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_users_auth_option_id ON public.phpbb3_acl_users USING btree (auth_option_id);


--
-- Name: phpbb3_acl_users_auth_role_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_users_auth_role_id ON public.phpbb3_acl_users USING btree (auth_role_id);


--
-- Name: phpbb3_acl_users_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_acl_users_user_id ON public.phpbb3_acl_users USING btree (user_id);


--
-- Name: phpbb3_attachments_filetime; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_attachments_filetime ON public.phpbb3_attachments USING btree (filetime);


--
-- Name: phpbb3_attachments_is_orphan; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_attachments_is_orphan ON public.phpbb3_attachments USING btree (is_orphan);


--
-- Name: phpbb3_attachments_post_msg_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_attachments_post_msg_id ON public.phpbb3_attachments USING btree (post_msg_id);


--
-- Name: phpbb3_attachments_poster_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_attachments_poster_id ON public.phpbb3_attachments USING btree (poster_id);


--
-- Name: phpbb3_attachments_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_attachments_topic_id ON public.phpbb3_attachments USING btree (topic_id);


--
-- Name: phpbb3_banlist_ban_email; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_banlist_ban_email ON public.phpbb3_banlist USING btree (ban_email, ban_exclude);


--
-- Name: phpbb3_banlist_ban_end; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_banlist_ban_end ON public.phpbb3_banlist USING btree (ban_end);


--
-- Name: phpbb3_banlist_ban_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_banlist_ban_ip ON public.phpbb3_banlist USING btree (ban_ip, ban_exclude);


--
-- Name: phpbb3_banlist_ban_user; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_banlist_ban_user ON public.phpbb3_banlist USING btree (ban_userid, ban_exclude);


--
-- Name: phpbb3_bbcodes_display_on_post; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_bbcodes_display_on_post ON public.phpbb3_bbcodes USING btree (display_on_posting);


--
-- Name: phpbb3_bots_bot_active; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_bots_bot_active ON public.phpbb3_bots USING btree (bot_active);


--
-- Name: phpbb3_captcha_answers_qid; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_captcha_answers_qid ON public.phpbb3_captcha_answers USING btree (question_id);


--
-- Name: phpbb3_captcha_questions_lang; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_captcha_questions_lang ON public.phpbb3_captcha_questions USING btree (lang_iso);


--
-- Name: phpbb3_config_is_dynamic; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_config_is_dynamic ON public.phpbb3_config USING btree (is_dynamic);


--
-- Name: phpbb3_confirm_confirm_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_confirm_confirm_type ON public.phpbb3_confirm USING btree (confirm_type);


--
-- Name: phpbb3_drafts_save_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_drafts_save_time ON public.phpbb3_drafts USING btree (save_time);


--
-- Name: phpbb3_ext_ext_name; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_ext_ext_name ON public.phpbb3_ext USING btree (ext_name);


--
-- Name: phpbb3_forums_forum_lastpost_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_forums_forum_lastpost_id ON public.phpbb3_forums USING btree (forum_last_post_id);


--
-- Name: phpbb3_forums_left_right_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_forums_left_right_id ON public.phpbb3_forums USING btree (left_id, right_id);


--
-- Name: phpbb3_forums_watch_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_forums_watch_forum_id ON public.phpbb3_forums_watch USING btree (forum_id);


--
-- Name: phpbb3_forums_watch_notify_stat; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_forums_watch_notify_stat ON public.phpbb3_forums_watch USING btree (notify_status);


--
-- Name: phpbb3_forums_watch_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_forums_watch_user_id ON public.phpbb3_forums_watch USING btree (user_id);


--
-- Name: phpbb3_groups_group_legend_name; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_groups_group_legend_name ON public.phpbb3_groups USING btree (group_legend, group_name);


--
-- Name: phpbb3_icons_display_on_posting; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_icons_display_on_posting ON public.phpbb3_icons USING btree (display_on_posting);


--
-- Name: phpbb3_lang_lang_iso; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_lang_lang_iso ON public.phpbb3_lang USING btree (lang_iso);


--
-- Name: phpbb3_log_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_forum_id ON public.phpbb3_log USING btree (forum_id);


--
-- Name: phpbb3_log_log_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_log_time ON public.phpbb3_log USING btree (log_time);


--
-- Name: phpbb3_log_log_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_log_type ON public.phpbb3_log USING btree (log_type);


--
-- Name: phpbb3_log_reportee_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_reportee_id ON public.phpbb3_log USING btree (reportee_id);


--
-- Name: phpbb3_log_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_topic_id ON public.phpbb3_log USING btree (topic_id);


--
-- Name: phpbb3_log_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_log_user_id ON public.phpbb3_log USING btree (user_id);


--
-- Name: phpbb3_login_attempts_att_for; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_login_attempts_att_for ON public.phpbb3_login_attempts USING btree (attempt_forwarded_for, attempt_time);


--
-- Name: phpbb3_login_attempts_att_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_login_attempts_att_ip ON public.phpbb3_login_attempts USING btree (attempt_ip, attempt_time);


--
-- Name: phpbb3_login_attempts_att_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_login_attempts_att_time ON public.phpbb3_login_attempts USING btree (attempt_time);


--
-- Name: phpbb3_login_attempts_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_login_attempts_user_id ON public.phpbb3_login_attempts USING btree (user_id);


--
-- Name: phpbb3_moderator_cache_disp_idx; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_moderator_cache_disp_idx ON public.phpbb3_moderator_cache USING btree (display_on_index);


--
-- Name: phpbb3_moderator_cache_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_moderator_cache_forum_id ON public.phpbb3_moderator_cache USING btree (forum_id);


--
-- Name: phpbb3_modules_class_left_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_modules_class_left_id ON public.phpbb3_modules USING btree (module_class, left_id);


--
-- Name: phpbb3_modules_left_right_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_modules_left_right_id ON public.phpbb3_modules USING btree (left_id, right_id);


--
-- Name: phpbb3_modules_module_enabled; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_modules_module_enabled ON public.phpbb3_modules USING btree (module_enabled);


--
-- Name: phpbb3_notification_types_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_notification_types_type ON public.phpbb3_notification_types USING btree (notification_type_name);


--
-- Name: phpbb3_notifications_item_ident; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_notifications_item_ident ON public.phpbb3_notifications USING btree (notification_type_id, item_id);


--
-- Name: phpbb3_notifications_user; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_notifications_user ON public.phpbb3_notifications USING btree (user_id, notification_read);


--
-- Name: phpbb3_oauth_states_provider; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_oauth_states_provider ON public.phpbb3_oauth_states USING btree (provider);


--
-- Name: phpbb3_oauth_states_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_oauth_states_user_id ON public.phpbb3_oauth_states USING btree (user_id);


--
-- Name: phpbb3_oauth_tokens_provider; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_oauth_tokens_provider ON public.phpbb3_oauth_tokens USING btree (provider);


--
-- Name: phpbb3_oauth_tokens_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_oauth_tokens_user_id ON public.phpbb3_oauth_tokens USING btree (user_id);


--
-- Name: phpbb3_poll_options_poll_opt_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_poll_options_poll_opt_id ON public.phpbb3_poll_options USING btree (poll_option_id);


--
-- Name: phpbb3_poll_options_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_poll_options_topic_id ON public.phpbb3_poll_options USING btree (topic_id);


--
-- Name: phpbb3_poll_votes_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_poll_votes_topic_id ON public.phpbb3_poll_votes USING btree (topic_id);


--
-- Name: phpbb3_poll_votes_vote_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_poll_votes_vote_user_id ON public.phpbb3_poll_votes USING btree (vote_user_id);


--
-- Name: phpbb3_poll_votes_vote_user_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_poll_votes_vote_user_ip ON public.phpbb3_poll_votes USING btree (vote_user_ip);


--
-- Name: phpbb3_posts_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_forum_id ON public.phpbb3_posts USING btree (forum_id);


--
-- Name: phpbb3_posts_french_post_content; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_french_post_content ON public.phpbb3_posts USING gin (to_tsvector('french'::regconfig, ((post_text || ' '::text) || (post_subject)::text)));


--
-- Name: phpbb3_posts_french_post_subject; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_french_post_subject ON public.phpbb3_posts USING gin (to_tsvector('french'::regconfig, (post_subject)::text));


--
-- Name: phpbb3_posts_post_username; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_post_username ON public.phpbb3_posts USING btree (post_username);


--
-- Name: phpbb3_posts_post_visibility; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_post_visibility ON public.phpbb3_posts USING btree (post_visibility);


--
-- Name: phpbb3_posts_poster_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_poster_id ON public.phpbb3_posts USING btree (poster_id);


--
-- Name: phpbb3_posts_poster_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_poster_ip ON public.phpbb3_posts USING btree (poster_ip);


--
-- Name: phpbb3_posts_tid_post_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_tid_post_time ON public.phpbb3_posts USING btree (topic_id, post_time);


--
-- Name: phpbb3_posts_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_posts_topic_id ON public.phpbb3_posts USING btree (topic_id);


--
-- Name: phpbb3_privmsgs_author_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_author_id ON public.phpbb3_privmsgs USING btree (author_id);


--
-- Name: phpbb3_privmsgs_author_ip; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_author_ip ON public.phpbb3_privmsgs USING btree (author_ip);


--
-- Name: phpbb3_privmsgs_folder_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_folder_user_id ON public.phpbb3_privmsgs_folder USING btree (user_id);


--
-- Name: phpbb3_privmsgs_message_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_message_time ON public.phpbb3_privmsgs USING btree (message_time);


--
-- Name: phpbb3_privmsgs_root_level; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_root_level ON public.phpbb3_privmsgs USING btree (root_level);


--
-- Name: phpbb3_privmsgs_rules_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_rules_user_id ON public.phpbb3_privmsgs_rules USING btree (user_id);


--
-- Name: phpbb3_privmsgs_to_author_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_to_author_id ON public.phpbb3_privmsgs_to USING btree (author_id);


--
-- Name: phpbb3_privmsgs_to_msg_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_to_msg_id ON public.phpbb3_privmsgs_to USING btree (msg_id);


--
-- Name: phpbb3_privmsgs_to_usr_flder_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_privmsgs_to_usr_flder_id ON public.phpbb3_privmsgs_to USING btree (user_id, folder_id);


--
-- Name: phpbb3_profile_fields_fld_ordr; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_profile_fields_fld_ordr ON public.phpbb3_profile_fields USING btree (field_order);


--
-- Name: phpbb3_profile_fields_fld_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_profile_fields_fld_type ON public.phpbb3_profile_fields USING btree (field_type);


--
-- Name: phpbb3_qa_confirm_lookup; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_qa_confirm_lookup ON public.phpbb3_qa_confirm USING btree (confirm_id, session_id, lang_iso);


--
-- Name: phpbb3_qa_confirm_session_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_qa_confirm_session_id ON public.phpbb3_qa_confirm USING btree (session_id);


--
-- Name: phpbb3_reports_pm_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_reports_pm_id ON public.phpbb3_reports USING btree (pm_id);


--
-- Name: phpbb3_reports_post_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_reports_post_id ON public.phpbb3_reports USING btree (post_id);


--
-- Name: phpbb3_search_wordlist_wrd_cnt; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_search_wordlist_wrd_cnt ON public.phpbb3_search_wordlist USING btree (word_count);


--
-- Name: phpbb3_search_wordlist_wrd_txt; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_search_wordlist_wrd_txt ON public.phpbb3_search_wordlist USING btree (word_text);


--
-- Name: phpbb3_search_wordmatch_post_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_search_wordmatch_post_id ON public.phpbb3_search_wordmatch USING btree (post_id);


--
-- Name: phpbb3_search_wordmatch_un_mtch; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_search_wordmatch_un_mtch ON public.phpbb3_search_wordmatch USING btree (word_id, post_id, title_match);


--
-- Name: phpbb3_search_wordmatch_word_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_search_wordmatch_word_id ON public.phpbb3_search_wordmatch USING btree (word_id);


--
-- Name: phpbb3_sessions_keys_last_login; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_sessions_keys_last_login ON public.phpbb3_sessions_keys USING btree (last_login);


--
-- Name: phpbb3_sessions_session_fid; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_sessions_session_fid ON public.phpbb3_sessions USING btree (session_forum_id);


--
-- Name: phpbb3_sessions_session_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_sessions_session_time ON public.phpbb3_sessions USING btree (session_time);


--
-- Name: phpbb3_sessions_session_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_sessions_session_user_id ON public.phpbb3_sessions USING btree (session_user_id);


--
-- Name: phpbb3_smilies_display_on_post; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_smilies_display_on_post ON public.phpbb3_smilies USING btree (display_on_posting);


--
-- Name: phpbb3_styles_style_name; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_styles_style_name ON public.phpbb3_styles USING btree (style_name);


--
-- Name: phpbb3_topics_fid_time_moved; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_fid_time_moved ON public.phpbb3_topics USING btree (forum_id, topic_last_post_time, topic_moved_id);


--
-- Name: phpbb3_topics_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_forum_id ON public.phpbb3_topics USING btree (forum_id);


--
-- Name: phpbb3_topics_forum_id_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_forum_id_type ON public.phpbb3_topics USING btree (forum_id, topic_type);


--
-- Name: phpbb3_topics_forum_vis_last; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_forum_vis_last ON public.phpbb3_topics USING btree (forum_id, topic_visibility, topic_last_post_id);


--
-- Name: phpbb3_topics_last_post_time; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_last_post_time ON public.phpbb3_topics USING btree (topic_last_post_time);


--
-- Name: phpbb3_topics_topic_visibility; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_topic_visibility ON public.phpbb3_topics USING btree (topic_visibility);


--
-- Name: phpbb3_topics_track_forum_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_track_forum_id ON public.phpbb3_topics_track USING btree (forum_id);


--
-- Name: phpbb3_topics_track_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_track_topic_id ON public.phpbb3_topics_track USING btree (topic_id);


--
-- Name: phpbb3_topics_watch_notify_stat; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_watch_notify_stat ON public.phpbb3_topics_watch USING btree (notify_status);


--
-- Name: phpbb3_topics_watch_topic_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_watch_topic_id ON public.phpbb3_topics_watch USING btree (topic_id);


--
-- Name: phpbb3_topics_watch_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_topics_watch_user_id ON public.phpbb3_topics_watch USING btree (user_id);


--
-- Name: phpbb3_user_group_group_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_user_group_group_id ON public.phpbb3_user_group USING btree (group_id);


--
-- Name: phpbb3_user_group_group_leader; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_user_group_group_leader ON public.phpbb3_user_group USING btree (group_leader);


--
-- Name: phpbb3_user_group_user_id; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_user_group_user_id ON public.phpbb3_user_group USING btree (user_id);


--
-- Name: phpbb3_users_user_birthday; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_users_user_birthday ON public.phpbb3_users USING btree (user_birthday);


--
-- Name: phpbb3_users_user_email_hash; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_users_user_email_hash ON public.phpbb3_users USING btree (user_email_hash);


--
-- Name: phpbb3_users_user_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX phpbb3_users_user_type ON public.phpbb3_users USING btree (user_type);


--
-- Name: phpbb3_users_username_clean; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE UNIQUE INDEX phpbb3_users_username_clean ON public.phpbb3_users USING btree (username_clean);


--
-- Name: points_altitude; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_altitude ON public.points USING btree (altitude);


--
-- Name: points_ferme; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_ferme ON public.points USING btree (conditions_utilisation);


--
-- Name: points_geom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_geom ON public.points USING gist (geom);


--
-- Name: points_id_point_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_id_point_type ON public.points USING btree (id_point_type);


--
-- Name: points_id_type_precision_gps; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_id_type_precision_gps ON public.points USING btree (id_type_precision_gps);


--
-- Name: points_modele; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_modele ON public.points USING btree (modele);


--
-- Name: points_nom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_nom ON public.points USING btree (nom);


--
-- Name: points_places; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_places ON public.points USING btree (places);


--
-- Name: points_places_matelas; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX points_places_matelas ON public.points USING btree (places_matelas);


--
-- Name: polygone_type_ordre_taille; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygone_type_ordre_taille ON public.polygone_type USING btree (ordre_taille);


--
-- Name: polygones_geom; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_geom ON public.polygones USING gist (geom);


--
-- Name: polygones_id_polygone_type; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_id_polygone_type ON public.polygones USING btree (id_polygone_type);


--
-- Name: polygones_nom_polygone; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX polygones_nom_polygone ON public.polygones USING btree (nom_polygone);


--
-- Name: type_precision_gps_ordre; Type: INDEX; Schema: public; Owner: refuges; Tablespace: 
--

CREATE INDEX type_precision_gps_ordre ON public.type_precision_gps USING btree (ordre);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

