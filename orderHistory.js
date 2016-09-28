$(document).ready(function(){
  $('.exp-col').text(function () {
    $details = $(this).parents('.order').children('.details');
          return $details.is(":visible") ? "Hide Details" : "Show Details";
      });
  $('.exp-col').click(function() {
    $header = $(this);
    $details = $(this).parents('.order').children('.details');
    $details.toggle(0, function () {
      $header.text(function () {
          return $details.is(":visible") ? "Hide Details" : "Show Details";
      });
    });
  });
});
