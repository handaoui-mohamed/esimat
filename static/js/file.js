function addNewFile(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-file-form","#topic-progress-bar", "#alert-message", function(data){});
}

$(document).ready(function(){
    $("#new-file-form").submit(addNewFile);
});