window.onload = function(){
  var cart = document.getElementById("cart");
	//note.innerHTML = "testing windows.onload from js";
	//document.getElementById("cart").innerHTML = "Cart " + 0;
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

function goToItemPage(parent){
	var item_id = parent.id;
	
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'item-page.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("item_id="+item_id);
}

function addToCart(parent){
	//document.getElementById("cart").innerHTML = ++cartCount;
	//document.getElementById("notes").innerHTML = "testing";

	var item_id = parent.id;
	
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'add-to-cart.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("item_id="+item_id+"&quantity=1");
}


function updateCart() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        var node = document.createElement("span");
        node.className = "glyphicon glyphicon-shopping-cart";
        cart.appendChild(node);
        cart.innerHTML = "&nbsp;" + "Cart(" + httpRequest.responseText + ")";
      } else {
        alert('There was a problem with the request.');
      }
    }
  }
  catch( e ) {
    alert('Caught Exception: ' + e.description);
  }
}

function alertContents() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        alert(httpRequest.responseText);
      } else {
        alert('There was a problem with the request.');
      }
    }
  }
  catch( e ) {
    alert('Caught Exception: ' + e.description);
  }
}