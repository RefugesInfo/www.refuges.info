#Possiblement avant pour forcer à être valide, en acceptant les pertes que cela peut occasioner :
#update polygones set geom=st_makevalid(geom);

ALTER TABLE polygones ADD CONSTRAINT enforce_valid_geom CHECK (st_isvalid(geom));