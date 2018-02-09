function addNewAlbum(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-album-form","#topic-progress-bar", function(data){
        $("#progress-container").hide(0);
    });
}

function showImgPreview(){
    var container = $('#image-preview>div');
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

    $("#ims").change(showImgPreview);
    $("#form-reset").click(function(){
        $('#image-preview>div').html('');
    })
});