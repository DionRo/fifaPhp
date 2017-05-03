function isInViewPort(element){
    var bounds = element.getBoundingClientRect();
    return bounds.top < window.innerHeight && bounds.bottom > 0;
}

function changeOpacity(){
	var elementOnTopOfPage = document.getElementById("Top-Header");
	var elementMenu = document.getElementById("main-head");

	if(isInViewPort(elementOnTopOfPage)){
		elementMenu.style.opacity = 1;
	}
	else{
		elementMenu.style.opacity = .1;
	}
}

function init(){
	changeOpacity();
	document.getElementsByTagName("body")[0].onscroll = changeOpacity;
}

window.onload = init;