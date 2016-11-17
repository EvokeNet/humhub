
$(document).ready(function(){
	draftCurrentTextFormatting();

	function draftCurrentTextFormatting(){ 

	  $('[id^=current]').each(function() {
	    current = $( this );
	    if(current.text() >= 140){
	        current.css('color', '#92CE92')
	    }else{
	        current.css('color', '#9B0000')
	    }

	  });
	}

});


