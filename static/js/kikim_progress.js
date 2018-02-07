// @kikim :utilisation de jquery

(function($, window, undefined) {

    var hasOnProgress = ("onprogress" in $.ajaxSettings.xhr());

    
    if (!hasOnProgress) {
        return;
    }
    
    var oldXHR = $.ajaxSettings.xhr;
    $.ajaxSettings.xhr = function() {
        var xhr = oldXHR();
        if(xhr instanceof window.XMLHttpRequest) {
            xhr.addEventListener('progress', this.progress, false);
        }
        
        if(xhr.upload) {
            xhr.upload.addEventListener('progress', this.progress, false);
        }
        
        return xhr;
    };
})(jQuery, window);


/*ex attr dans l objet (paramètre $.ajax)
        progress: function(e) {
        //si on peut compter (la taille des donneés)
        if(e.lengthComputable) {
        var pct = (e.loaded    /  e.total) * 100;
                taille_envoyée/tot_taille


        }
        
        else {
            alert('On NE PEUT PAS COMPTER LA TAILLE');
        }
         }*/