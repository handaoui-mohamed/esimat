function addNewFile(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-file-form","#topic-progress-bar", function(data){
        $("#progress-container").hide(0);
    });
}

$(document).ready(function(){
    $("#new-file-form").submit(addNewFile);
});