'use strict';

//var divs = document.getElementsByTagName("body");

var header = document.createElement("header");
var body = document.getElementsByTagName("body");
var navBar;
/*
navBar =document.createElement('<div class="navbar navbar-default">'+'<ul class="nav navbar-nav">'+'<li class="active"> <a href="#">Accueil</a> </li>'+'<li> <a href="#">Liens</a> </li>'+'<li> <a href="#">Témoignages</a> </li>'+'<li class="disabled"> <a href="#">Références</a> </li>'+'</ul>'+'</div>');
*/
navBar =document.createElement(<ul class="nav navbar-nav"><li class="active"> <a href="#">Accueil</a> </li></ul>);

header.appendChild(navBar);
body.insertBefore(header, body.childNodes[0]);
//document.getElementsByTagName("body")[0].innerHTML = navBar;
