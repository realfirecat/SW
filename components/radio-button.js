"use strict";

app.component("radioButton", {
    templateUrl: "components/radio-button.html",
    controller: "RadioButtonController",
    binding: {
        name: "@",
        value: "@"
    }
});


app.controller("RadioButtonController", function ($log) {

    $log.debug("RadioButtonController()");
});