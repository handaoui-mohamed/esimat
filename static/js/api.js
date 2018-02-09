var api = {
    sendForm: function (url, formSelector, progressSelector, success) {
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($(formSelector).get()[0]),
            progress: function (prog) {
                if (prog.lengthComputable) {
                    var percentage = (prog.loaded / prog.total) + "%";
                    $(progressSelector).css("width", percentage);
                    $(progressSelector).text(percentage);
                }
                else {
                    alert("Content Length not reported!");
                }
            },
            success: function (data) {
                success(data);
            }
        });
    }
};
