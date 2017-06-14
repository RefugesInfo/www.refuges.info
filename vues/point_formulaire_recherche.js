<?// Script lié à la page de modification de fiche

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config_wri les données communes à tout WRI

?>

	function show_boxes(el_name, coche) {
	var groupedecases = document.getElementsByName(el_name);
		switch (coche) {
			case true:
				for (var c=0 ; c<groupedecases.length ; c++ )
					groupedecases[c].style.display= 'inline';
				break;
			case false:
				for (var c=0 ; c<groupedecases.length ; c++ )
					groupedecases[c].style.display= 'none';
				break;
		}
	}
		