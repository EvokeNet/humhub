function addEvokationToPortfolio(id, add_action, title, evokation_url){
 /* To call this function, it's needed to declare these variables in your view file:
* evocoins_message
* no_enough_evocoins_message
* remove_from_portfolio_text
* updated_message
* evokation_added_message
* error_message
* something_went_wrong_message
* investment_limit_message
*/
        do{
            var investment = parseInt(window.prompt(evocoins_message,1), 10);
        }while( (!isNaN(investment) && (isNaN(parseInt(investment)) || investment < 1)));

        if(!isNaN(investment)){

            if(investment > availableAmount){
                showMessage(error_message, no_enough_evocoins_message);
                return;
            }

            $.ajax({
                url: add_action+'&evokation_id='+id+"&investment="+investment,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'success'){
                        addEvokation(
                            id, 
                            title, 
                            evokation_url, 
                            investment);
                        $('#portfolio_status').hide();
                        $('#evokation_vote_'+id).html(remove_from_portfolio_text);
                        $('#evokation_vote_'+id).attr("onclick", "deleteEvokation("+id+");");
                        showMessage(updated_message, evokation_added_message);
                    }else if(data.status == 'error'){
                        $('#portfolio_status').hide();
                        showMessage(error_message, something_went_wrong_message);
                    }else if(data.status == 'error_limit'){
                        $('#portfolio_status').hide();
                        showMessage(error_message, investment_limit_message);
                    }
                }
            });      
        }
    }