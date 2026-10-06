-- Le champ désigne le modérateur actuel de la fiche (celui qui a les droits dessus), plus forcément son créateur
ALTER TABLE points RENAME COLUMN id_createur TO id_moderateur;
