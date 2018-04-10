'use strict';

//var divs = document.getElementsByTagName("body");

var header = document.createElement("header");
var body = document.getElementsByTagName("body");
var navBar;

navBar = '<nav class="navbar navbar-inverse">'+
            '<div class="container-fluid">'+
                '<ul class="nav navbar-nav">'+
                    '<li class="active"> <a href="#">Accueil</a> </li>'+
                    '<li> <a href="#">Liens</a> </li>'+
                    '<li> <a href="#">Témoignages</a> </li>'+
                    '<li> <a href="#">Références</a> </li>'+
                '</ul>'+
            '</div>'+
        '</nav>';

//header = navBar.innerHTML;
//body.insertBefore(header, body.childNodes[0]);
document.getElementsByTagName("body").innerHTML = navBar;
console.log(navBar);