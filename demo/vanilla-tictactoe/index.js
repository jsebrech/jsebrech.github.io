import { registerComponents } from "./App.js";

document.addEventListener('DOMContentLoaded', () => {
    registerComponents();
    document.body.appendChild(document.createElement('x-game'));
});
