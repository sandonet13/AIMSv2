document.addEventListener("DOMContentLoaded", function(event) {
    "use strict";
    var col = document.getElementsByClassName("col-md-4")[0];
    var form = document.getElementsByTagName("form")[0];

    col.classList.remove("col-md-offset-4");
    col.classList.remove("col-sm-offset-2");
    col.classList.remove("col-md-4");
    col.classList.remove("col-sm-8");

    col.classList.add("col-md-6", "col-md-offset-3");
    form.classList.add("col-xs-9");
    form.classList.add("col-sm-9");
    form.classList.add("col-md-9");

    document.getElementsByTagName('h1')[0].outerHTML = '<h2 class="col-md-12 col-sm-12 col-xs-12 text-center">Sign In</h2>';
});