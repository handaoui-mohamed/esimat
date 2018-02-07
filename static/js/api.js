var  api={
    sendForm:function(url,formSelector,progressSelector,success) {
        $.ajax(
            {url:url,
            type:post,
            processData:false,
            contentType:false,
            data:new FormData($(formSelector).get()[0]),
            progress: function(prog)
            {
            if(prog.lengthComputable) {

                $(progressSelector).css("width",(prog.loaded/prog.total)+"%");
            }
            else {
                alert("Content Length not reported!");
            }

            },
                success:function(data){success(data);}


    });
    }
};
