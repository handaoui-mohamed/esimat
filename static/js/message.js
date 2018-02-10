function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#message-' + id + ' .confirmation-buttons').html(content);
}

function hideDeleteConfirm(id) {
    $('#message-' + id + ' .confirmation-buttons').html('');
}

function deleteTopic(id) {
    $('#message-' + id).remove();
}