"use strict";

app.component("meinSlider", {
    templateUrl: "components/mein-slider.html",
    controller: "MeinSliderController",
    bindings: {
        label: "@",
        wertAenderung: "&"
    }
});


app.controller("MeinSliderController", function ($log) {

    $log.debug("MeinSliderController()");

    this.geaendert = function () {
        this.wertAenderung ({ wert: this.farb });

    };
});
