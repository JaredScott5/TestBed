$(document).ready(function(){

  $(".form-control").bind('keyup mouseup', function () {
    var row = $(this).parent().parent();
    var item_id = row.attr('id');
    var quantity = $(this).val();
    if (quantity > 0){    
      // console.log(item_id);
      // console.log(quantity);
        $.ajax({
          url: "cart.php",
          type: "POST",
          cache: false,
          dataType: 'json',
          data: {item_id: item_id, quantity: quantity, f: 1},
            success: function(data){
              // console.log (data.itemsInCart);
              // console.log(data.cartCount);
              $(this).val(data.itemsInCart);
              $('#cartCount').html("<span class=\"glyphicon glyphicon-shopping-cart\">&nbsp;</span>" + "Cart(" + data.cartCount + ")");
              var price = row.children().children('.price').text();
              // console.log(row);
              // console.log(price);
              price = price.replace('$', '');
              // console.log(price);
              var newSubTotal = price * data.itemsInCart;
              row.children().children('.subtotal').text("$" + newSubTotal.toFixed(2));
            },
            error: function(data){
              // console.log(item_id);
              // console.log(quantity);
              alert("Failed with " + data + "in data");
              // console.log (data.itemsInCart);
              // console.log(data.cartCount);
            }
      });
    } else {
      alert("Must be greater than zero.");
    }
  });
  
  $(".remove").click(function() {
    var item_id = $(this).parent().parent().attr('id');
    $.ajax({
      url: "add-to-cart.php",
      type: "POST",
      cache: false,
      dataType: 'json',
      data: {item_id: item_id, quantity: 0},
      success: function(data){
        // console.log(data.cartCount);
        $('#cartCount').html("<span class=\"glyphicon glyphicon-shopping-cart\">&nbsp;</span>" + "Cart(" + data.cartCount + ")");
      },
      error: function(data){
        console.log(data.msg);
        console.log(data.item_id);
        console.log(data.cartCount);
        alert("Failed with " + data + "in data");
      }
    });
  });
  
});
/*
function updateQuantity(item_id, quantity){
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'add-to-cart.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("item_id="+item_id+"&quantity="+quantity+"&f=1");
}

function removeItem(item_id){
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'add-to-cart.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("item_id="+item_id+"&quantity="+0);
}

function checkOut(order_number, total_cost){
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = updateCart;
	httpRequest.open('POST', 'checkout.php');
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send("order_number="+order_number+"&total_cost="+total_cost);
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
*/
