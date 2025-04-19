/**
 * Abstract class to be used by other control buttons definitions
 * Add some usefull controls with displayed buttons
 */
//BEST redesign button hover & touch
//BEST click sur in/out file / ...

import Control from 'ol/control/Control';

import './button.css';

class Button extends Control {
  constructor(opt) {
    const options = {
      label: ' ', // An ascii or unicode character to decorate the button (OR : css button::after)
      className: '', // To be added to the control.element

      // Sub menu, by priority :
      // subMenuId : 'id', // Html id-fr or Id containing the scrolling menu
      // subMenuHTMLfr: '', // html code of the scrolling menu in locale lang
      subMenuHTML: '', // html code of the scrolling menu
      // title: '', // html title for button hovering by a mouse
      // buttonAction() {}, // (evt, active) To run when an <input> ot <a> of the subMenu is clicked / hovered, ...
      // subMenuAction() {}, // (evt) To run when the button is clicked / hovered, ...

      // All ol.control.Control options

      ...opt,
    };

    super({
      element: document.createElement('div'),
      ...options,
    });

    this.options = options;

    if (options.buttonAction) this.buttonAction = options.buttonAction;
    if (options.subMenuAction) this.subMenuAction = options.subMenuAction;

    // Create a button
    this.buttonEl = document.createElement('button');
    this.buttonEl.setAttribute('type', 'button');
    this.buttonEl.innerHTML = options.label;
    if (options.title)
      this.buttonEl.setAttribute('title', options.title);

    // Add submenu below the button
    this.subMenuEl =
      document.getElementById(options.subMenuId + '-' + navigator.language.match(/[a-z]+/u)) ||
      document.getElementById(options.subMenuId) ||
      document.createElement('div');
    this.subMenuEl.innerHTML ||=
      options['subMenuHTML' + navigator.language.match(/[a-z]+/u)] ||
      options.subMenuHTML;

    // Populate the control
    this.element.className = 'ol-control myol-button ' + options.className;
    this.element.appendChild(this.buttonEl); // Add the button
    this.element.appendChild(this.subMenuEl); // Add the submenu
  }

  setMap(map) {
    // Add listeners to the buttons
    this.element.addEventListener('mouseover', evt => this.buttonListener(evt));
    this.element.addEventListener('mouseout', evt => this.buttonListener(evt));
    this.buttonEl.addEventListener('click', evt => this.buttonListener(evt));

    // Add listeners in the sub-menus
    this.subMenuEl.querySelectorAll('a, input')
      .forEach(el => ['click', 'change'].forEach(type =>
        el.addEventListener(type, evt =>
          this.subMenuAction(evt)
        )));

    // Close the sub-menu when click or touch the map
    map.on('click', () => this.element.classList.remove('myol-button-selected'));

    return super.setMap(map);
  }

  buttonListener(evt) {
    if (evt.type === 'mouseover')
      this.element.classList.add('myol-button-hover');
    else // mouseout | click
      this.element.classList.remove('myol-button-hover');

    if (evt.type === 'click') // Mouse click & touch
      this.element.classList.toggle('myol-button-selected');

    // Close other open buttons
    for (const el of document.getElementsByClassName('myol-button'))
      if (el !== this.element && evt.type === 'click')
        el.classList.remove('myol-button-selected');

    // Trigger action on the selected button
    this.buttonAction(evt, this.element.classList.contains('myol-button-selected'));
  }

  buttonAction() {}

  subMenuAction() {}
}

export default Button;