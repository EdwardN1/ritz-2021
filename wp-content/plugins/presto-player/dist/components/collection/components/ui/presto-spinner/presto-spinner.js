import { Component, h } from '@stencil/core';
export class PrestoSpinner {
  render() {
    return h("span", { part: "base", class: "spinner", "aria-busy": "true", "aria-live": "polite" });
  }
  static get is() { return "presto-player-spinner"; }
  static get encapsulation() { return "shadow"; }
  static get originalStyleUrls() { return {
    "$": ["presto-spinner.scss"]
  }; }
  static get styleUrls() { return {
    "$": ["presto-spinner.css"]
  }; }
}
