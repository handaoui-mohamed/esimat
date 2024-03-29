function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#admin-' + id + ' .confirmation-buttons').html(content);
    $("#delete-"+id).hide(0);
    $("#edit-"+id).hide(0);
}

function hideDeleteConfirm(id) {
    $('#admin-' + id + ' .confirmation-buttons').html('');
    $("#delete-"+id).show(0);
    $("#edit-"+id).show(0);
}

function deleteTopic(id) {
    $.ajax({
        url: baseURL + 'delete/admin',
        type: "POST",
        data: {id: id},
        success: function (data) {
            data = JSON.parse(data);
            if (data.delete) $('#admin-' + id).remove();
        }
    });
}

function addNewAdmin(event) {
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("", "#new-admin-form", "#topic-progress-bar", "#alert-message", function (data) {
    });
}


$(document).ready(function () {
    $("#new-admin-form").submit(addNewAdmin);
});