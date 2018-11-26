"use strict";

app.component("radioButton", {
    templateUrl: "components/radio-button.html",
    controller: "RadioButtonController",
    binding: {
        value1: "<"
    }
});


app.controller("RadioButtonController", function ($log) {

    $log.debug("RadioButtonController()");
});