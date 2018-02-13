function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#message-' + id + ' .confirmation-buttons').html(content);
    $("#delete-"+id).hide(0);
}

function hideDeleteConfirm(id) {
    $('#message-' + id + ' .confirmation-buttons').html('');
    $("#delete-"+id).show(0);
}

function deleteTopic(id) {
    $.ajax({
        url: baseURL + 'delete/message',
        type: "POST",
        data: {id: id},
        success: function (data) {
            data = JSON.parse(data);
            if (data.delete) $('#message-' + id).remove();
        }
    });
}