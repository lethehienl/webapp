global.AjaxUtil = {
    post: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        let initObject ={
            url: url,
            type: 'POST',
            data : params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        };

        $.ajax(initObject);
    },

    postFile: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'POST',
            data : params,
            processData: false,
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    patch: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'PATCH',
            data: params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    delete: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    get: function(url, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    }
};
