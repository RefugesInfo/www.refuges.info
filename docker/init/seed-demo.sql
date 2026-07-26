-- =====================================================================
--  Jeu de données de DÉMO pour l'instance locale de www.refuges.info
--  Objectif : peupler une base vide avec des massifs, des points et des
--  commentaires plausibles pour rendre le site présentable en local.
--
--  Données 100 % fictives (noms inventés) — aucun lien avec les vraies
--  fiches du site. Rejouable : tout est nettoyé via des sentinelles
--  (id_createur = 424242 pour points/commentaires, source = 'seed-demo'
--  pour les polygones) avant réinsertion.
--
--  Chargé par `make seed`. Géométries en lon/lat (SRID 0, comme la base).
-- =====================================================================

BEGIN;

-- --- Nettoyage d'un éventuel passage précédent -----------------------
DELETE FROM commentaires WHERE id_createur_commentaire = 424242;
DELETE FROM points       WHERE id_createur = 424242;
DELETE FROM polygones    WHERE source = 'seed-demo';

-- --- Massifs (id_polygone_type = 1) ----------------------------------
INSERT INTO polygones (id_polygone_type, nom_polygone, article_partitif, source, geom) VALUES
 (1, 'Vercors',    'du', 'seed-demo', ST_GeomFromText('POLYGON((5.20 44.80,5.65 44.80,5.65 45.22,5.20 45.22,5.20 44.80))')),
 (1, 'Chartreuse', 'de la','seed-demo', ST_GeomFromText('POLYGON((5.68 45.24,5.98 45.24,5.98 45.48,5.68 45.48,5.68 45.24))')),
 (1, 'Écrins',     'des','seed-demo', ST_GeomFromText('POLYGON((6.10 44.75,6.55 44.75,6.55 45.05,6.10 45.05,6.10 44.75))')),
 (1, 'Mont-Blanc', 'du', 'seed-demo', ST_GeomFromText('POLYGON((6.78 45.75,7.06 45.75,7.06 45.96,6.78 45.96,6.78 45.75))')),
 (1, 'Couserans',  'du', 'seed-demo', ST_GeomFromText('POLYGON((1.05 42.62,1.55 42.62,1.55 42.92,1.05 42.92,1.05 42.62))'));

-- --- Grandes zones couvertes (id_polygone_type = 11) -----------------
INSERT INTO polygones (id_polygone_type, nom_polygone, article_partitif, source, geom) VALUES
 (11, 'Alpes',    'des', 'seed-demo', ST_GeomFromText('POLYGON((5.0 43.5,7.7 43.5,7.7 46.5,5.0 46.5,5.0 43.5))')),
 (11, 'Pyrénées', 'des', 'seed-demo', ST_GeomFromText('POLYGON((-1.8 42.3,3.0 42.3,3.0 43.3,-1.8 43.3,-1.8 42.3))'));

-- --- Points ----------------------------------------------------------
-- Colonnes : nom, type, altitude, remark, acces, proprio, places,
-- places_matelas, conditions, manque_un_mur, cheminee, poele,
-- couvertures, latrines, bois, eau, cache, modele, nom_createur,
-- id_createur (=424242 sentinelle), precision_gps, dates, geom
INSERT INTO points
 (nom, id_point_type, altitude, remark, acces, proprio, places, places_matelas,
  conditions_utilisation, manque_un_mur, cheminee, poele, couvertures, latrines,
  bois_a_proximite, eau_a_proximite, cache, modele, nom_createur, id_createur,
  id_type_precision_gps, date_creation, date_derniere_modification, geom)
VALUES
 ('Cabane des Vernes',        7, 1620, 'Petite cabane en pierre bien entretenue, table et banc à l''intérieur.', 'Depuis le hameau des Vernes, sentier balisé jaune, 1h30 de montée.', 'ONF', 6, 4, 'ouverture', false, false, true,  true,  true,  true,  true,  false, 0, 'Camille R.', 424242, 1, now()-interval '4 days',  now()-interval '4 days',  ST_GeomFromText('POINT(5.38 44.95)')),
 ('Refuge du Pas de l''Aiguille',10,1780,'Refuge gardé l''été, réservation conseillée en saison.', 'Depuis le col de Rousset, GR93 direction sud, 2h.', 'Association du Vercors', 34, 34, 'ouverture', false, false, true, true, true, false, true, false, 0, 'Léa M.', 424242, 8, now()-interval '9 days', now()-interval '2 days', ST_GeomFromText('POINT(5.47 44.86)')),
 ('Fontaine de Corrençon',   23, 1150, 'Source aménagée, eau potable toute l''année.', 'Au bord du sentier des crêtes, 20 min du parking.', NULL, 0, 0, 'ouverture', false, false, false, false, false, false, true, false, 0, 'Yann B.', 424242, 1, now()-interval '1 day', now()-interval '1 day', ST_GeomFromText('POINT(5.55 45.03)')),
 ('Cabane de la Grande Cournouse',7,1840,'Abri sommaire, un seul bat-flanc, pas de poêle. Dépannage uniquement.', 'Montée raide depuis Saint-Agnan, compter 3h.', NULL, 3, 0, 'ouverture', true, false, false, false, false, true, false, false, 0, 'Camille R.', 424242, 4, now()-interval '15 days', now()-interval '15 days', ST_GeomFromText('POINT(5.30 45.10)')),

 ('Cabane du Charmant Som',   7, 1650, 'Belle cabane rénovée en 2021, poêle à bois fonctionnel.', 'Depuis le parking du Charmant Som, 45 min.', 'Commune de Saint-Pierre-de-Chartreuse', 8, 6, 'ouverture', false, true, true, true, true, true, true, false, 0, 'Noé T.', 424242, 1, now()-interval '6 days', now()-interval '3 days', ST_GeomFromText('POINT(5.79 45.34)')),
 ('Gîte de la Ruchère',       9, 980,  'Gîte d''étape sur le tour de Chartreuse, demi-pension possible.', 'Accessible en voiture jusqu''au hameau de la Ruchère.', 'Famille Deville', 22, 0, 'ouverture', false, false, true, true, true, false, true, false, 0, 'Léa M.', 424242, 8, now()-interval '20 days', now()-interval '5 days', ST_GeomFromText('POINT(5.72 45.37)')),
 ('Lac du Grand Crozet',     16, 1970, 'Lac d''altitude, baignade fraîche possible en été.', 'Sentier depuis le col de Porte, 2h30.', NULL, 0, 0, 'ouverture', false, false, false, false, false, false, true, false, 0, 'Yann B.', 424242, 7, now()-interval '11 days', now()-interval '11 days', ST_GeomFromText('POINT(5.85 45.30)')),

 ('Refuge du Glacier Blanc', 10, 2542, 'Refuge gardé CAF, étape classique vers la Barre des Écrins.', 'Depuis le Pré de Madame Carle, 2h15 de montée.', 'CAF Briançon', 90, 90, 'ouverture', false, false, true, true, true, false, true, false, 0, 'Sofia L.', 424242, 8, now()-interval '30 days', now()-interval '7 days', ST_GeomFromText('POINT(6.36 44.92)')),
 ('Cabane de l''Alpe du Villar',7,2010,'Cabane de berger laissée ouverte hors estive, propre.', 'Longue approche depuis Villar-d''Arêne, 3h30.', 'Groupement pastoral', 4, 2, 'ouverture', false, false, true, true, false, false, true, false, 0, 'Noé T.', 424242, 4, now()-interval '18 days', now()-interval '18 days', ST_GeomFromText('POINT(6.28 45.02)')),
 ('Passage de la Brèche Nord', 3, 3200, 'Passage exposé, corde et crampons nécessaires selon conditions.', 'Depuis le refuge, suivre la trace vers l''arête.', NULL, 0, 0, 'ouverture', false, false, false, false, false, false, false, false, 0, 'Sofia L.', 424242, 7, now()-interval '25 days', now()-interval '25 days', ST_GeomFromText('POINT(6.42 44.88)')),

 ('Refuge de Tré-la-Tête',   10, 1970, 'Grand refuge du massif du Mont-Blanc, très fréquenté l''été.', 'Depuis les Contamines, 2h30 par le sentier du Nant Borrant.', 'FFCAM', 130, 130, 'ouverture', false, false, true, true, true, false, true, false, 0, 'Émile D.', 424242, 8, now()-interval '40 days', now()-interval '10 days', ST_GeomFromText('POINT(6.82 45.80)')),
 ('Cabane du Plan Jovet',     7, 2050, 'Petit abri en bois, vue sur les Dômes de Miage.', 'Variante depuis le refuge de Tré-la-Tête, 1h.', NULL, 4, 4, 'ouverture', false, false, true, true, false, true, true, false, 0, 'Émile D.', 424242, 4, now()-interval '12 days', now()-interval '12 days', ST_GeomFromText('POINT(6.86 45.83)')),
 ('Sommet du Mont Tondu',     6, 3196, 'Beau sommet facile d''accès depuis le glacier, panorama à 360°.', 'Course de neige PD depuis le refuge des Conscrits.', NULL, 0, 0, 'ouverture', false, false, false, false, false, false, false, false, 0, 'Sofia L.', 424242, 7, now()-interval '35 days', now()-interval '35 days', ST_GeomFromText('POINT(6.79 45.78)')),

 ('Cabane d''Aula',           7, 1520, 'Cabane pastorale du Couserans, ouverte, deux pièces.', 'Depuis le pont de la Taule, sentier de l''étang, 2h.', 'Commune de Seix', 6, 4, 'ouverture', false, true, true,  true, false, true, true, false, 0, 'Manon F.', 424242, 1, now()-interval '8 days', now()-interval '8 days', ST_GeomFromText('POINT(1.18 42.78)')),
 ('Refuge des Estagnous',    10, 2245, 'Refuge gardé au pied du Mont Valier, réservation obligatoire.', 'Depuis le Pla de la Lau, 3h de montée régulière.', 'Département de l''Ariège', 60, 60, 'ouverture', false, false, true, true, true, false, true, false, 0, 'Manon F.', 424242, 8, now()-interval '22 days', now()-interval '4 days', ST_GeomFromText('POINT(1.10 42.80)')),
 ('Étang Long du Couserans', 16, 1920, 'Grand étang de montagne, bivouac autorisé à distance.', 'Sentier depuis la cabane d''Aula, 1h30.', NULL, 0, 0, 'ouverture', false, false, false, false, false, false, true, false, 0, 'Yann B.', 424242, 7, now()-interval '14 days', now()-interval '14 days', ST_GeomFromText('POINT(1.22 42.83)')),
 ('Cabane du Taus',           7, 1685, 'Abri en cours de rénovation, toit refait en 2023.', 'Montée depuis Aulus-les-Bains, 2h45.', 'ONF', 5, 2, 'ouverture', false, false, false, true, false, true, true, false, 0, 'Manon F.', 424242, 4, now()-interval '3 days', now()-interval '3 days', ST_GeomFromText('POINT(1.35 42.75)')),
 ('Bâtiment EDF de la Vanne', 28, 1420, 'Ancien local technique, non entretenu, à éviter par mauvais temps.', 'Le long de la conduite forcée.', 'EDF', 0, 0, 'inutilisable', true, false, false, false, false, false, false, false, 0, 'Noé T.', 424242, 4, now()-interval '50 days', now()-interval '50 days', ST_GeomFromText('POINT(1.42 42.70)'));

-- --- Commentaires (rattachés aux points par leur nom) ----------------
-- photo_existe = 0 : pas de fichier image en local, on n'affiche pas de vignette.
INSERT INTO commentaires (id_point, texte, auteur_commentaire, date, photo_existe, id_createur_commentaire)
SELECT id_point, txt, aut, dt, 0, 424242 FROM points, (VALUES
  ('Cabane des Vernes',        'Nuit très calme, cabane propre. Pensez à ramener vos déchets, il n''y a pas de poubelle.', 'randonneur38', now()-interval '3 days'),
  ('Cabane des Vernes',        'Le poêle tire bien, prévoir du petit bois car il n''y en avait plus.', 'Clara', now()-interval '10 days'),
  ('Refuge du Pas de l''Aiguille','Accueil sympa du gardien, repas copieux. Réservez tôt en août.', 'marcheur_du_sud', now()-interval '2 days'),
  ('Cabane du Charmant Som',   'Superbe rénovation, on a passé une nuit parfaite avec vue sur le lever de soleil.', 'Thomas', now()-interval '5 days'),
  ('Cabane du Charmant Som',   'Attention : beaucoup de monde le week-end, arrivez tôt pour avoir de la place.', 'Isa', now()-interval '18 days'),
  ('Refuge du Glacier Blanc',  'Étape incontournable avant la Barre. Eau courante non potable, à traiter.', 'alpiniste73', now()-interval '7 days'),
  ('Cabane de l''Alpe du Villar','Trouvée ouverte fin septembre, quelques souris mais rien de grave.', 'Greg', now()-interval '16 days'),
  ('Refuge de Tré-la-Tête',    'Refuge immense et bien organisé. Sanitaires corrects. Belle terrasse.', 'famille_rando', now()-interval '9 days'),
  ('Cabane d''Aula',           'Cadre magnifique au bord de l''étang. Cheminée fonctionnelle, bois sur place.', 'pyreneen09', now()-interval '6 days'),
  ('Refuge des Estagnous',     'Vue exceptionnelle sur le Valier. Gardien de bon conseil pour la course du lendemain.', 'Sandra', now()-interval '4 days')
) AS c(pnom, txt, aut, dt)
WHERE points.nom = c.pnom AND points.id_createur = 424242;

COMMIT;

-- --- Récapitulatif ---------------------------------------------------
SELECT
  (SELECT count(*) FROM points      WHERE id_createur = 424242) AS points_demo,
  (SELECT count(*) FROM polygones   WHERE source = 'seed-demo') AS polygones_demo,
  (SELECT count(*) FROM commentaires WHERE id_createur_commentaire = 424242) AS commentaires_demo;
