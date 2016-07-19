<?php
session_start();
include_once 'dbconnect.php';
include_once 'item.php';
if (isset ( $_GET ['item_id'] )) {
  $result = mysqli_query ( $MySQLi_CON, "SELECT * FROM items WHERE item_id=" . $_GET['item_id'] );
  $row = mysqli_fetch_object( $result );
  $item = new Item();
  $item->id = $row->item_id;
  $item->name = $row->itemName;
  $item->price = $row->price;
  $item->quantity = 1;
  // Check cart for duplicate item
  $index = -1;
  if (isset ( $_SESSION['cart'] )) {
    $cart = unserialize ( serialize ( $_SESSION['cart'] ));
    for($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]->id == $_GET['item_id']) {
        $index = $i;
        break;
      }
    }
  }
  if ($index == -1)
    $_SESSION['cart'][] = $item;
  else{
    $cart[$index]->quantity++;
    $_SESSION['cart'] = $cart;
  }
}
// Delete product in cart
if (isset ($_GET['index'] )) {
  $cart = unserialize ( serialize ( $_SESSION['cart'] ));
  unset ( $cart[$_GET['index']] );
  $cart = array_values($cart);
  $_SESSION['cart'] = $cart;
}

// Update quantity in cart
if(isset($_POST['update'])) {
  $arrQuantity = $_POST['quantity'];
  
  // Check validate quantity
  $valid = 1;
  for($i=0; $i<count($arrQuantity); $i++)
    if(!is_numeric($arrQuantity[$i}) || $arrQuantity[$i] < 1){
      $valid = 0;
      break;
    }
  if($valid==1){
    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
    for($i = 0; $i < count ( $cart ); $i++) {
      $cart[$i]->quantity = $arrQuantity[$i];
    }
    $_SESSION['cart'] = $cart;
  } else {
    $error = 'Quantity is Invalid';
  }
}
?>
<?php echo isset($error) ? $error : ''; ?>

