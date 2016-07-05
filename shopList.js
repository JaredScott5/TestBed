var cartCount = 0;

window.onload = function(){
	var note = document.getElementById("notes");
	note.innerHTML = "testing windows.onload from js";
	document.getElementById("cart").innerHTML = "Cart " + 0;
};

/*
function buttonName(){
	var stringData = document.getElementById("notes2");
	stringData.innerHTML = "testing function buttonName";
		var length = document.getElementsByTagName("LI").length;

	for(var i = 0; i < length; i++){
	document.getElementsByTagName("LI")[i].setAttribute(javascript_array['item_id']);
	}
}
*/
function addToCart(parent){
	document.getElementById("cart").innerHTML = ++cartCount;
	document.getElementById("notes").innerHTML = "testing";

	var itemToAddToCart = parent.id;
	
	document.getElementById("notes").innerHTML = "chldNode 1 value is" + itemToAddToCart;
}