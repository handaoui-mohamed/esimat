function addNewAlbum(event) {
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("", "#new-album-form", "#topic-progress-bar", "#alert-message", function (data) {
    });
}

function showImgPreview() {
    var container = $('#image-preview>div');
    container.html('');
    var content;
    if (this.files) {
        for (var i = 0; i < this.files.length; i++) {
            content = '<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="' +
                window.URL.createObjectURL(this.files[i]) + '" >';
            content += '<input class="image-preview-title" name="title_' + i + '" type="text" placeholder="Titre"/></div>';
            container.append(content);
        }
    }
}

function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#album-' + id + ' .confirmation-buttons').html(content);
    $("#delete-"+id).hide(0);
    $("#edit-"+id).hide(0);
}

function hideDeleteConfirm(id) {
    $('#album-' + id + ' .confirmation-buttons').html('');
    $("#delete-"+id).show(0);
    $("#edit-"+id).show(0);
}

function deleteTopic(id) {
    $.ajax({
        url: baseURL + 'delete/album',
        type: "POST",
        data: {id: id},
        success: function (data) {
            data = JSON.parse(data);
            if(data.delete) $('#album-' + id).remove();
        }
    });
}

$(document).ready(function () {
    $("#new-album-form").submit(addNewAlbum);

    $("#ims").change(showImgPreview);
    $("#form-reset").click(function () {
        $('#image-preview>div').html('');
    })
});