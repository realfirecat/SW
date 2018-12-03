<<<<<<< HEAD
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
=======
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
>>>>>>> 76da3fe99bce357d1e93a80005e4f9724aa8ec8a
});