ALTER TABLE trace_requettes
ADD post character varying(8000) DEFAULT '',
ADD files character varying(8000) DEFAULT '',
ADD duree integer DEFAULT '0';
ALTER TABLE trace_requettes add CONSTRAINT trace_requettes_duree_check CHECK (duree >= 0);
CREATE INDEX trace_requettes_appel ON trace_requettes (appel);
CREATE INDEX trace_requettes_duree ON trace_requettes (duree);
