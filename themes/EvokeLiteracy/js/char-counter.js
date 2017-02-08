function counChars() {
  // wait until jquery is loeaded
  if (!(typeof jQuery === 'function')) {
     window.setTimeout(function () {
         //console.log(count++);
         counChars();
     }, 10);  // Try again every 10 ms..
     return;
  }

  $(document).ready(function(){
    $('.count-chars').each(function(index, element){
      var $textInput = $(element);
      $textInput.after('<span id ="counter' + index + '" class="char-counter"></span>');
      var $charCounter = $('#counter' + index);

      $textInput.on('keyup', function(e){
        $charCounter.text($(e.target).val().length);
      });
    });

  });
}

counChars();
