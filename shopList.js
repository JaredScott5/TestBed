$(document).ready(function(){

  $(".btn").click(function () {
    var row = $(this).parent().parent();
    var item_id = row.attr('id');
    // console.log(item_id);
    // console.log(quantity);
    $.ajax({
      url: "cart.php",
      type: "POST",
      cache: false,
      dataType: 'json',
      data: {item_id: item_id, quantity: 1},
      success: function(data){
        // console.log(data.msg);
        $('#cartCount').html("<span class=\"glyphicon glyphicon-shopping-cart\">&nbsp;</span>" + "Cart(" + data.cartCount + ")");
      },
      error: function(data){
        console.log(data.msg);
        alert("Failed with " + data + "in data");
        // console.log(data.cartCount);
      }
    });
  });
});

/*
window.onload = function(){
  var cart = document.getElementById("cart");
	//note.innerHTML = "testing windows.onload from js";
	//document.getElementById("cart").innerHTML = "Cart " + 0;
};



function addToCart(item){
	//document.getElementById("cart").innerHTML = ++cartCount;
	//document.getElementById("notes").innerHTML = parent;

	var item_id = item;
	
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
        cart.textContent = "Cart(" + httpRequest.responseText + ")";
        var node = document.createElement("span");
        node.className = "glyphicon glyphicon-shopping-cart";
        node.textContent = '\xa0';
        cart.insertBefore(node, cart.firstChild);
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

*/