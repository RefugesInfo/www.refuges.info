
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

/**
 * Checks/unchecks a list of chekbox
 *
 * @param   string   the form name
 * @param   boolean  whether to check or to uncheck the element
 * @element string   the name of the array of elements ( ex: toto[] )
 * @return  boolean  always true
 */
 /*
function setCheckboxes(the_form, do_check, element)
{
    var elts      = (typeof(document.getElementById(the_form).elements[element]) != 'undefined')
                  ? document.getElementById(the_form).elements[element]
                  : (typeof(document.getElementById(the_form).elements[element]) != 'undefined')
          ? document.getElementById(the_form).elements[element]
          : document.getElementById(the_form).elements[element];
    var elts_cnt  = (typeof(elts.length) != 'undefined')
                  ? elts.length
                  : 0;

    if (elts_cnt) {
        for (var i = 0; i < elts_cnt; i++) {
            elts[i].checked = do_check;
        } // end for
    } else {
        elts.checked        = do_check;
    } // end if... else

    return true;
} // end of the 'setCheckboxes()' function
*/