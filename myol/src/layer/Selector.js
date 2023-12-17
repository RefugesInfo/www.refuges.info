/**
 * Manage a collection of checkboxes with the same name
 * name : name of all the related input checkbox
 * The checkbox without value (all) check / uncheck the others
 * Check all the checkboxes check the checkbox without value (all)
 * Current selection is saved in window.localStorage
 * You can force the values in window.localStorage[simplified name]
 * callback(selection) : function to call at init or click
 * getSelection() : returns an array of selected values
 * If no name is specified or there are no checkbox with this name, return []
 */

export class Selector {
  constructor(name) {
    if (name) {
      this.safeName = 'myol_' + name.replace(/[^a-z]/ig, '');
      this.init = (localStorage[this.safeName] || '').split(',');
      this.selectEls = [...document.getElementsByName(name)];
      this.selectEls.forEach(el => {
        el.addEventListener('click', evt => this.action(evt));
        el.checked =
          this.init.includes(el.value) ||
          this.init.includes('all') ||
          this.init.join(',') == el.value;
      });
      this.action(); // Init with "all"
    }
    this.callbacks = [];
  }

  action(evt) {
    // Test the "all" box & set other boxes
    if (evt && evt.target.value == 'all')
      this.selectEls
      .forEach(el => el.checked = evt.target.checked);

    // Test if all values are checked
    const allChecked = this.selectEls
      .filter(el => !el.checked && el.value != 'all');

    // Set the "all" box
    this.selectEls
      .forEach(el => {
        if (el.value == 'all')
          el.checked = !allChecked.length;
      });

    // Save the current status
    if (this.safeName && this.getSelection().length)
      localStorage[this.safeName] = this.getSelection().join(',');
    //BEST BUG : don't recover values including a ,
    else
      delete localStorage[this.safeName];

    // Call the posted callbacks
    if (evt)
      this.callbacks.forEach(cb => cb(this.getSelection()));
  }

  getSelection() {
    if (this.selectEls)
      return this.selectEls
        .filter(el => el.checked && el.value != 'all')
        .map(el => el.value);

    return [null];
  }
}

export default Selector;