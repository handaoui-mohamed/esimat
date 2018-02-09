function addNewAlbum(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-album-form","#topic-progress-bar", function(data){
        $("#progress-container").hide(0);
    });
}

function showMainImgPreview(){
    var container = $('#image-preview>div:first-child');
    var content = '<img id="image-preview"  style="height:100px; width:100%;"  src="'+window.URL.createObjectURL(this.files[0])+'" >';
    content += '<input class="image-preview-title" name="title_0" type="text" placeholder="Titre"/>';
    container.html(content);
}

function showImgPreview(){
    var container = $('#image-preview>div:nth-child(2)');
    container.html('');
    var content;
    if(this.files){
        for(var i=0; i<this.files.length; i++){
            content = '<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="'+
                window.URL.createObjectURL(this.files[i])+'" >';
            content += '<input class="image-preview-title" name="title_'+i+'" type="text" placeholder="Titre"/></div>';
            container.append(content);
        }
    }
}

$(document).ready(function(){
    $("#new-album-form").submit(addNewAlbum);

    $("#im_0").change(showMainImgPreview);
    $("#ims").change(showImgPreview);
    $("#form-reset").click(function(){
        $('#image-preview>div:first-child').html('');
        $('#image-preview>div:nth-child(2)').html('');
    })
});