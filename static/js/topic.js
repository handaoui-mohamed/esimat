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
    $("#progress-container").css('display', 'block');
    api.sendForm("","#new-topic-form","#topic-progress-bar", function(data){

    });
}

$(document).ready(function(){
    $("#add-video-input").click(addVideoInput);
    $("#add-image-input").click(addImageInput);
    $("#new-topic-form").submit(addNewTopic);
});