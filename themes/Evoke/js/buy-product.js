/**
 *  handles the buy button ajax requests and updates evocoin count
 */

function setBuyButtonListeners($buyButton) {
  $buyButton.on('click', function(e){
    e.preventDefault();
    var productID  = $buyButton.attr('id').replace('buy-', '');

    $.ajax({
        url: 'index.php?r=marketplace%2Fproducts%2Fbuy&product_id='+productID,
        type: 'get',
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            $userEvocoins = $('#userEvocoins');
            $productQuantity = $('#product' + productID + 'Quantity');

            $userEvocoins.jQuerySimpleCounter({start: $userEvocoins.text(),end: response.wallet_amount});
            $productQuantity.text(response.product_quantity);

            if (response.product_quantity < 1) {
              $('#purchaseProduct' + productID).text(response.sold_out_message);
            }

            showPurchaseMessage('', response.message);
          } else {
            showPurchaseMessage('', response.message);
          }
        }
    });
  });
}

function showPurchaseMessage(title, message){
  document.getElementById("message-title").innerHTML = title;
  document.getElementById("message-content").innerHTML = message;
  $("#popup-message").modal("show");
}

function initBuyButton() {
  // wait until jquery is loeaded
  if (!(typeof jQuery === 'function')) {
     window.setTimeout(function () {
         //console.log(count++);
         initBuyButton();
     }, 10);  // Try again every 10 ms..
     return;
  }

  // extend jquery to animate counts
  $.fn.jQuerySimpleCounter = function( options ) {
      var settings = $.extend({
          start:  0,
          end:    100,
          easing: 'swing',
          duration: 400,
          complete: ''
      }, options );

      var thisElement = $(this);

      $({count: settings.start}).animate({count: settings.end}, {
      duration: settings.duration,
      easing: settings.easing,
      step: function() {
        var mathCount = Math.ceil(this.count);
        thisElement.text(mathCount);
      },
      complete: settings.complete
    });
  };

  $(document).ready(function(){
    $('.purchase').each(function(index, element){
      var $buyButton = $(element).find('.buy-button');

      setBuyButtonListeners($buyButton);
    });

  });
}

initBuyButton();
