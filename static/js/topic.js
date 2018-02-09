var nbImageInput = 1;
var nbVideoInput = 1;

function addImageInput(){
    $(this).before(
        "<label for='im_"+nbImageInput+"'>Image "+
        (nbImageInput+1)+"</label><input accept=\"image/*\" type='file' id='im_"
        +nbImageInput+"' name='im_"+nbImageInput+"'><br>"
    );
    nbImageInput++;
}

function addVideoInput(){
    $(this).before(
        "<label for='vid_"+nbVideoInput+"'>Video "+
        (nbVideoInput+1)+"</label><input accept=\"video/*\" type='file' id='vid_"
        +nbVideoInput+"' name='vid_"+nbVideoInput+"'><br>"
    );
    nbVideoInput++;
}

function addNewTopic(event){
    event.preventDefault();
    $("#progress-container").show(0);
    api.sendForm("","#new-topic-form","#topic-progress-bar", function(data){
        $("#progress-container").hide(0);
    });
}

function showMainImgPreview(){
    var container = $('#image-preview>div:first-child');
    container.html('<img id="image-preview"  style="height:205px; width:100%;"  src="'+window.URL.createObjectURL(this.files[0])+'" >');
}

function showImgPreview(){
    var container = $('#image-preview>div:nth-child(2)');
    container.html('');
    if(this.files){
        for(var i=0; i<this.files.length; i++){
            container.append('<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="'+
                window.URL.createObjectURL(this.files[i])+'" ></div>'
            );
        }
    }
}

$(document).ready(function(){
    $("#add-video-input").click(addVideoInput);
    $("#add-image-input").click(addImageInput);
    $("#new-topic-form").submit(addNewTopic);


    $("#im_0").change(showMainImgPreview);
    $("#ims").change(showImgPreview);
    $("#form-reset").click(function(){
        $('#image-preview>div:first-child').html('');
        $('#image-preview>div:nth-child(2)').html('');
    })
});