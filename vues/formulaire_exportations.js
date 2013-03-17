
/************************
/* 23/02/08 jmb passage en getElementById pour une meilleure compatibilité inter browser */
/* et pour etre conforme XHTML1 */


/* reecriture maison pour decocher les check du meme parent */
/* parametre:
-- id du conteneur (sans doute un fieldset)
-- valeur des INPUT */
function checkboites( elem, valeur )
{
    var boites = document.getElementById(elem).getElementsByTagName('input');
    for ( var i=0; i < boites.length; i++ )
        boites[i].checked = valeur ;
}
