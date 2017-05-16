function isInViewPort(element){
    var bounds = element.getBoundingClientRect();
    return bounds.top < window.innerHeight && bounds.bottom > 0;
}

function changeOpacity(){
	var elementOnTopOfPage = document.getElementById("header");
	var elementMenu = document.getElementById("menu");

	if(isInViewPort(elementOnTopOfPage)){
		elementMenu.style.opacity = 1;
	}
	else{
		elementMenu.style.opacity = .2;
	}
}

function init(){
	changeOpacity();
	document.getElementsByTagName("body")[0].onscroll = changeOpacity;
}

window.onload = init;