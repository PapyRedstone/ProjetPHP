'use strict';

function httpError(errorCode){
    var err = document.getElementById("errors");
    $("div#errors").addClass("alert alert-danger");
    err.innerHTML = errorCode;
}

function ajaxRequest(type, request, callback, data = null){
    var xhr;

    xhr = new XMLHttpRequest();
    if(type == 'GET' && data != null){
	request += '?' + data;
    }
    xhr.open(type, request, true);
    
    xhr.onload = function(){
	switch(xhr.status){
	case 200:
	case 201:
	    callback(xhr.responseText);
	    break;
	 
	default:
	    callback(xhr.status)
	    break;
	}
    }
    
    xhr.send(data);
}

