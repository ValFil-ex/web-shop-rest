//I tried to work with modules to avoid including all scripts to html page; instead, we include just one main module

import controller from './GUIcontroller.js';

$(document).ready(function(){
    controller.initGUI();
})


