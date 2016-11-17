
$(document).ready(function(){
	onLoadDraftCurrentTextFormatting();

	//on key up, draft's word counter starts counting
	$('[id^=evidence_input_text_').each(function() {
		id = $(this).attr('id').substr(20);
		$(this).keyup(function(){
			current = $('#current'+id);
	    	minimun = $('#minimun'+id);

		    //change current
		    current.text($('#evidence_input_text_'+id).val().length);

		    if(current.text() >= 140){
		        current.css('color', '#92CE92')
		    }else{
		        current.css('color', '#9B0000')
		    }
		})		
	})

	function onLoadDraftCurrentTextFormatting(){ 

	  $('[id^=current]').each(function() {
	    current = $(this);
	    if(current.text() >= 140){
	        current.css('color', '#92CE92')
	    }else{
	        current.css('color', '#9B0000')
	    }

	  });
	}

});