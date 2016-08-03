function updateQuantity(){
	
}



function removeItem(itemID){
	//look at addtoCart.php to properly update the 'cart'
	
	//1 get the mysql id of what you want removed
	
	//2 on the php side of 
	
	//var item_id = parent.id;
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