//ALEXANDRE
window.onload = winLoad;

function winLoad(){
    var header = '<nav class="navbar navbar-expand-lg navbar-light bg-light">'+
	'<div class="collapse navbar-collapse" id="navbarSupportedContent">'+
	'<ul class="navbar-nav mr-auto">'+
	'<li class="nav-item active">';
    if((document.location.href).includes("html") || (document.location.href).includes("php")){
	header += '<a class="nav-link" href="../index.php">Accueil <span class="sr-only">(current)</span></a>';
    }else{
	header += '<a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>';
    }
    header += '</li>'+
	'<li class="nav-item">';
    if((document.location.href).includes("html")){
	header += '<a class="nav-link" href="form.html">Ajouter un profil</a>';
    }else{
	header += '<a class="nav-link" href="html/form.html">Ajouter un profil</a>';
    }
    header += '</li>'+
	'</ul>'+
	'</div>'+
	'</nav>';
    
    $("header").html(header);

    var footer = '<div class="navbar navbar-expand-lg navbar-light bg-light" style="position: absolute;bottom :0px; width:100%"'+
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

