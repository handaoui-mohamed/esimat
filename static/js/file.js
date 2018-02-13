function addNewFile(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-file-form","#topic-progress-bar", "#alert-message", function(data){});
}

function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#file-' + id + ' .confirmation-buttons').html(content);
    $("#delete-"+id).hide(0);
    $("#edit-"+id).hide(0);
}

function hideDeleteConfirm(id) {
    $('#file-' + id + ' .confirmation-buttons').html('');
    $("#delete-"+id).show(0);
    $("#edit-"+id).show(0);
}

function deleteTopic(id) {
    $.ajax({
        url: baseURL + 'delete/file',
        type: "POST",
        data: {id: id},
        success: function (data) {
            data = JSON.parse(data);
            if(data.delete) $('#file-' + id).remove();
        }
    });
}

$(document).ready(function(){
    $("#new-file-form").submit(addNewFile);
});