function updateEvokationUrl(id){

    /* To call this function, it's needed to declare these variables in your view file:
    * - gdrive_action_url - action's url
    * - content_container_name - Team's name
    * - updated_message - Success message
    * - error_message - Failure message
    */

    button = document.getElementById("btn_update_url");

    if(button){

        button = document.getElementById("btn_update_url");

        button.innerHTML = "Save";
        button.id = "btn_save_url";

        // get current element
        element = document.getElementById("gdrive_url"+id);

        // create new one
        new_element = document.createElement('input');
        new_element.setAttribute("type","text");
        new_element.setAttribute("id", element.getAttribute("id"));
        new_element.setAttribute("value", element.getAttribute("href"));
        new_element.setAttribute("onChange", "updateInput(this.id, this.value)");

        //switch
        element.parentNode.replaceChild(new_element,element);

    }else{
        button = document.getElementById("btn_save_url");

        button.innerHTML = "Update";
        button.id = "btn_update_url";

        // get current element
        element = document.getElementById("gdrive_url"+id);

        // update url
        $.ajax({
                url: gdrive_action_url,
                type: 'post',
                data: {url: element.getAttribute("value"), id: id},
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'success'){
                        showMessage(updated_message);
                    }else if(data.status == 'error'){
                        showMessage(error_message);
                    }
                }
            }
        );

        // create new one
        new_element = document.createElement('a');
        new_element.setAttribute("id", element.getAttribute("id"));
        new_element.setAttribute("href", element.getAttribute("value"));
        new_element.innerHTML = content_container_name + " Google Drive URL";
 
        //switch
        element.parentNode.replaceChild(new_element,element);
    }
}
