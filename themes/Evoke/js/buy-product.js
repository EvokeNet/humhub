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

            $userEvocoins.text(response.wallet_amount);
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

  $(document).ready(function(){
    $('.purchase').each(function(index, element){
      var $buyButton = $(element).find('.buy-button');

      setBuyButtonListeners($buyButton);
    });

  });
}

initBuyButton();
