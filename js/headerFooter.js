'use strict';

//var divs = document.getElementsByTagName("body");

var header = document.createElement("header");
var body = document.getElementsByTagName("body");
var navBar;

navBar =document.createElement(<nav class="navbar navbar-default"><div class="container-fluid"><ul class="nav navbar-nav"><li class="active"> <a href="#">Accueil</a></li><li> <a href="#">Liens</a> </li><li> <a href="#">Témoignages</a> </li><li> <a href="#">Références</a> </li></ul></div></nav>);

header.appendChild(navBar);
body.insertBefore(header, body.childNodes[0]);
//document.getElementsByTagName("body")[0].innerHTML = navBar;
