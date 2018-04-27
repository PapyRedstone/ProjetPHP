window.onload = winLoad;

function winLoad(){
    var header = '<nav class="navbar navbar-expand-lg navbar-light bg-light">'+
	'<div class="collapse navbar-collapse" id="navbarSupportedContent">'+
	'<ul class="navbar-nav mr-auto">'+
	'<li class="nav-item active">'+
	'<a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>'+
	'</li>'+
	'<li class="nav-item">'+
	'<a class="nav-link" href="form.html">Ajouter un profil</a>'+
	'</li>'+
	'</ul>'+
	'</div>'+
	'</nav>';
    
    $("header").html(header);

    var footer = '<div class="navbar navbar-expand-lg navbar-light bg-light" style="position: absolute;bottom :0px; width:100%;'+
	'<div class="collapse navbar-collapse" id="navbarSupportedContent">'+
	'<ul class="navbar-nav mr-auto">'+
	'<li class="nav-item">'+
	'<a class="nav-link" href="#">Equipe</a>'+
	'</li>'+
	'<li class="nav-item">'+
	'<a class="nav-link" href="http://www.jpgraph.net">powered by jpgraph</a>'+
	'</li>'+
	'</ul>'+
	'</div>'+
	'</div>';
    
    $("footer").html(footer);
}

