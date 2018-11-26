"use strict";

app.component("rgbSlider", {
    templateUrl: "components/rgb-slider.html",
    controller: "RgbSliderController",
    bindings: {}
});


app.controller("RgbSliderController", function ($log) {

    $log.debug("RgbSliderController()");

    function hex(wert) {
        return angular.isNumber(wert)
            ? ("0" + wert.toString(16)).substr(-2) //substr bei negativer Zahl: fängt von hinten an --> das nimmt die letzten 2 Ziffer
            : "00";
    }

    this.hexFarbe = function () {
        return "#" + hex(this.rot) + hex(this.gruen) + hex(this.blau);
    }

    /*function componentToHex(number) {
        var chars = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
        var low = number & 0xf;
        var high = (number >> 4) & 0xf;
        return "" + chars[high] + chars[low];
    }

    this.aendereErg = function(par1, par2, par3) {
        this.rot = par1;
        this.gruen = par2;
        this.blau = par3;
        $log.debug(this.rot);
        this.erg = "#" + componentToHex(this.rot) + componentToHex(this.blau) + componentToHex(this.gruen);
    }*/
});
