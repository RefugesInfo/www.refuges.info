-- Le type de point "grotte" (id 29) devient "abri naturel" (masculin : les articles changent aussi)
UPDATE point_type
SET nom_type = 'abri naturel',
    article_demonstratif = 'cet',
    article_defini = 'l''',
    article_partitif_point_type = 'd''un'
WHERE id_point_type = 29 AND nom_type = 'grotte';
