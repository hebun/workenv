Ajax = {

    getObject: function () {
        var http=null;
        if (window.XMLHttpRequest) {
            http = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        else {
            alert('Problem creating the XMLHttpRequest object');
        }
        return http;
    },
    call: function (params) {

        var http = this.getObject();

        var method = params.method || "post";

        var load = params.load || null;

        var url = params.url;

        var query = "";

        for (p in params.params) {

            query += p + "=" + params.params[p] + "&";
        }

        query = query.substr(0, query.length - 1);
      //  console.info(query);

        http.open(method, url);

        http.onreadystatechange = function () { Ajax.procces(http, params.success); };
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.setRequestHeader("Content-length", params.length);
        http.setRequestHeader("Connection", "close");
        http.send(query);

        if (load !== null) {
            load();
        }
    },
    procces: function (http, callback) {

        if (http.readyState == 4 && http.status == 200) {

            if (http.responseText) {
            if(callback)
                callback(http.responseText);
            }
            else {

            }
        }
        if (http.readyState == 2) {

        }
    }

};

