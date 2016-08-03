function updateQuantity(item_id, quantity){
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'add-to-cart.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("item_id="+item_id+"&quantity="+quantity);
}



function removeItem(itemID){
	var item_id = itemID;
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'add-to-cart.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//we are completly removing the item, so quantity BECOMES 0
	httpRequest.send("item_id="+item_id+"&quantity=0");
}


function updateCart() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        cart.innerHTML = "Cart(" + httpRequest.responseText + ")";
      } else {
        alert('There was a problem with the request.');
      }
    }
  }
  catch( e ) {
    alert('Caught Exception: ' + e.description);
  }
}