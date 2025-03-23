const cfaEl = document.getElementById('check_form_activity');

if (cfaEl) {
	cfaEl.value = 'machine avec javascript mais sans interaction';

	window.addEventListener('mousemove', () => {
		cfaEl.value = 'humain avec mouvement de souris ou tactile';
	});
}
