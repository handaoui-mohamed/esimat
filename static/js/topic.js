var nbVideoInput = 1;

function addVideoInput() {
    $(this).before(
        "<label for='vid_" + nbVideoInput + "'>Video " +
        (nbVideoInput + 1) + "</label><input accept=\"video/*\" type='file' id='vid_"
        + nbVideoInput + "' name='vid_" + nbVideoInput + "'><br>"
    );
    nbVideoInput++;
}

function addNewTopic(event) {
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("", "#new-topic-form", "#topic-progress-bar", function (data) {
        $("#progress-container").hide(0);
    });
}

function showMainImgPreview() {
    var container = $('#image-preview>div:first-child');
    container.html('<img id="image-preview"  style="height:205px; width:100%;"  src="' + window.URL.createObjectURL(this.files[0]) + '" >');
}

function showImgPreview() {
    var container = $('#image-preview>div:nth-child(2)');
    container.html('');
    if (this.files) {
        for (var i = 0; i < this.files.length; i++) {
            container.append('<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="' +
                window.URL.createObjectURL(this.files[i]) + '" ></div>'
            );
        }
    }
}

function showDeleteConfirm(id) {
    content = '<button id="confirm-delete-' + id + '" onclick="deleteTopic(' + id + ')">Confirmer</button>' +
        ' <button id="cancel-delete-' + id + '" onclick="hideDeleteConfirm(' + id + ')">Annuler</button>';
    $('#topic-' + id + ' .confirmation-buttons').html(content);
}

function hideDeleteConfirm(id) {
    $('#topic-' + id + ' .confirmation-buttons').html('');
    // $('#delete-' + id).html('<i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' + id + ')"></i>');
}

function deleteTopic(id) {
    $('#topic-' + id).remove();
}

$(document).ready(function () {
    $("#add-video-input").click(addVideoInput);
    $("#new-topic-form").submit(addNewTopic);


    $("#im_0").change(showMainImgPreview);
    $("#ims").change(showImgPreview);
    $("#form-reset").click(function () {
        $('#image-preview>div:first-child').html('');
        $('#image-preview>div:nth-child(2)').html('');
    })
});