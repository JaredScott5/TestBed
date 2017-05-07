<?php

// Route for Homepage - displays all products from the shop
Route::get('/', function()
{
  return 'Shop homepage';
});

// Route that shows an individual product by its ID
Route::get('products/{id}', function($id)
{
  return 'Product: '.$id;
});

// Route that handles submission of review - rating/comment
Route::post('products/{id}', array('before'=>'csrf', function($id)
{	
  return 'Review submitted for product '.$id;
}));

?>