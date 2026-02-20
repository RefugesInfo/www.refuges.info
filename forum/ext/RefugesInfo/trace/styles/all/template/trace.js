// Add browser_operator field in contactform
document.getElementsByName('contact_subject').forEach(el => {
  el.insertAdjacentHTML(
    'afterend',
    '<input type="hidden" name="browser_operator" />'
  );
});

// Populate browser_operator check field
document.getElementsByName('mrk_browser_operator').forEach(el => {
  el.value = 'machine avec javascript mais sans interaction';

  window.addEventListener('mousemove', () => {
    el.value = 'humain avec mouvement de souris ou tactile';
  });

  // Add browser referer field
  const infos = Intl.DateTimeFormat().resolvedOptions();

  el.insertAdjacentHTML(
    'afterend',
    '<input type="hidden" name="mrk_browser_referer" value="' + document.referrer + '" />' +
    '<input type="hidden" name="mrk_browser_locale" value="' + infos.locale + '" />' +
    '<input type="hidden" name="mrk_browser_timezone" value="' + infos.timeZone + '" />'
  );
});

// Display edit form
const editEl = document.getElementById('edit-requete');

if (editEl)
  editEl.onclick = evt => {
    editEl.classList.add('edit-form');
  }

// Do not add empty parameters to the edit request
function submitEdited(evt) {
  document.querySelectorAll('#edit-requete input')
    .forEach(elInput => {
      if (!elInput.value)
        elInput.setAttribute('disabled', '');
    });
}