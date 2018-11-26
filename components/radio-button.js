"use strict";

app.component("radioButton", {
    templateUrl: "components/radio-button.html",
    controller: "RadioButtonController",
    binding: {
        name: "@",
        values: "@"
    }
});


app.controller("RadioButtonController", function ($log) {

    $log.debug("RadioButtonController()");

});