var api = {
    sendForm: function (url, formSelector, progressSelector, msgSelector, success) {
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($(formSelector).get()[0]),
            progress: function (prog) {
                if (prog.lengthComputable) {
                    var percentage = ((prog.loaded / prog.total) * 100).toFixed(2) + "%";
                    $(progressSelector).css("width", percentage);
                    $(progressSelector).text(percentage);
                }
                else {
                    alert("Content Length not reported!");
                }
            },
            success: function (data) {
                data = JSON.parse(data);
                success(data);
                $(msgSelector).show(0);
                if(data && data.upload){
                    $(msgSelector).removeClass('alert-danger');
                    $(msgSelector).addClass("alert-success");
                    $(msgSelector).text("Les données ont été sauvegardées avec succès");
                }else{
                    $(msgSelector).addClass('alert-danger');
                    $(msgSelector).removeClass("alert-success");
                    $(msgSelector).text(data.messages);
                }
            }
        });
    }
};
