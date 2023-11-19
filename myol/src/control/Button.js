/**
 * Button.js
 * Add some usefull controls with buttons
 */

import ol from '../ol';
import './Button.css';

/**
 * Control button
 * Abstract class to be used by other control buttons definitions
 */
export class Button extends ol.control.Control {
  constructor(options) {
    options = {
      label: ' ', // An ascii or unicode character to decorate the button (OR : css button::after)
      className: '', // To be added to the control.element

      // Sub menu, by priority :
      // subMenuId : 'id', // Html id-fr or Id containing the scrolling menu
      // subMenuHTML_fr: '', // html code of the scrolling menu in locale lang
      subMenuHTML: '', // html code of the scrolling menu

      // subMenuAction() {}, // (evt) To run when the button is clicked / hovered, ...
      // buttonAction() {}, // (evt) To run when an <input> ot <a> of the subMenu is clicked / hovered, ...

      // All ol.control.Control options

      ...options,
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

    // Add submenu below the button
    this.subMenuEl =
      document.getElementById(options.subMenuId + '-' + navigator.language.match(/[a-z]+/)) ||
      document.getElementById(options.subMenuId) ||
      document.createElement('div');
    this.subMenuEl.innerHTML ||=
      options['subMenuHTML_' + navigator.language.match(/[a-z]+/)] ||
      options.subMenuHTML;

    // Populate the control
    this.element.className = 'ol-control myol-button ' + options.className;
    this.element.appendChild(this.buttonEl); // Add the button
    this.element.appendChild(this.subMenuEl); // Add the submenu
  }

  setMap(map) {
    // Register action listeners when html is fully loaded
    this.buttonEl.addEventListener('click', evt => this.buttonListener(evt));
    this.element.addEventListener('mouseover', evt => this.buttonListener(evt));
    this.element.addEventListener('mouseout', evt => this.buttonListener(evt));

    // Close the submenu when click or touch on the map
    document.addEventListener('click', evt => {
      const el = document.elementFromPoint(evt.x, evt.y);

      if (el && el.tagName == 'CANVAS')
        this.element.classList.remove('myol-button-selected');
    });

    this.subMenuEl.querySelectorAll('a, input')
      .forEach(el => ['click', 'change'].forEach(tag =>
        el.addEventListener(tag, evt =>
          this.subMenuAction(evt)
        )));

    return super.setMap(map);
  }

  buttonListener(evt) {
    this.buttonAction(evt);

    if (evt.type == 'mouseover')
      this.element.classList.add('myol-button-hover');
    else // mouseout | click
      this.element.classList.remove('myol-button-hover');

    if (evt.type == 'click') // Mouse click & touch
      this.element.classList.toggle('myol-button-selected');

    // Close other open buttons
    for (let el of document.getElementsByClassName('myol-button'))
      if (el != this.element)
        el.classList.remove('myol-button-selected');
  }

  buttonAction() {}

  subMenuAction() {}
}

export default Button;